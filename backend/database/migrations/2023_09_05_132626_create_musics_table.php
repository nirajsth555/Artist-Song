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
        Schema::create('musics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artist_id')->references('id')->on('artists')->onDelete('cascade');
            $table->string('title', 255);
            $table->string('album_ame', 255);
            $table->enum('genre', ['rnb', 'country', 'classic', 'rock', 'jazz']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('musics');
    }
};
