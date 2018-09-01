<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = "admin";
        $role->label = "Administrator";
        $role->save();

        $role = new Role();
        $role->name = "customer";
        $role->label = "Customer";
        $role->save();

        $role = new Role();
        $role->name = "Cashier";
        $role->label = "Cashier";
        $role->save();
    }
}
