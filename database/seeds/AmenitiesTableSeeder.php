<?php

use Illuminate\Database\Seeder;
use App\Amenity;

class AmenitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Amenity::create([
            'title' => 'Transport Services',
            'sub_title' => '10-15 Persons',
            'image' => 'https://i.imgur.com/ZAibtOq.jpg',
            'description' => 'From Clark Pampanga to our Hotel',
        ]);

        Amenity::create([
            'title' => 'Swimming Pool',
            'sub_title' => '20 People Capacity',
            'image' => 'https://i.imgur.com/TUeyqTr.jpg',
            'description' => 'Open 24/7',
        ]);

        Amenity::create([
            'title' => 'Ping Pong Table',
            'sub_title' => '',
            'image' => 'https://i.imgur.com/RakUdLw.jpg',
            'description' => '',
        ]);

        Amenity::create([
            'title' => 'Cafeteria',
            'sub_title' => '',
            'image' => 'https://i.imgur.com/YcHjHny.jpg',
            'description' => '',
        ]);

        Amenity::create([
            'title' => 'Laundry',
            'sub_title' => 'Monday to Saturday',
            'image' => 'https://i.imgur.com/Ij9WKAL.jpg',
            'description' => '',
        ]);

        Amenity::create([
            'title' => 'Family KTV',
            'sub_title' => 'Upon Reservation',
            'image' => 'https://i.imgur.com/2HmJ1Ok.jpg',
            'description' => '',
        ]);
    }
}
