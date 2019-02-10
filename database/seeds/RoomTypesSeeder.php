<?php

use Illuminate\Database\Seeder;
use App\RoomType;
use App\Room;

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
            'name' => 'Studio Twin Room',
            'description' => 'Air-conditioned, Queen sized bed, Hot and Cold shower, TV with Cable, Complimentary Use of the swimming pool,
Free Wifi',
            'image_url' => 'https://occupancy.plus/images/rooms/6e74766b5cfaced732955a8f1d857f70.jpg',
            'daily_rate' => 1600,
            'weekly_rate' => 10500,
            'capacity' => 2,
        ]);

        RoomType::create([
            'name'  => 'Studio Twin Room',
            'description' => 'Air conditioned, hot and cold shower, free Wifi, swimming pool, and cable T.V.  twin bed',
            'image_url' => 'https://occupancy.plus/images/rooms/f6a848d482ad64b01d4091fb478ec616.jpg',
            'daily_rate' => 2000,
            'weekly_rate' => 12000,
            'capacity' => 2,
        ]);

        Room::create([
            'number'  => '301',
            'room_type_id' => '21',
            'status' => 'ready',
            'note' => '',
        ]);

        Room::create([
            'number'  => '402',
            'room_type_id' => '21',
            'status' => 'ready',
            'note' => '',
        ]);

        Room::create([
            'number'  => '101',
            'room_type_id' => '11',
            'status' => 'ready',
            'note' => '',
        ]);

        Room::create([
            'number'  => '102',
            'room_type_id' => '11',
            'status' => 'ready',
            'note' => '',
        ]);

        \App\Service::create([
            'name' => 'Bed',
            'price' => 100,
            'quantity' => 15,
        ]);
    }
}
