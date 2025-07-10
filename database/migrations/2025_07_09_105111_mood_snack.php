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
        Schema::create('mood_snack', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('mood_id');
        $table->unsignedBigInteger('snack_id');
        $table->timestamps();

        // Foreign key constraints
        $table->foreign('mood_id')->references('id')->on('moods')->onDelete('cascade');
        $table->foreign('snack_id')->references('id')->on('snacks')->onDelete('cascade');

        // Optional: prevent duplicate entries
        $table->unique(['mood_id', 'snack_id']);
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
