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
        Schema::create('pemeriksaan', function (Blueprint $table) {
            $table->id();
            $table->string('id_hasil');
            $table->foreignId('id_petugas')->constrained('petugas')->onDelete('cascade');
            $table->foreignId('id_checklist')->constrained('checklists')->onDelete('cascade');
            $table->foreignId('id_kendaraan')->constrained('kendaraans')->onDelete('cascade');
            $table->string('dinas');
            $table->date('tanggal');
            $table->enum('kondisi', ['baik', 'cukup', 'rusak', 'tdk ada']);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan');
    }
};
