<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayarans', function (Blueprint $table) {

            $table->id('id_pembayaran');

            $table->unsignedBigInteger('id_booking');

            $table->enum('metode_pembayaran', [
                'transfer',
                'ewallet',
                'cash'
            ]);

            $table->decimal('jumlah_bayar', 12, 2);

            $table->enum('status_pembayaran', [
                'menunggu',
                'berhasil',
                'gagal',
                'refund'
            ])->default('menunggu');

            $table->date('tanggal_bayar')->nullable();

            $table->string('bukti_pembayaran')->nullable();

            $table->timestamps();

            $table->foreign('id_booking')
                ->references('id_booking')
                ->on('bookings')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};