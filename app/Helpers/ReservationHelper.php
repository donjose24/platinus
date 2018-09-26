<?php

namespace App\Helpers;

use App\Reservation;
use App\RoomType;
use Session;

class ReservationHelper {

    public static function getAvailableRooms($startDate, $endDate, $dontDisplay = [])
    {
        $startDate = \DateTime::createFromFormat("Y-m-d", $startDate)->format('Y-m-d');
        $endDate = \DateTime::createFromFormat("Y-m-d", $endDate)->format('Y-m-d');

        $details = [
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];

        if(!Session::has('details')) {
            Session::put('details', $details);
        } else {
            $savedDetails = Session::get('details');
            if($savedDetails != $details) {
                Session::put('details', $details);
                Session::forget('items');
            }
        }

        $reservations = Reservation::whereBetween('start_date', [$startDate, $endDate])->orWhereBetween('end_date', [$startDate, $endDate])->where('status', '!=','checked_out')->where('status', '!=', 'cancelled')->get();

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

        foreach($roomTypes as $type) {
            $max = $type->rooms()->where('status', '!=', 'inactive')->count();
            if($max <= $rooms[$type->id]) {
                $dontDisplay[] = $type->id;
            }
        }

        $roomTypes = RoomType::has("validRooms")->whereNotIn('id', $dontDisplay)->get();

        return ['roomTypes' => $roomTypes, 'rooms' => $rooms];
    }
}