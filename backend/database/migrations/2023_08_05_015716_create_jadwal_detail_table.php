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
        Schema::create('jadwal_detail', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('hari')->comment('1: Senin, 2: Selasa, 3: Rabu, 4: Kamis, 5: Jumat, 6: Sabtu, 7: Minggu');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->boolean('is_available')->default(true);
            $table->foreignId('jadwal_id')->references('id')->on('jadwal');
            $table->timestamps();
        });
    }   

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_detail');
    }
};
