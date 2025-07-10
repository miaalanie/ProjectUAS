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
       Schema::create('snacks', function (Blueprint $table) {
        $table->id();
        $table->string('nama_snack');
        $table->string('foto_snack')->nullable(); // URL/path gambar, optional
        $table->text('kandungan_gizi'); // info nutrisi
        $table->timestamps();
        $table->softDeletes(); // untuk deleted_at
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
