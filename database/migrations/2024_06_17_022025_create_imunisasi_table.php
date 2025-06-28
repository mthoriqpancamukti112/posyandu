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
        Schema::create('imunisasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('bidan_id')->nullable();
            $table->unsignedBigInteger('balita_id');
            $table->unsignedBigInteger('vaksin_id')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('bidan_id')->references('id')->on('bidan')->onDelete('cascade');
            $table->foreign('balita_id')->references('id')->on('balita')->onDelete('cascade');
            $table->foreign('vaksin_id')->references('id')->on('vaksin')->onDelete('cascade');

            $table->date('tanggal');
            $table->enum('kondisi', ['Y', 'T']);
            $table->string('usia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imunisasi');
    }
};