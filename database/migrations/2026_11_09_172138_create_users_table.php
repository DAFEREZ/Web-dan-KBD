<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 50)->unique();
            $table->string('password_hash', 255);
            $table->unsignedInteger('role_id');
            $table->unsignedInteger('anggota_id')->nullable();
            $table->boolean('is_active')->default(true);
            $table->dateTime('last_login')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('anggota_id')->references('id')->on('anggota');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};