<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBodyTemperatureFuzzyTable extends Migration
{
    public function up()
    {
        Schema::create('body_temperature_fuzzy', function (Blueprint $table) {
            $table->id();
            $table->float('min')->nullable(); // Untuk batas bawah
            $table->float('max')->nullable(); // Untuk batas atas
            $table->string('label');          // Temp Sangat Dingin, dll.
            $table->string('source')->nullable(); // TA, Jurnal, atau kosong
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('body_temperature_fuzzy');
    }
}
