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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->string('id_transaksi')->primary()->unique();
            $table->date('tanggal_transaksi');

            $table->string(column: 'jenis_rekening_id');
            $table->foreign('jenis_rekening_id')->references('id_jenis_rekening')->on('jenis_rekening')->cascadeOnDelete();
            $table->string('rekening_id');
            $table->foreign('rekening_id')->references('id_rekening')->on('rekening')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};