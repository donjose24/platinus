<?php

use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Setting::create([
            'key' => 'senior_pwd_discount',
            'value' => '20',
        ]);
        \App\Setting::create([
            'key' => 'tax',
            'value' => '12',
        ]);
         \App\Setting::create([
            'key' => 'downpayment',
            'value' => '20',
        ]);
    }
}