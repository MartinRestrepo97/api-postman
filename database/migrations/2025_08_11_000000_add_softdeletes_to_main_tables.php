<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('agricultores', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('animales', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('vegetales', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('agricultores', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('animales', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('vegetales', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
