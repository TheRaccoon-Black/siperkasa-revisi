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
        Schema::create('digital_signatures', function (Blueprint $table) {
            $table->id();
            $table->string('idHasilPemeriksaan');
            $table->text('ttdDanruPenerima')->nullable();
            $table->text('ttdDanruPenyerah')->nullable();
            $table->text('ttdAsstMan')->nullable();
            $table->string('linkDanruPenerima')->unique();
            $table->string('linkDanruPenyerah')->unique();
            $table->string('linkAsstMan')->unique();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('digital_signatures');
    }
};
