<?php

namespace App\Http\Controllers\Customer;


use App\Http\Controllers\Controller;
use App\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Imgur;

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
}