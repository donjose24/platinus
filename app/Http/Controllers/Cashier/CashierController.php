<?php

namespace App\Http\Controllers\Cashier;


use App\Mail\ReservationApproved;
use App\Mail\ReservationRejected;
use App\Reservation;
use App\ReservationRoom;
use App\ReservationRoomDetail;
use App\Room;
use App\RoomType;
use App\Transaction;
use Auth;
use Carbon\Carbon;
use PDF;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Mail;

class CashierController
{
    public function index()
    {
        $user = Auth::user();
        $reservations = Reservation::whereDate('start_date', Carbon::today())->where('status', 'approved')->get();

        return view('cashier.dashboard', compact('user', 'reservations'));
    }

    public function show($id)
    {
        $reservation = Reservation::find($id);
        $startDate = \DateTime::createFromFormat('Y-m-d', $reservation->start_date);
        $endDate = \DateTime::createFromFormat('Y-m-d', $reservation->end_date);

        $diff = date_diff($startDate, $endDate);
        $diff = $diff->days;

        return view('cashier.show', compact('reservation', 'diff'));
    }

    public function deposits()
    {
        $reservations = Reservation::where('status', 'waiting_for_approval')->get();

        return view('cashier.deposit', compact('reservations'));
    }

    public function view($id)
    {
        $reservation = Reservation::find($id);
        $startDate = \DateTime::createFromFormat('Y-m-d', $reservation->start_date);
        $endDate = \DateTime::createFromFormat('Y-m-d', $reservation->end_date);

        $diff = date_diff($startDate, $endDate);
        $diff = $diff->days;

        return view('cashier.view', compact('reservation', 'diff'));
    }

    public function approve(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'amount' => 'required|numeric',
        ]);

        $id = $request->get('id');
        $amount = $request->get('amount');

        $reservation = Reservation::findOrFail($id);
        $reservation->status = "approved";
        $reservation->save();

        $transaction = new Transaction();
        $transaction->item = "Bank Deposit";
        $transaction->price = $amount;
        $transaction->reservation_id = $reservation->id;
        $reservation->status = 'paid';
        $transaction->save();

        Mail::to($reservation->user()->first()->email)->send(new ReservationApproved($reservation));

        Session::flash('flash_message', 'Reservation approved');
        return redirect('/cashier/deposit');
    }

    public function reject(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'reason' => 'required',
        ]);

        $id = $request->get('id');
        $reason = $request->get('reason');

        $reservation = Reservation::findOrFail($id);
        $reservation->status = "pending";
        $reservation->deposit_slip = '';
        $reservation->save();

        Mail::to($reservation->user()->first()->email)->send(new ReservationRejected($reservation, $reason));

        Session::flash('flash_message', 'Reservation rejected');
        return redirect('/cashier/deposit');
    }

    public function checkIn(Request $request)
    {
        $rooms = $request->get('rooms');

        if (count($rooms) !== count(array_unique($rooms))) {
            Session::flash('error_message', 'Duplicate rooms detected, please select different rooms');
            return redirect()->back();
        }

        $request->validate([
            'rooms.*' => 'required|not_in:-1,'
        ], [
            'rooms.*' => 'Invalid Room Number'
        ]);

        $id = $request->get('reservation_id');
        $ids = $request->get('ids');
        foreach($rooms as $key => $room) {
            $load = ReservationRoom::find($ids[$key]);
            $load->room_number_id = $room;
            $load->save();

            //set room as in used
            $roomNumber = Room::find($room);
            $roomNumber->status = "checked-in";
            $roomNumber->save();
        }


        $reservation = Reservation::find($id);
        $reservation->check_in = Carbon::now();
        $reservation->status = "checked_in";
        $reservation->save();

        Session::flash('flash_message', 'Check in successful');
        return redirect()->back();
    }

    public function reservation(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $reservations = Reservation::where('start_date', 'LIKE', "%$keyword%")
                ->orWhere('end_date', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->orWhere('deposit_slip', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $reservations = Reservation::latest()->paginate($perPage);
        }

        return view('cashier.reservations', compact('reservations'));
    }

    public function printReservation($id)
    {
        $reservation = Reservation::find($id);
        $startDate = \DateTime::createFromFormat('Y-m-d', $reservation->start_date);
        $endDate = \DateTime::createFromFormat('Y-m-d', $reservation->end_date);

        $diff = date_diff($startDate, $endDate);
        $diff = $diff->days;

        $pdf = PDF::loadView('reports.reservation', compact('reservation', 'diff'));
        return $pdf->stream();
    }

    public function checkOut($id)
    {
        $reservation = Reservation::find($id);
        $reservation->status = "checked_out";
        $reservation->save();

        Session::flash('flash_message', 'Check out successful');
        return redirect()->back();
    }

    public function getAvailableRooms(Request $request)
    {
        $roomTypeID = $request->get('room_id');

        $room = RoomType::find($roomTypeID);
        $rooms = $room->rooms()->where('status', 'ready')->pluck('number','id');

        return $rooms->toJson();
    }

    public function updateRoom(Request $request)
    {
        $roomID = $request->get('number');
        $reservationID = $request->get('reservation_id');

        $roomLoad = ReservationRoom::find($reservationID);
        $previousRoomID = $roomLoad->room_number_id;
        $roomLoad->room_number_id = $roomID;
        $roomLoad->save();

        $room = Room::find($previousRoomID);
        $room->status = 'ready';
        $room->save();

        $room = Room::find($roomID);
        $room->status = 'checked-in';
        $room->save();

        Session::flash('flash_message', 'Room successfully updated');
        return redirect()->back();
    }

    public function deleteRoom(Request $request)
    {
        $roomID = $request->get('room_id');
        $reservationID = $request->get('reservation_id');
        $roomTypeID = $request->get('room_type_id');

        //Delete room to free up
        $details = ReservationRoomDetail::where('room_id', $roomID)->where('reservation_id', $reservationID)->first();
        $details->delete();

        //Delete record on reservation table
        $reservation = ReservationRoom::where('reservation_id', $reservationID)->where('room_id', $roomTypeID)->first();
        $reservation->delete();

        Session::flash('flash_message', 'Room successfully deleted');
        return redirect()->back();
    }
}