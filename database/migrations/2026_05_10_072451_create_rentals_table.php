<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rentals', function (Blueprint $table) {

            $table->id('id_rental');

            $table->unsignedBigInteger('id_booking');

            $table->enum('status_rental', [
                'aktif',
                'selesai',
                'dibatalkan'
            ])->default('aktif');

            $table->date('tanggal_pengambilan');
            $table->date('tanggal_pengembalian')->nullable();

            $table->timestamps();

            $table->foreign('id_booking')
                ->references('id_booking')
                ->on('bookings')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};