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
        Schema::create('comanda', function (Blueprint $table) {
            $table->integer('idComanda');
            $table->integer("numItem");
            $table->string("marca");
            $table->string("model");
            $table->string("genere");
            $table->string("talla");
            $table->string("color");
            $table->string("imatge");
            $table->integer("quantitat");
            $table->timestamp("hora");
            $table->string("estat");
            $table->primary(['idComanda','numItem']);

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comanda');
    }
};
