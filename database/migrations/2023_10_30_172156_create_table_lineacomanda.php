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
        Schema::create('linea_comandas', function (Blueprint $table) {
            $table->foreignId('idComanda')->constrained(
                table: 'comandas', indexName: 'id'
            )->onDelete('cascade')->onUpdate('cascade');
            $table->integer("numItem");
            $table->string("marca");
            $table->string("model");
            $table->string("genere");
            $table->string("talla");
            $table->string("color");
            $table->integer("preu");
            $table->string("imatge");
            $table->integer("quantitat");
            $table->primary(['idComanda','numItem']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('linea_comandas');
    }
};
