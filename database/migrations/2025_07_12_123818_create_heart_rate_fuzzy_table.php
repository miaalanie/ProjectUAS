<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeartRateFuzzyTable extends Migration
{
    public function up()
    {
        Schema::create('heart_rate_fuzzy', function (Blueprint $table) {
            $table->id();
            $table->integer('min')->nullable(); // Boleh null untuk < 60
            $table->integer('max')->nullable(); // Boleh null untuk > 90
            $table->string('label'); // HR Lambat, dll.
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('heart_rate_fuzzy');
    }
}
