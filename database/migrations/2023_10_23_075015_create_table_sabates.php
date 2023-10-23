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
        Schema::create('sabates', function (Blueprint $table) {
            $table->id();
            $table->string("marca");
            $table->string("model");
            $table->string("genere");
            $table->string("talles");
            $table->string("color");
            $table->string("imatge");
        });

        Schema::create('comanda', function (Blueprint $table) {
            $table->id();
            $table->string("marca");
            $table->string("model");
            $table->string("genere");
            $table->string("talla");
            $table->string("color");
            $table->string("imatge");
            $table->timestamp("hora");
            $table->string("estat");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_sabates');
    }
};
