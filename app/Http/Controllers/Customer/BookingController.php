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

    public function show($id)
    {
        $reservation = Reservation::findOrFail($id);
        $startDate = \DateTime::createFromFormat('Y-m-d', $reservation->start_date);
        $endDate = \DateTime::createFromFormat('Y-m-d', $reservation->end_date);

        $diff = date_diff($startDate, $endDate);
        $diff = $diff->days;
        $expiration = date_diff(new \DateTime(), $startDate)->days;

        return view('customer.booking.view', compact('reservation', 'diff', 'expiration'));
    }
}
