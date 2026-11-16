<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('anggota', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama', 100);
            $table->string('jabatan', 50)->nullable();
            $table->enum('status_iuran', ['lunas', 'belum'])->default('belum');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });

        DB::statement('ALTER TABLE anggota
            ADD iv VARBINARY(16) NOT NULL AFTER jabatan,
            ADD nik VARBINARY(255) NOT NULL AFTER iv,
            ADD no_hp VARBINARY(255) NULL AFTER nik,
            ADD alamat VARBINARY(512) NULL AFTER no_hp');

        DB::unprepared('CREATE OR REPLACE VIEW v_iuran_anggota AS
            SELECT id, nama, jabatan, status_iuran FROM anggota');

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_tambah_anggota');
        DB::unprepared(<<<'SQL'
CREATE PROCEDURE sp_tambah_anggota(
    IN p_nama VARCHAR(100), IN p_jabatan VARCHAR(50),
    IN p_nik VARCHAR(16), IN p_hp VARCHAR(20), IN p_alamat VARCHAR(255))
BEGIN
  DECLARE v_iv VARBINARY(16);
  SET v_iv = RANDOM_BYTES(16);
  INSERT INTO anggota (nama, jabatan, iv, nik, no_hp, alamat)
  VALUES (p_nama, p_jabatan, v_iv,
          AES_ENCRYPT(p_nik,    @kunci, v_iv),
          AES_ENCRYPT(p_hp,     @kunci, v_iv),
          AES_ENCRYPT(p_alamat, @kunci, v_iv));
END
SQL);
    }

    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_tambah_anggota');
        DB::unprepared('DROP VIEW IF EXISTS v_iuran_anggota');
        Schema::dropIfExists('anggota');
    }
};