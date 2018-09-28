<?php

namespace App\Http\Controllers\Cashier;


use App\Helpers\ReservationHelper;
use App\Mail\ReservationApproved;
use App\Mail\ReservationRejected;
use App\Reservation;
use App\ReservationRoom;
use App\Room;
use App\RoomType;
use App\Service;
use App\Transaction;
use Auth;
use Carbon\Carbon;
use App\User;
use PDF;
use Hash;
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
        $services = Service::all();

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
            $max = $type->rooms()->where('status', '!=', 'inactive')->count();
            if($max <= $rooms[$type->id]) {
                $dontDisplay[] = $type->id;
            }
        }

        $roomTypes = RoomType::has("validRooms")->whereNotIn('id', $dontDisplay)->get();

        $diff = date_diff($startDate, $endDate);
        $diff = $diff->days;

        $reservation = Reservation::find($id);
        $tax = setting('tax');

        return view('cashier.show', compact('reservation', 'diff', 'roomTypes', 'services', 'tax'));
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
        $totalPrice = (ReservationRoom::where('reservation_id', $reservation->id)->sum('price') * $diff);
        $tax = setting('tax');
        $totalPrice += $totalPrice * ($tax / 100);
        $toBeDeposited = 0;

        if ($diff < 7) {
            $toBeDeposited = $totalPrice;
        }

        if($diff >= 7) {
            $toBeDeposited = ($totalPrice * .8);
        }


        return view('cashier.view', compact('reservation', 'diff', 'toBeDeposited'));
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

        $startDate = \DateTime::createFromFormat('Y-m-d', $reservation->start_date);
        $endDate = \DateTime::createFromFormat('Y-m-d', $reservation->end_date);

        $diff = date_diff($startDate, $endDate);
        $diff = $diff->days;

        $totalPrice = ReservationRoom::where('reservation_id', $reservation->id)->sum('price') * $diff;
        $tax = setting('tax');
        $totalPrice += $totalPrice * ($tax / 100);
        if($totalPrice < $amount) {
            Session::flash('error_message', 'Invalid amount entered.');
            return redirect()->back();
        }

        if($diff < 7) {
            if ($totalPrice !=  $amount) {
                Session::flash('error_message', 'Full amount is required for booking less than 7 nights');
                return redirect()->back();
            }
        }

        if($diff >= 7) {
            if(($totalPrice * .8) > $amount) {
                Session::flash('error_message', '20% payment is required for booking more than 7 nights');
                return redirect()->back();
            }
        }

        $reservation->status = "approved";
        $reservation->save();

        $transaction = new Transaction();
        $transaction->item = "Bank Deposit";
        $transaction->price = $amount;
        $transaction->reservation_id = $reservation->id;
        $transaction->status = 'paid';
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
        $id = $request->get('id');
        $count = ReservationRoom::where('reservation_id', $id)->where('room_number_id', 0)->count();

        if ($count != 0) {
            Session::flash('error_message', 'Please complete all room reservation first');
            return redirect()->back();
        }

        $rooms = ReservationRoom::where('reservation_id', $id)->pluck('room_number_id');

        foreach($rooms as $room) {
            $item = Room::find($room);
            $item->status = 'checked-in';
            $item->save();
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

        $transactions = Transaction::where('reservation_id', $reservation->id)->where('item', '!=', 'Bank Deposit')->where('item', '!=', 'Balance Payment')->get();

        $diff = date_diff($startDate, $endDate);
        $diff = $diff->days;
        $tax = setting('tax');

        $pdf = PDF::loadView('reports.reservation', compact('reservation', 'diff', 'transactions', 'tax'));
        return $pdf->stream();
    }

    public function checkOut(Request $request)
    {
        $id = $request->get('id');
        $discount = $request->get('senior_discount');

        $reservation = Reservation::find($id);
        $reservation->status = "checked_out";
        $reservation->is_senior = $discount == "apply";
        $startDate = \DateTime::createFromFormat('Y-m-d', $reservation->start_date);
        $endDate = \DateTime::createFromFormat('Y-m-d', $reservation->end_date);
        $diff = date_diff($startDate, $endDate)->days;
        $reservation->save();


        $dt = new \DateTime();
        $endDate = \DateTime::createFromFormat('Y-m-d', $reservation->end_date);
        $endDate->setTime(12, 0);
        $indicator = $endDate->diff($dt)->format("%r%a");
        $difference = $endDate->diff($dt)->h;
        //balance computation
        $total = 0;
        $totalPaid = 0;
        foreach($reservation->roomTypes()->withPivot('price')->get() as $room) {
            $total += ($room->pivot->price * $diff);
        }

        //set all room to ready
        $records = ReservationRoom::where('reservation_id', $id)->get();
        foreach($records as $record) {
            $room = Room::find($record->room_number_id);
            $room->status = "ready";
            $room->save();
        }

        if ($indicator >= 0) {
            $transaction = new Transaction();
            $transaction->item = "Penalty (Overstay)";
            $transaction->price = $difference * 100;
            $transaction->save();
        }


        foreach($reservation->transactions()->get() as $transaction) {
            if($transaction->item != "Bank Deposit") {
                $total += $transaction->price;
            }
            $transaction->status = "paid";
            $transaction->save();

            if ($transaction->status == "paid") {
                $totalPaid += $transaction->price;
            }
        }

        $tax = setting('tax');
        $total += $total * ($tax / 100);

        // insert balance payment on the transactions table
        if ($totalPaid < $total) {
            $balance = $total - $totalPaid;

            $transaction = new Transaction();
            $transaction->item = "Balance Payment";
            $transaction->reservation_id = $id;
            $transaction->price = $balance;
            $transaction->status = "paid";
            $transaction->save();
        }

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
        $reservationID = $request->get('reservation_id');

        $reservationLoad = ReservationRoom::find($reservationID);
        $roomID = $reservationLoad->room_number_id;
        $reservationLoad->delete();

        if ($roomID != 0) {
            $room = Room::find($roomID);
            $room->status = "ready";
            $room->save();
        }

        Session::flash('flash_message', 'Room successfully deleted');
        return redirect()->back();
    }

    public function addRoom(Request $request)
    {
        $roomID = $request->get('room_id');
        $reservationID = $request->get('reservation_id');
        $roomTypeID = $request->get('room_type_id');

        //add the room to the reservation
        $type = RoomType::find($roomTypeID);
        $reservationLoad = new ReservationRoom();
        $reservationLoad->reservation_id = $reservationID;
        $reservationLoad->price = $type->daily_rate;
        $reservationLoad->room_id = $roomTypeID;
        $reservationLoad->room_number_id = $roomID;
        $reservationLoad->save();

        //set the room to "checked_in"
        $room = Room::find($roomID);
        $room->status = "checked-in";
        $room->save();

        Session::flash('flash_message', 'Room successfully added');
        return redirect()->back();
    }

    public function addServices(Request $request)
    {
        $name = $request->get('name');
        $price = $request->get('price');
        $quantity = $request->get('quantity');
        $reservationID = $request->get('reservation_id');

        $transaction = new Transaction();
        $transaction->item = $name;
        $transaction->price = $price * $quantity;
        $transaction->status = "unpaid";
        $transaction->reservation_id = $reservationID;
        $transaction->save();

        Session::flash('flash_message', 'Item successfully added');
        return redirect()->back();
    }

    public function removeService($id)
    {
        $transaction = Transaction::find($id);
        $transaction->delete();

        Session::flash('flash_message', 'Item successfully removed');
        return redirect()->back();
    }

    public function settleTransaction($id)
    {
        $transaction = Transaction::find($id);
        $transaction->status = "paid";
        $transaction->save();

        Session::flash('flash_message', 'Transaction successfully settled');
        return redirect()->back();
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

    public function rooms()
    {
        $rooms = Room::all();

        return view('cashier.rooms', compact('rooms'));
    }

    public function markAsInactive(Request $request)
    {
        $id = $request->get('room_id');

        $room = Room::findOrFail($id);
        $room->status = "inactive";
        $room->save();

        Session::flash('flash_message', 'Room set as inactive');
        return redirect()->back();
    }

    public function markAsActive(Request $request)
    {
        $id = $request->get('room_id');

        $room = Room::findOrFail($id);
        $room->status = "ready";
        $room->save();

        Session::flash('flash_message', 'Room set as active');
        return redirect()->back();
    }

    public function showWalkIn()
    {
        return view('cashier.walk-in');
    }

    public function showWalkInRooms(Request $request)
    {
        $today = $request->get('check_in_date');
        $checkOutDate = $request->get('check_out_date');

        $rules = [
            'check_in_date' => 'required|date|date_format:Y-m-d|before:check_out_date',
            'check_out_date' => 'required|date|date_format:Y-m-d|after:check_in_date',
        ];

        //this will redirect back on validation error
        $request->validate($rules);

        $result = ReservationHelper::getAvailableRooms($today, $checkOutDate);
        $roomTypes = $result['roomTypes'];
        $rooms = $result['rooms'];
        return view('cashier.walk-in-rooms', ['roomTypes' => $roomTypes, 'rooms' => $rooms, 'today' => $today, 'checkOutDate' => $checkOutDate]);
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

        $items = [];
        if (Session::has('items')) {
            $items = Session::get('items');
        }

        $items[$id] = $quantity;

        Session::put('items', $items);
        Session::flash('flash_message', 'Room successfully added to your selection');

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

        return view('cashier.walk-in-checkout', compact('items', 'rooms', 'details', 'diff', 'backUrl', 'tax'));
    }

    public function reserve(Request $request)
    {
        if(!Session::has('items') || !Session::has('details')) {
            Session::flash('error_message', 'Session expired. Please select your rooms again');
            redirect()->back();
        }

        $request->validate(['name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
            ]
        );

        //create the user first
        $data = $request->all();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make('passowrd'),
            'contact_number' => "123456",
        ]);

        //TODO: validate if the room is still available before inserting.

        $details = Session::get('details');
        $items = Session::get('items');
        $id = $user->id;
        $rand = substr(md5(microtime()),rand(0,26),10);
        $startDate = \DateTime::createFromFormat('Y-m-d', $details['start_date']);
        $endDate = \DateTime::createFromFormat('Y-m-d', $details['end_date']);

        $diff = date_diff($startDate, $endDate);
        $diff = $diff->days;

        $reservation = Reservation::create([
            'start_date' => $details['start_date'],
            'end_date' => $details['end_date'],
            'status' => 'approved',
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

        Session::forget('details');
        Session::forget('items');

        return redirect('/cashier/reservation/' . $reservation->id);
    }

    public function reserveRoom(Request $request)
    {
        $request->validate([
            'room' => 'required|not_in:-1,',
        ], [
            'rooms.*' => 'Invalid Room Number'
        ]);


        $room = $request->get('room');
        $roomType = RoomType::find($request->get('room_type'));
        $id = $request->get('id');

        $discount = $request->get('senior_discount');
        $rate = $roomType->daily_rate;
        if ($discount == "apply") {
            $seniorDiscount = setting('senior_pwd_discount');
            $rate -= $rate * ($seniorDiscount / 100);
        }
        $roomLoad = ReservationRoom::find($id);
        $roomLoad->room_number_id = $room;
        $roomLoad->price = $rate;
        $roomLoad->save();

        return redirect()->back();
    }

    public function getAvailableUpgradeRooms(Request $request)
    {
        $room = $request->get('room_type_id');
        $id = $request->get('reservation_id');

        $reservation = Reservation::find($id);
        $roomType = RoomType::find($room);
        $dontDisplay = RoomType::where('daily_rate', '<', $roomType->daily_rate)->pluck('id');
        $dontDisplay[] = $room;

        $roomTypes = ReservationHelper::getAvailableRooms($reservation->start_date, $reservation->end_date, $dontDisplay);
        return json_encode($roomTypes['roomTypes']);
    }

    public function upgrade(Request $request)
    {
        $roomType = $request->get('room_type_id');
        $reservationRoomID = $request->get('reservation_room_id');

        $type = RoomType::find($roomType);
        $reservationLoad = ReservationRoom::find($reservationRoomID);
        $reservationLoad->room_id = $roomType;
        $reservationLoad->price = $type->daily_rate;
        $oldRoomNumber = $reservationLoad->room_number_id;
        $reservationLoad->room_number_id = 0;

        $reservationLoad->save();

        if ($oldRoomNumber != 0) {
            $room = Room::find($oldRoomNumber);
            $room->status = "ready";
            $room->save();
        }


        Session::flash('flash_message', 'Update success');
        return redirect()->back();
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
        $reservation->save();

        foreach($roomsWillBeRemoved as $room) {
            $room = ReservationRoom::where('reservation_id',$reservationID)->where('room_id', $room)->first();
            $room->delete();
        }

        return redirect()->to('/cashier/reservation/'. $reservation->id);
    }
}