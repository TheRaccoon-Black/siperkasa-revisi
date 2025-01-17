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
        Schema::create('info_tambahans', function (Blueprint $table) {
            $table->id();
            $table->string('id_hasil');
            $table->string('reguPenerima')->nullable();
            $table->string('reguJagaPenerima')->nullable();
            $table->string('dinasPenerima')->nullable();
            $table->string('danruPenerima')->nullable();
            $table->string('danruPenyerah')->nullable();
            $table->string('komandanPenyerah')->nullable();
            $table->string('komandanPenerima')->nullable();
            $table->string('Asstman')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_tambahans');
    }
};
