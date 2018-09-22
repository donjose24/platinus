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
        $user->email = "admin@bellamonte.com";
        $user->password = Hash::make("password");
        $user->save();

        $user->roles()->attach(11);
        $user->save();

        $user = new User();
        $user->name = "Arnold Booker";
        $user->email = "Cashier@bellamonte.com";
        $user->password = Hash::make("password");
        $user->save();

        $user->roles()->attach(31);
        $user->save();
    }
}
