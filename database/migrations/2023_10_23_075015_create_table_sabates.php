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
            $table->integer("preu");
            $table->string("talles");
            $table->string("color");
            $table->string("imatge");
            $table->timestamps();

        });
        DB::table('sabates')->insert([
            [
                'id' => 1,
                'marca' => 'Adidas',
                'model' => 'Superstar',
                'genere' => 'Hombre',
                'preu' => 100,
                'talles' => '40,41,42',
                'color' => 'Blanco',
                'imatge' => 'imagen/adidas-superstar.jpg',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()'),
            ],
            [
                'id' => 2,
                'marca' => 'Nike',
                'model' => 'Air Max',
                'genere' => 'Hombre',
                'preu' => 120,
                'talles' => '41,42,43',
                'color' => 'Negro',
                'imatge' => 'imagen/nike-negro.jpg',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()'),
            ],
            [
                'id' => 3,
                'marca' => 'Puma',
                'model' => 'Cali',
                'genere' => 'Mujer',
                'preu' => 90,
                'talles' => '35,36,37',
                'color' => 'Rosa',
                'imatge' => 'imagen/puma-zapatillas-cali-sport-mix.jpg',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()'),
            ],
            [
                'id' => 4,
                'marca' => 'Reebok',
                'model' => 'Classic Leather',
                'genere' => 'Hombre',
                'preu' => 80,
                'talles' => '39,40,41',
                'color' => 'Blanco',
                'imatge' => 'imagen/zapatos-reebok-classic.jpg',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()'),
            ],
            [
                'id' => 5,
                'marca' => 'Converse',
                'model' => 'Chuck Taylor',
                'genere' => 'Unisex',
                'preu' => 60,
                'talles' => '36,37,38',
                'color' => 'Azul',
                'imatge' => 'imagen/nike-negro.jpg',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()'),
            ],
            [
                'id' => 6,
                'marca' => 'Vans',
                'model' => 'Old Skool',
                'genere' => 'Unisex',
                'preu' => 70,
                'talles' => '38,39,40',
                'color' => 'Negro',
                'imatge' => 'imagen/converse-chuck.jpg',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()'),
            ],
            [
                'id' => 7,
                'marca' => 'New Balance',
                'model' => '574',
                'genere' => 'Hombre',
                'preu' => 110,
                'talles' => '40,41,42',
                'color' => 'Gris',
                'imatge' => 'imagen/vans-old-skool.jpg',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()'),
            ],
            [
                'id' => 8,
                'marca' => 'Adidas',
                'model' => 'Stan Smith',
                'genere' => 'Mujer',
                'preu' => 95,
                'talles' => '35,36,37',
                'color' => 'Blanco',
                'imatge' => 'imagen/new-balance-gris.jpg',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()'),
            ],
            [
                'id' => 9,
                'marca' => 'Nike',
                'model' => 'Blazer',
                'genere' => 'Hombre',
                'preu' => 105,
                'talles' => '41,42,43',
                'color' => 'Rojo',
                'imatge' => 'imagen/adidas-stan-smith.jpg',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()'),
            ],
            [
                'id' => 10,
                'marca' => 'Puma',
                'model' => 'Suede',
                'genere' => 'Mujer',
                'preu' => 75,
                'talles' => '35,36,37',
                'color' => 'Negro',
                'imatge' => 'imagen/nike-blacer-rojo.jpg',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()'),
            ],
            [
                'id' => 11,
                'marca' => 'Reebok',
                'model' => 'Nano',
                'genere' => 'Hombre',
                'preu' => 130,
                'talles' => '39,40,41',
                'color' => 'Verde',
                'imatge' => 'imagen/puma_suere_negras.jpg',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()'),
            ],
            [
                'id' => 12,
                'marca' => 'Converse',
                'model' => 'One Star',
                'genere' => 'Unisex',
                'preu' => 65,
                'talles' => '36,37,38',
                'color' => 'Negro',
                'imatge' => 'imagen/reebok-zapatillas-nano-x.jpg',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()'),
            ],
            [
                'id' => 13,
                'marca' => 'Vans',
                'model' => 'Sk8-Hi',
                'genere' => 'Unisex',
                'preu' => 75,
                'talles' => '38,39,40',
                'color' => 'Azul',
                'imatge' => 'imagen/converse-onestar.jpg',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()'),
            ],
            [
                'id' => 14,
                'marca' => 'New Balance',
                'model' => '990',
                'genere' => 'Hombre',
                'preu' => 150,
                'talles' => '40,41,42',
                'color' => 'Gris',
                'imatge' => 'imagen/vans-sk8.jpg',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()'),
            ],
            [
                'id' => 15,
                'marca' => 'Adidas',
                'model' => 'Gazelle',
                'genere' => 'Mujer',
                'preu' => 90,
                'talles' => '35,36,37',
                'color' => 'Rosa',
                'imatge' => 'imagen/new-balance-990-azul.jpg',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()'),
            ],
            [
                'id' => 16,
                'marca' => 'Nike',
                'model' => 'Air Force 1',
                'genere' => 'Hombre',
                'preu' => 120,
                'talles' => '41,42,43',
                'color' => 'Blanco',
                'imatge' => 'imagen/adidas-gazelle.jpg',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()'),
            ],
            [
                'id' => 17,
                'marca' => 'Puma',
                'model' => 'Future Rider',
                'genere' => 'Mujer',
                'preu' => 85,
                'talles' => '35,36,37',
                'color' => 'Azul',
                'imatge' => 'imagen/nike-air-force-1.jpg',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()'),
            ],
            [
                'id' => 18,
                'marca' => 'Reebok',
                'model' => 'Zig Kinetica',
                'genere' => 'Hombre',
                'preu' => 140,
                'talles' => '39,40,41',
                'color' => 'Negro',
                'imatge' => 'imagen/puma-future-rider.jpg',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()'),
            ],
            [
                'id' => 19,
                'marca' => 'Converse',
                'model' => 'Jack Purcell',
                'genere' => 'Unisex',
                'preu' => 70,
                'talles' => '36,37,38',
                'color' => 'Blanco',
                'imatge' => 'imagen/puma-future-rider.jpg',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()'),
            ],
            [
                'id' => 20,
                'marca' => 'Vans',
                'model' => 'Era',
                'genere' => 'Unisex',
                'preu' => 65,
                'talles' => '38,39,40',
                'color' => 'Gris',
                'imatge' => 'imagen/vans-Era-gris.jpg',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()'),
            ],
        ]);
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sabates');
    }
};
