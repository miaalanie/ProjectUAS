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
      Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable(); // biar guest tanpa email bisa masuk
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable(); // guest ga perlu password
            $table->enum('role', ['admin', 'user', 'guest'])->default('guest');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes(); // untuk deleted_at
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
