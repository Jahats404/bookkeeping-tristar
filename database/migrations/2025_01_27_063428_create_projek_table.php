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
        Schema::create('projek', function (Blueprint $table) {
            $table->string('id_projek')->primary()->unique();
            $table->string('nama_projek');
            $table->integer('no_kontrak');
            $table->bigInteger('nominal_kontrak');
            $table->string('durasi');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('status');
            
            $table->string('perusahaan_id');
            $table->foreign('perusahaan_id')->references('id_perusahaan')->on('perusahaan')->cascadeOnDelete();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projek');
    }
};