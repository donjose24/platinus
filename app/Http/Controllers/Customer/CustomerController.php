<?php

namespace App\Http\Controllers\Customer;


use App\Http\Controllers\Controller;
use App\Reservation;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $reservations = Reservation::where('user_id', $user->id)->where('status', 'pending')->get();

        return view('customer.dashboard', compact('user', 'reservations'));
    }
}