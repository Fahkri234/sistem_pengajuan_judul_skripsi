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
        Schema::create('pengajuan_juduls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('judul');
            $table->text('abstrak');
            $table->enum('status', ['pending', 'diterima', 'ditolak'])->default('pending');
            $table->string('alasan_penolakan')->nullable();
            $table->string('bukti_pembayaran')->nullable(); // untuk menyimpan path bukti pembayaran
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_juduls');
    }
};
