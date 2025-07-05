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
        Schema::create('tbnilai', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idmatkul');
            $table->string('nim');
            $table->string('semester');
            $table->string('tahunajar');
            $table->float('nilai');
            $table->string('grade');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            
            // foreign key
            $table->foreign('idmatkul')->references('id')->on('tbmatkul')->onDelete('cascade');
            $table->foreign('nim')->references('nim')->on('tbmahasiswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbnilai');
    }
};
