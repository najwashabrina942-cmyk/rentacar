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
        Schema::create('mobils', function (Blueprint $table) {

            $table->id('id_mobil');

            $table->unsignedBigInteger('id_owner');

            $table->string('nama_mobil');
            $table->string('merk');
            $table->string('plat_nomor')->unique();

            $table->year('tahun');

            $table->decimal('harga_per_hari', 12, 2);

            $table->enum('status_mobil', [
                'tersedia',
                'disewa',
                'maintenance'
            ])->default('tersedia');

            $table->text('deskripsi')->nullable();

            $table->timestamps();

            $table->foreign('id_owner')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobils');
    }
};