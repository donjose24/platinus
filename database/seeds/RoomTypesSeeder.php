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
            'name' => 'Studio Single Room',
            'description' => 'An Air-Conditioned Room with One Double-Sized Bed, Flat-Screen TV with cable, Free WiFi and Private Bathroom.',
            'image_url' => 'https://i.imgur.com/SUxe3jD.jpg',
            'daily_rate' => 3000,
            'weekly_rate' => 10500,
            'capacity' => 2,
        ]);

        RoomType::create([
            'name'  => 'Studio Twin Room',
            'description' => 'An Air-Conditioned Room with Two Double-Sized Bed, Flat-Screen TV with cable, Dining Area, Kitchenette, Free WiFi and Private Bathroom.',
            'image_url' => 'https://occupancy.plus/images/rooms/f6a848d482ad64b01d4091fb478ec616.jpg',
            'daily_rate' => 3200,
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
