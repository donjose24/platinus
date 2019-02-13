<?php

namespace App\Http\Controllers\Customer;


use App\Http\Controllers\Controller;
use App\Reservation;
use App\ReservationRoom;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Imgur;
use App\Helpers\ReservationHelper;

class CustomerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $reservations = Reservation::where('user_id', $user->id)->where('status', 'pending')->get();
        $approvedReservations = Reservation::where('user_id', $user->id)->where('status', 'approved')->get();

        return view('customer.dashboard', compact('user', 'reservations', 'approvedReservations'));
    }

    public function uploadDepositSlip(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
            'id' => 'required',
        ]);

        $image = Imgur::upload($request->file('image'));

        $reservation = Reservation::find($request->get('id'));
        $reservation->deposit_slip = $image->link();
        $reservation->status = "waiting_for_approval";
        $reservation->save();

        Session::flash('flash_message', 'Deposit slip successfully uploaded! Approval usually takes 1-2 days');
        return redirect()->back();
    }

    public function showReservationForm()
    {
        return view('customer.booking.reservation');
    }

    public function cancelReservation(Request $request)
    {
        $id = $request->get('id');
        $reservation = Reservation::find($id);
        $reservation->status = "cancelled";
        $reservation->save();

        //Delete all relation
        ReservationRoom::where('reservation_id', $reservation->id)->delete();

        Session::flash('flash_message', 'Reservation Cancelled!');
        return redirect()->back();
    }

    public function rebook(Request $request)
    {
        $reservationID = $request->get('reservation_id');

        $reservation = Reservation::find($reservationID);
        $result = ReservationHelper::getAvailableRooms($request->get('start_date'), $request->get('end_date'));
        $availableRoomTypes = $result['roomTypes']->pluck('id')->toArray();

        if (count($availableRoomTypes) == 0) {
            Session::flash('error_message', 'No rooms available for the dates selected');
            return  redirect()->back();
        }

        $currentRoomTypes = $reservation->roomTypes()->wherePivot('deleted_at', null)->pluck('room_id')->toArray();
        $roomsWillBeRemoved = [];
        foreach($currentRoomTypes as $type) {
            if (in_array($type, $availableRoomTypes)) {
                continue;
            }
            $roomsWillBeRemoved[] = $type;
        }

        $reservation->start_date = $request->get('start_date');
        $reservation->end_date = $request->get('end_date');
        $reservation->is_rebooked = true;
        $reservation->save();

        foreach($roomsWillBeRemoved as $room) {
            $room = ReservationRoom::where('reservation_id',$reservationID)->where('room_id', $room)->first();
            $room->delete();
        }

        $transaction = Transaction::where('item', 'Bank Deposit')->where('reservation_id', $reservation->id);
        if($transaction) {
            $transaction->price = $transaction->price * .5;
            $transaction->save();
        }
        return redirect()->to('/customer/booking/'. $reservation->id);
    }

    public function showRebook(Request $request)
    {
        $rules = [
            'start_date' => 'required|date|date_format:Y-m-d|before:end_date',
            'end_date' => 'required|date|date_format:Y-m-d|after:start_date',
        ];

        //this will redirect back on validation error
        $request->validate($rules);
        $reservationID = $request->get('reservation_id');

        $reservation = Reservation::find($reservationID);
        $result = ReservationHelper::getAvailableRooms($request->get('start_date'), $request->get('end_date'));
        $availableRoomTypes = $result['roomTypes']->pluck('id')->toArray();

        if (count($availableRoomTypes) == 0) {
            Session::flash('error_message', 'No rooms available for the dates selected');
            return  redirect()->back();
        }

        $currentRoomTypes = $reservation->roomTypes()->wherePivot('deleted_at', null)->pluck('room_id')->toArray();
        $roomsWillBeRemoved = [];
        foreach($currentRoomTypes as $type) {
            if (in_array($type, $availableRoomTypes)) {
                continue;
            }
            $roomsWillBeRemoved[] = $type;
        }

        return view('cashier.rebook', compact('reservation', 'roomsWillBeRemoved'));
    }
}
