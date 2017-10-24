<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventTrackingTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('event_tracking', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->date('sent_date');
            $table->integer('event_count');
            $table->string('action');
            $table->dateTime('open_date')->nullable();
            $table->dateTime('click_date')->nullable();
            $table->timestamps();
        });
        Schema::create('event_tracking_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_tracking_id')->unsigned();
            $table->integer('event_id')->unsigned();
            $table->dateTime('click_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('event_tracking_items');
        Schema::dropIfExists('event_tracking');
    }
}
