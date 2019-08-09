<?php

use Illuminate\Database\Seeder;
use App\Page;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::create([
            'title' => 'Front Page',
            'content' => '
                        <p>Platanus is an established hotel in Barrio Barretto that offers leisure and recreation
                        within the hustle of Barretto, Olongapo City. Only 10 minutes away from the bars and
                        restaurants that offer a broad selection of diverse cuisines from all over the world. </p>

                        <p>The hotel ensures guests comfort and gives them the quality service. With 9 spacious air-conditioned rooms,
                        among the amenities offered are complimentary Wi-Fi access, non-smoking rooms, cable TV, air-conditioned rooms,
                        private bathroom with hot and cold water, some rooms have access to a balcony.</p>

                        <p>Take a breather in the hotel\'s incredible facilities like an outdoor swimming pool, fitness center, massage, and garden area where you can sit back and laze.</p>
                        <p>Hotel Platanus is an excellent choice for quality accommodation in Barretto for daily and long term stay.</p>',
        ]);

        Page::create([
            'title' => 'Side Description',
            'content' => '<p>Set in Clark, 32 km from Mount Pinatubo, Platanus Hotel features an outdoor swimming pool.
                        Featuring a restaurant, the property also has a garden. The property offers a 24-hour front desk. </p>',
        ]);
    }
}
