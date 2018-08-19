<?php

namespace App\Http\Controllers;


use App\RoomType;
use Illuminate\Http\Request;
use App\Reservation;
use App\Room;

class GuestController extends Controller
{
    /**
     * Search for rooms
     */
    public function search(Request $request)
    {
        $startDate = \DateTime::createFromFormat("m/d/Y", $request->get('start_date'))->format('Y-m-d');
        $endDate = \DateTime::createFromFormat("m/d/Y", $request->get('end_date'))->format('Y-m-d');

        $reservations = Reservation::whereBetween('start_date', [$startDate, $endDate])->orWhereBetween('end_date', [$startDate, $endDate])->get();
        $roomIDS = [];
        foreach ($reservations as $reservation) {
           $rooms  = $reservation->rooms;
           foreach ($rooms as $room) {
               if (!in_array($room->id, $roomIDS)) {
                   $roomIDS[] = $room->id;
               }
           }
        }

        $rooms = Room::whereIn('id', $roomIDS)->get();
        $roomTypeIDS = [];
        foreach ($rooms as $room) {
            $roomTypeIDS[] = $room->roomType->id;
        }

        $roomTypes = RoomType::whereNotIn('id', $roomTypeIDS)->get();

        //only display room types with rooms
        $finalRoomTypes = [];
        foreach($roomTypes as $type) {
            if ($type->rooms()->count() != 0) {
                $finalRoomTypes[] = $type;
            }
        }

       return view('guest.search', ['roomTypes' => $finalRoomTypes, 'from' => $request->get('start_date'), 'to' => $request->get('end_date'), 'guests' => $request->get('guests') ]);
    }
}