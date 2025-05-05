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
        Schema::create('aplikasi', function (Blueprint $table) {
            $table->id();
            
            // Identitas Aplikasi
            $table->string('nama_aplikasi');
            $table->string('jenis_aplikasi'); // Web, Mobile, Desktop, dll
        
            // Keperluan dan Deskripsi
            $table->text('deskripsi')->nullable();
            $table->string('pengaju'); // bisa dihubungkan ke users table
            $table->text('alasan_pengajuan')->nullable();
        
            // Lokasi & Kebutuhan
            $table->string('lokasi_penempatan')->nullable();
            
            // Status Pengajuan
            $table->integer('status')->default(1);
        
            // Tanggal
            $table->timestamp('tanggal_pengajuan')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aplikasi');
    }
};
