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
        Schema::create('rekening', function (Blueprint $table) {
            $table->string('id_rekening')->primary()->unique();
            $table->string('nama_rekening');
            $table->string('perusahaan_id')->nullable();
            $table->string('projek_id')->nullable();
            $table->string('jenis_rekening_id');

            $table->foreign('perusahaan_id')->references('id_perusahaan')->on('perusahaan')->cascadeOnDelete();
            $table->foreign('projek_id')->references('id_projek')->on('projek')->cascadeOnDelete();
            $table->foreign('jenis_rekening_id')->references('id_jenis_rekening')->on('jenis_rekening')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekening');
    }
};