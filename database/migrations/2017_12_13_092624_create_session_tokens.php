<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionTokens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('session_tokens', function (Blueprint $table) {
            $table->increments('id');
            $table->text('message_id');
            $table->longText('token');
            $table->longText('conv_id');
            $table->integer('available_status')->default('1');
            $table->integer('closed_status')->default("0");
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
        Schema::dropIfExists('session_tokens');
    }
}
