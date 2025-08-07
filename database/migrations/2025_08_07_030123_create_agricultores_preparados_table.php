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
        Schema::create('agricultores_preparados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_agricultor')->constrained('agricultores')->onDelete('cascade');
            $table->foreignId('id_preparado')->constrained('preparados')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agricultores_preparados');
    }
};
