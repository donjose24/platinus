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

        $user->roles()->attach(1);
        $user->save();

        $user = new User();
        $user->name = "Benedic Cucumber";
        $user->email = "Cashier@bellamonte.com";
        $user->password = Hash::make("password");
        $user->save();

        $user->roles()->attach(3);
        $user->save();
    }
}
