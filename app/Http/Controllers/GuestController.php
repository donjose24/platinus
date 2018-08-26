<?php

namespace App\Http\Controllers;


use App\RoomType;
use Illuminate\Http\Request;
use App\Reservation;
use Illuminate\Support\Facades\Auth;
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
            'guests' => 'required|numeric',
        ];

        //this will redirect back on validation error
        $request->validate($rules);

        $startDate = \DateTime::createFromFormat("Y-m-d", $request->get('start_date'))->format('Y-m-d');
        $endDate = \DateTime::createFromFormat("Y-m-d", $request->get('end_date'))->format('Y-m-d');
        $guests = $request->get('guests');

        $reservations = Reservation::whereBetween('start_date', [$startDate, $endDate])->orWhereBetween('end_date', [$startDate, $endDate])->get();

        //this will hold the value of room id and its corresponding current quantity in the reservations selected
        $rooms = [];
        foreach ($reservations as $reservation) {
            $roomTypes = $reservation->roomTypes()->pluck('room_types.id');
            foreach ($roomTypes as $room) {
                $rooms[$room] = 0;
            }
        }

        foreach ($reservations as $reservation) {
            foreach($reservation->roomTypes()->get() as $type) {
                foreach($rooms as $key => $room) {
                    if($type->id == $key) {
                        $rooms[$key] = $room + 1 ;
                    }
                }
            }
        }

        $roomTypes = RoomType::whereIn('id', array_keys($rooms))->get();
        $dontDisplay = [];

        foreach($roomTypes as $type) {
            $max = $type->rooms()->where('status', 'active')->count();
            if($max <= $rooms[$type->id]) {
                $dontDisplay[] = $type->id;
            }
        }

        $roomTypes = RoomType::has("validRooms")->whereNotIn('id', $dontDisplay)->get();

        return view('guest.search', compact('roomTypes', 'startDate', 'endDate', 'guests', 'rooms'));
    }
}