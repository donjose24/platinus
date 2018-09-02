<?php

namespace App\Http\Controllers\Cashier;


use App\Mail\ReservationApproved;
use App\Mail\ReservationRejected;
use App\Reservation;
use App\ReservationRoomDetail;
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
        $request->validate([
            'rooms.*' => 'required|not_in:-1'
        ], [
            'rooms.*' => 'Please select a room number'
        ]);

        $rooms = $request->get('rooms');
        $id = $request->get('reservation_id');
        foreach($rooms as $room) {
            $details = new ReservationRoomDetail();
            $details->reservation_id = $id;
            $details->room_id = $room;
            $details->save();
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
}