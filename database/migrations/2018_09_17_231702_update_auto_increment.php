<?php

use Illuminate\Database\Migrations\Migration;

class UpdateAutoIncrement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::update("ALTER TABLE users AUTO_INCREMENT = 10;");
        DB::update("ALTER TABLE rooms AUTO_INCREMENT = 10;");
        DB::update("ALTER TABLE room_types AUTO_INCREMENT = 10;");
        DB::update("ALTER TABLE transactions AUTO_INCREMENT = 10;");
        DB::update("ALTER TABLE reservations AUTO_INCREMENT = 10;");
        DB::update("ALTER TABLE reservation_rooms AUTO_INCREMENT = 10;");
        DB::update("ALTER TABLE services AUTO_INCREMENT = 10;");
        DB::update("ALTER TABLE roles AUTO_INCREMENT = 10;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
