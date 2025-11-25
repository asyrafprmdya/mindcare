<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Hapus tabel lama jika ada agar struktur bersih
        Schema::dropIfExists('patients');

        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            
            // KUNCI UTAMA RELASI: Menghubungkan ke tabel users
            // onDelete('cascade') = Jika User dihapus, data Pasien ikut terhapus otomatis
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->unique();
            
            // Data Pribadi Pasien
            $table->string('phone', 20)->nullable(); // No HP
            $table->date('date_of_birth')->nullable(); // Tanggal Lahir
            $table->enum('gender', ['L', 'P'])->nullable(); // Jenis Kelamin
            $table->text('address')->nullable(); // Alamat Lengkap
            
            // Data Medis/Tambahan (Opsional)
            $table->text('medical_history')->nullable(); // Riwayat Penyakit (jika perlu)
            $table->string('emergency_contact')->nullable(); // Kontak Darurat
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('patients');
    }
};