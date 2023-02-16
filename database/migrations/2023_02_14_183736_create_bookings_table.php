<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('slot_id');
            $table->string('name', 200);
            $table->string('email');
            $table->string('phone', 60);
            $table->string('vehicle_make', 60);
            $table->string('vehicle_model', 60);
            $table->date('booking_date');
            $table->timestamps();

            $table->foreign('slot_id')->references('id')->on('time_slots');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
