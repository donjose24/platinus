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
            'name' => 'Standard Room',
            'description' => 'Air-conditioned, Queen sized bed, Hot and Cold shower, TV with Cable, Complimentary Use of the swimming pool,
Free Wifi',
            'image_url' => 'https://occupancy.plus/images/rooms/6e74766b5cfaced732955a8f1d857f70.jpg',
            'daily_rate' => 1600,
            'weekly_rate' => 10500,
            'capacity' => 2,
        ]);

        RoomType::create([
            'name'  => 'Standard Room Twin Bed',
            'description' => 'Air conditioned, hot and cold shower, free Wifi, swimming pool, and cable T.V.  twin bed',
            'image_url' => 'https://occupancy.plus/images/rooms/f6a848d482ad64b01d4091fb478ec616.jpg',
            'daily_rate' => 2000,
            'weekly_rate' => 12000,
            'capacity' => 2,
        ]);

        RoomType::create([
            'name'  => 'Fan Room',
            'description' => '1 Double sized bed, Fan ventilated, bathroom with hot and cold shower	2',
            'image_url' => 'https://occupancy.plus/images/rooms/6aa91d6eb855f24f2da5362d99ee37ab.jpg',
            'daily_rate' => 950,
            'weekly_rate' => 4500,
            'capacity' => 2,
        ]);

        RoomType::create([
            'name'  => 'Studio Type',
            'description' => 'Air conditioned, hot and cold shower, free Wifi, swimming pool, and cable T.V.  Double bed',
            'image_url' => 'https://occupancy.plus/images/rooms/e382052d9e0b7d17f3e56c698ff3948e.jpg',
            'daily_rate' => 2500,
            'weekly_rate' => 16000,
            'capacity' => 2,
        ]);

        Room::create([
            'number'  => '401',
            'room_type_id' => '4',
            'status' => 'active',
            'note' => '',
        ]);

        Room::create([
            'number'  => '405',
            'room_type_id' => '4',
            'status' => 'active',
            'note' => '',
        ]);

        Room::create([
            'number'  => '301',
            'room_type_id' => '3',
            'status' => 'active',
            'note' => '',
        ]);

        Room::create([
            'number'  => '402',
            'room_type_id' => '3',
            'status' => 'active',
            'note' => '',
        ]);

        Room::create([
            'number'  => '101',
            'room_type_id' => '1',
            'status' => 'active',
            'note' => '',
        ]);

        Room::create([
            'number'  => '102',
            'room_type_id' => '1',
            'status' => 'active',
            'note' => '',
        ]);

        Room::create([
            'number'  => '103',
            'room_type_id' => '2',
            'status' => 'active',
            'note' => '',
        ]);

        Room::create([
            'number'  => '104',
            'room_type_id' => '2',
            'status' => 'active',
            'note' => '',
        ]);
    }
}
