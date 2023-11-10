<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
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
            $table->string("descripcio");
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
                'descripcio' => 'Las clásicas Adidas Superstar en blanco para hombres. Un icono de estilo urbano.'
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
                'descripcio' => 'Zapatillas Nike Air Max en negro para hombres. Amortiguación y estilo en cada paso.'
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
                'descripcio' => 'Zapatillas Puma Cali en rosa para mujeres. Modernidad y frescura en cada detalle.'
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
                'descripcio' => 'Los clásicos Reebok Classic Leather en blanco para hombres. Comodidad atemporal.'
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
                'descripcio' => 'Las icónicas Converse Chuck Taylor en azul para todos. Un estilo que nunca pasa de moda.'
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
                'descripcio' => 'Zapatillas Vans Old Skool en negro para todos. Elegancia y confort en cada paso.'
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
                'descripcio' => 'Zapatillas New Balance 574 en gris para hombres. Estilo y rendimiento en perfecta armonía.'
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
                'descripcio' => 'Las elegantes Adidas Stan Smith en blanco para mujeres. Un toque de estilo clásico.'
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
                'descripcio' => 'Zapatillas Nike Blazer en rojo para hombres. Conquista las calles con estilo.'
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
                'descripcio' => 'Zapatillas Puma Suede en negro para mujeres. Elegancia y sofisticación en cada paso.'
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
                'descripcio' => 'Zapatillas Reebok Nano en verde para hombres. Rendimiento y estilo sin límites.'
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
                'descripcio' => 'Converse One Star en negro para todos. Un clásico reinventado para todas las ocasiones.'
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
                'descripcio' => 'Zapatillas Vans Sk8-Hi en azul para todos. Estilo y confort en cada aventura.'
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
                'descripcio' => 'Zapatillas New Balance 990 en gris para hombres. La combinación perfecta de estilo y rendimiento.'
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
                'descripcio' => 'Adidas Gazelle en rosa para mujeres. Un toque de color y estilo en cada paso.'
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
                'descripcio' => 'Zapatillas Nike Air Force 1 en blanco para hombres. Eleva tu estilo a nuevas alturas.'
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
                'descripcio' => 'Zapatillas Puma Future Rider en azul para mujeres. Un toque retro con un estilo moderno.'
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
                'descripcio' => 'Zapatillas Reebok Zig Kinetica en negro para hombres. Un diseño innovador para un rendimiento excepcional.'
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
                'descripcio' => 'Converse Jack Purcell en blanco para todos. Elegancia casual para cualquier ocasión.'
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
                'descripcio' => 'Zapatillas Vans Era en gris para todos. Estilo clásico y versatilidad en cada paso.'
            ],
            [
                'id' => 21,
                'marca' => 'Adidas',
                'model' => 'Superstar',
                'genere' => 'Nen/a',
                'preu' => 80,
                'talles' => '28,29,30',
                'color' => 'Blanc',
                'imatge' => 'imagen/adidas-superstar-nen.jpg',
                'descripcio' => 'Adidas Superstar en blanco para niños/as. Un inicio a la moda desde temprana edad.'
            ],
            [
                'id' => 22,
                'marca' => 'Nike',
                'model' => 'Air Max',
                'genere' => 'Nen/a',
                'preu' => 90,
                'talles' => '28,29,30',
                'color' => 'Negre',
                'imatge' => 'imagen/nike-air-max-nen.jpg',
                'descripcio' => 'Zapatillas Nike Air Max en negro para niños/as. Comodidad y estilo desde pequeños.'
            ],
            [
                'id' => 23,
                'marca' => 'Puma',
                'model' => 'Cali',
                'genere' => 'Nen/a',
                'preu' => 70,
                'talles' => '25,26,27',
                'color' => 'Rosa',
                'imatge' => 'imagen/puma-cali-nen.jpg',
                'descripcio' => 'Zapatillas Puma Cali en rosa para niños/as. Estilo y diversión en cada paso.'
            ],
            [
                'id' => 24,
                'marca' => 'Reebok',
                'model' => 'Classic Leather',
                'genere' => 'Nen/a',
                'preu' => 60,
                'talles' => '25,26,27',
                'color' => 'Blanc',
                'imatge' => 'imagen/reebok-classic-nen.jpg',
                'descripcio' => 'Zapatillas Reebok Classic Leather en blanco para niños/as. Comodidad y estilo desde pequeños.'
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
