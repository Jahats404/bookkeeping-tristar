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
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->string('id_detail_transaksi')->primary()->unique();
            $table->string('jenis_biaya')->nullable();
            $table->string('jenis_transaksi')->nullable();
            $table->bigInteger('dpp')->nullable();
            $table->integer('pajak')->nullable();
            $table->bigInteger('nominal_pajak')->nullable();
            $table->bigInteger('nominal_akhir')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            $table->string('invoice')->nullable();
            $table->string('dokumen_lain')->nullable();
            $table->string('keterangan')->nullable();

            $table->string('transaksi_id');
            $table->foreign('transaksi_id')->references('id_transaksi')->on('transaksi')->cascadeOnDelete();
            $table->string('projek_id')->nullable();
            $table->foreign('projek_id')->references('id_projek')->on('projek')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaksi');
    }
};