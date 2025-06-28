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
        Schema::create('orangtua', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 255);
            $table->string('nama_ortu', 255);
            $table->date('tgl_lahir')->nullable();
            $table->string('no_hp', 15)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orangtua');
    }
};
