<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audit_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id')->nullable()->index();
            $table->string('aksi', 20);
            $table->string('tabel', 50)->nullable();
            $table->unsignedInteger('record_id')->nullable();
            $table->string('keterangan', 255)->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->timestamp('waktu')->useCurrent();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_log');
    }
};