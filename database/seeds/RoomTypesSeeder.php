<?php

use Illuminate\Database\Seeder;
use \App\RoomType;

class RoomTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RoomType::create([
            'name' => 'Studio Apartment',
            'description' => 'A simple studio apartment. Good for solo travellers',
            'url' => url(''),
        ]);
    }
}
