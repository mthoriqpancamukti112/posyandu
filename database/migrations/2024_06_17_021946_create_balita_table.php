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
        Schema::create('balita', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orangtua_id');

            $table->foreign('orangtua_id')->references('id')->on('orangtua')->onDelete('cascade');

            $table->string('nik');
            $table->string('nama_anak');
            $table->string('jenis_kelamin');
            $table->date('tgl_lahir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balita');
    }
};