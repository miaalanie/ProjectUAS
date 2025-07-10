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
        Schema::create('diagnoses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('sensor_reading_id');
            $table->decimal('hasil_fuzzy', 5, 3); // nilai fuzzy logic (misal: 0.783)
            $table->unsignedBigInteger('mood_id');
            $table->unsignedBigInteger('snack_id')->nullable(); // snack pilihan user, bisa null dulu
            $table->timestamps();
            $table->softDeletes();

            // Foreign key references
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('sensor_reading_id')->references('id')->on('sensor_readings')->onDelete('cascade');
            $table->foreign('mood_id')->references('id')->on('moods')->onDelete('cascade');
            $table->foreign('snack_id')->references('id')->on('snacks')->onDelete('set null');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
