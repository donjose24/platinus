<?php

namespace App\Http\Controllers\Customer;


use App\Reservation;
use Illuminate\Support\Facades\Auth;

class BookingController
{
    public function index()
    {
        $user = Auth::user();
        $reservations = Reservation::where('user_id', $user->id)->paginate(25);

        return view('customer.booking.index', compact('reservations'));
    }
}