<?php
/**
 * Created by PhpStorm.
 * User: jramos
 * Date: 2/15/19
 * Time: 11:23 PM
 */

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Hash;

class ChangePasswordController
{
    public function showChangePassword()
    {
        $user = Auth::user();
        $layout = '';

        if ($user->hasRole('customer')) {
            $layout = 'layouts.customer';
        }

        if ($user->hasRole('cashier')) {
            $layout = 'layouts.cashier';
        }

        if ($user->hasRole('admin')) {
            $layout = 'layouts.backend';
        }

        return view('auth.changepassword', ['layout' => $layout]);

    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Auth::attempt([
            'email' => $user->email,
            'password' => $request->get('old_password'),
        ])) {
            session()->flash('error_message', 'Incorrect password!');
            return redirect()->back();
        }

        $user->password = Hash::make($request->get('password'));
        $user->save();

        \session()->flash('flash_message', 'Change password success');

        $layout = '';

        if ($user->hasRole('customer')) {
            $layout = 'layouts.customer';
        }

        if ($user->hasRole('cashier')) {
            $layout = 'layouts.cashier';
        }

        if ($user->hasRole('admin')) {
            $layout = 'layouts.backend';
        }

        return view('auth.changepassword', ['layout' => $layout]);
    }
}
