<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('foto_mobils', function (Blueprint $table) {

            $table->id('id_foto');

            $table->unsignedBigInteger('id_mobil');

            $table->string('file_foto');

            $table->timestamps();

            $table->foreign('id_mobil')
                ->references('id_mobil')
                ->on('mobils')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('foto_mobils');
    }
};