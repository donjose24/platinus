<?php

namespace App\Http\Controllers\Cashier;


use App\Mail\ReservationApproved;
use App\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CashierController
{
    public function index()
    {
        $id = Auth::user();
        $reservations = Reservation::where('status', 'waiting_for_approval')->where('user_id', $id)->get();

        return view('customer.dashboard', compact('reservations'));
    }

    public function approve(Request $request)
    {
        $id = $request->get('id');

        $reservation = Reservation::findOrFail($id);
        $reservation->status = "approved";
        $reservation->save();

        Mail::to(Auth::user()->email)->send(new ReservationApproved($reservation));

        Session::flash('info_message', 'Reservation approved');
        return redirect('back');
    }

    public function reject(Request $request)
    {
        $id = $request->get('id');
        $reason = $request->get('reason');

        $reservation = Reservation::findOrFail($id);
        $reservation->status = "pending";
        $reservation->image_url = '';
        $reservation->save();

        Session::flash('info_message', 'Reservation rejected');
        return redirect('back');
    }
}