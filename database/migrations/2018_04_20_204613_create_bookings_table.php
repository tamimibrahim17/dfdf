<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_id');
            $table->integer('owner_id');
            $table->integer('booking_type_id');
            $table->string('name');
            $table->string('date');
            $table->string('start');
            $table->string('end');
            $table->string('city')->nullable();
            $table->string('postal')->nullable();
            $table->string('street')->nullable();
            $table->text('description')->nullable();
            $table->integer('repeated')->default(0);
            $table->integer('team_id')->nullable();
            $table->integer('slot_status')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('bookings');
    }
}
