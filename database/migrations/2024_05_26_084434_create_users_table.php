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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['admin', 'bidan', 'ortu']);
            $table->unsignedBigInteger('bidan_id')->nullable();
            $table->foreign('bidan_id')->references('id')->on('bidan')->onDelete('cascade');
            $table->unsignedBigInteger('orangtua_id')->nullable();
            $table->foreign('orangtua_id')->references('id')->on('orangtua')->onDelete('cascade');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
