<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->date('from_date')->nullable();
            $table->integer('reservation_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->date('to_date')->nullable();
            $table->tinyInteger('is_paid')->nullable();
            $table->string('deposit_slip')->nullable();
            $table->dateTime('expiration_date')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transactions');
    }
}
