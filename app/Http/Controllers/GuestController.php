<?php

namespace App\Http\Controllers;


use App\Helpers\ReservationHelper;
use App\Mail\ReservationCreated;
use App\RoomType;
use Illuminate\Http\Request;
use App\Reservation;
use App\ReservationRoom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class GuestController extends Controller
{
    /**
     * Search for rooms
     */
    public function search(Request $request)
    {
        if (!(Auth::check())) {
            Session::put('reroute',$request->getRequestUri());
            Session::flash('flash_message', 'You should be logged in to proceed');
            return redirect('/login');
        }

        $rules = [
            'start_date' => 'required|date|date_format:Y-m-d|before:end_date',
            'end_date' => 'required|date|date_format:Y-m-d|after:start_date',
        ];

        //this will redirect back on validation error
        $request->validate($rules);
        $result = ReservationHelper::getAvailableRooms($request->get('start_date'), $request->get('end_date'));
        $roomTypes = $result['roomTypes'];
        $rooms = $result['rooms'];

        return view('guest.search', compact('roomTypes', 'startDate', 'endDate', 'rooms'));
    }

    public function addToCart(Request $request)
    {
        $id = $request->get('id');
        $quantity = $request->get('value');
        $pax = $request->get('pax');
        if ($quantity == 0 || $pax == 0) {
            Session::flash('error_message', 'Invalid Quantity. Please try again');
            return redirect()->back();
        }

        $type = RoomTYpe::find($id);
        if($type->capacity < $pax) {
            Session::flash('error_message', 'Cannot accommodate # of persons in the room');
            return redirect()->back();
        }

        $items = [];
        if (Session::has('items')) {
            $items = Session::get('items');
        }

        $items[$id] = $quantity;

        Session::put('items', $items);
        Session::flash('flash_message', 'Room successfully added to your selection');

        return redirect()->back();
    }

    public function clearCart()
    {
        Session::forget('items');
        Session::flash('flash_message', 'Your room selection has been cleared');
        return redirect()->back();
    }

    public function removeToCart(Request $request)
    {
        $items = [];
        if (Session::has('items')) {
            $items = Session::get('items');
        }

        $id = $request->get('id');
        unset($items[$id]);

        if (count($items) == 0){
            Session::forget('items');
        } else {
            Session::put('items', $items);
        }


        Session::flash('flash_message', 'Room successfully removed from your selection');
        return redirect()->back();
    }

    public function preview()
    {
        if(!Session::has('items') || !Session::has('details')) {
            Session::flash('error_message', 'Session expired. Please select your rooms again');
            redirect()->back();
        }

        $details = Session::get('details');
        $items = Session::get('items');

        $records = [];
        $rooms = [];
        foreach($items as $key => $item) {
            $room = RoomType::find($key);
            $records[$room->id] = $item;
            $rooms[] = $room;
        }
        $startDate = \DateTime::createFromFormat('Y-m-d', $details['start_date']);
        $endDate = \DateTime::createFromFormat('Y-m-d', $details['end_date']);

        $diff = date_diff($startDate, $endDate);
        $diff = $diff->days;
        $backUrl = url()->previous();
        $tax = setting('tax');

        return view('reservation.checkout', compact('items', 'rooms', 'details', 'diff', 'backUrl', 'tax'));
    }

    public function reserve()
    {
        if(!Session::has('items') || !Session::has('details')) {
            Session::flash('error_message', 'Session expired. Please select your rooms again');
            redirect()->back();
        }
        //TODO: validate if the room is still available before inserting.

        $details = Session::get('details');
        $items = Session::get('items');
        $id = Auth::user()->id;
        $rand = substr(md5(microtime()),rand(0,26),10);
        $startDate = \DateTime::createFromFormat('Y-m-d', $details['start_date']);
        $endDate = \DateTime::createFromFormat('Y-m-d', $details['end_date']);

        $diff = date_diff($startDate, $endDate);
        $diff = $diff->days;

        $reservation = Reservation::create([
            'start_date' => $details['start_date'],
            'end_date' => $details['end_date'],
            'status' => 'pending',
            'deposit_slip' => '',
            'user_id' => $id,
            'code' => strtoupper($rand),
            'total' => 0,
            'children' => 0,
            'adults' => 0,
        ]);

        foreach($items as $key => $value) {
            for($index = 0; $index < $value; $index++){
                $room = RoomType::find($key);
                ReservationRoom::create([
                    'reservation_id' => $reservation->id,
                    'room_id' => $key,
                    'price' => $room->daily_rate,
                ]);
            }
        }

        $rooms = $reservation->roomTypes()->get();
        $total = 0;
        foreach($rooms as $room) {
            $total += ($room->daily_rate * $diff);
        }

        $reservation->total = $total;
        $reservation->save();

        Mail::to(Auth::user()->email)->send(new ReservationCreated($reservation));

        Session::forget('details');
        Session::forget('items');

        return view('reservation.success');
    }
}