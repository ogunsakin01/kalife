<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HotelBookings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->text('reference');
            $table->text('pnr');
            $table->text('check_in_date');
            $table->text('check_out_date');
            $table->integer('guests');
            $table->text('hotel_name');
            $table->text('hotel_city_code');
            $table->text('hotel_code');
            $table->text('hotel_chain_code');
            $table->text('room_rph');
            $table->integer('booking_status');
            $table->integer('payment_status');
            $table->integer('cancel_status');
            $table->longText('room_info');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('hotel_bookings');
    }
}
