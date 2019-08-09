<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "Gorgie Wilson";
        $user->email = "admin@platanus.com";
        $user->password = Hash::make("password");
        $user->save();

        $user->roles()->attach(10);
        $user->save();

        $user = new User();
        $user->name = "Arnold Booker";
        $user->email = "cashier@platanus.com";
        $user->password = Hash::make("password");
        $user->save();

        $user->roles()->attach(12);
        $user->save();
    }
}
