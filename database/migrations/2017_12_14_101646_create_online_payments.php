<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnlinePayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('online_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->text('txn_reference');
            $table->bigInteger('amount');
            $table->integer("gateway_id");
            $table->text('response_code')->nullable();
            $table->longText('response_description')->nullable();
            $table->integer('payment_status')->defaut('0');
            $table->longText('response_full')->nullable();
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
        Schema::dropIfExists('online_payments');
    }
}
