<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/customer';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticated(Request $request, $user)
    {
        if (Session::has('reroute') && $user->hasRole("customer")) {
            $this->redirectTo = Session::get('reroute');
        } else if ($user->hasRole("customer")) {
            $this->redirectTo = "/customer";
        } else if ($user->hasRole("cashier")) {
            $this->redirectTo = "/cashier";
        } else if ($user->hasRole('admin')) {
            $this->redirectTo = "/admin";
        }
    }
    public function redirect()
    {
        $user = Auth::user();
        if (Session::has('reroute') && $user->hasRole("customer")) {
            return redirect('reroute');
        } else if ($user->hasRole("customer")) {
            return redirect('customer');
        } else if ($user->hasRole("cashier")) {
            return redirect('cashier');
        } else if ($user->hasRole('admin')) {
            return redirect('admin');
        }
    }
}
