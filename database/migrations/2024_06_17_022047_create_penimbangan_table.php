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
        Schema::create('penimbangan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('balita_id');
            $table->unsignedBigInteger('bidan_id')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('balita_id')->references('id')->on('balita')->onDelete('cascade');
            $table->foreign('bidan_id')->references('id')->on('bidan')->onDelete('cascade');

            $table->date('tgl_timbang');
            $table->string('usia');
            $table->string('berat_badan');
            $table->string('tinggi_badan');
            $table->enum('perkembangan', ['Y', 'T']);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penimbangan');
    }
};