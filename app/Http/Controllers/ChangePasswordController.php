<?php
/**
 * Created by PhpStorm.
 * User: jramos
 * Date: 2/15/19
 * Time: 11:23 PM
 */

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Hash;

class ChangePasswordController
{
    public function changePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->get('password'));
        $user->save();

        \session()->flash('flash_message', 'Change password success');
    }
}
