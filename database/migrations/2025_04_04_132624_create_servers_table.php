<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama server
            $table->string('ip_address')->unique(); // IP Address unik
            $table->string('location'); // Lokasi server
            $table->integer('memory_gb')->nullable(); // opsional
            $table->integer('storage_gb')->nullable(); // opsional
            $table->integer('status')->default(1); // Status (1 = Aktif, 0 = Nonaktif)
            $table->string('lokasi_pengaju')->nullable(); // Status (1 = Aktif, 0 = Nonaktif)
            $table->string('pengaju')->nullable(); // Status (1 = Aktif, 0 = Nonaktif)
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('servers');
    }
};
