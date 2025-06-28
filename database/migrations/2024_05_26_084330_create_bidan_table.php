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
        Schema::create('bidan', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 255);
            $table->string('nip', 255);
            $table->string('nama_bidan', 255);
            $table->date('tgl_lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_hp', 15)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bidan');
    }
};
