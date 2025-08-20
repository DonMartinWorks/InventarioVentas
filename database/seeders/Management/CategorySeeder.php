<?php

namespace Database\Seeders\Management;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Electrónicos',
                'description' => 'Articulos electrónicos'
            ],
            [
                'name' => 'Vestimenta',
                'description' => 'Articulos de ropa o vestimenta'
            ],
            [
                'name' => 'Alimentos',
                'description' => 'Comida'
            ],
            [
                'name' => 'Hogar',
                'description' => 'Accesorios para el hogar'
            ],
            [
                'name' => 'Juguetería',
                'description' => 'Para los pequeños de su hogar'
            ],
            [
                'name' => 'Libros',
                'description' => 'Géneros de ficción, no ficción, ciencia, etc.'
            ],
            [
                'name' => 'Deportes',
                'description' => 'Equipamiento para deportes como fútbol, baloncesto, natación, etc.'
            ],
            [
                'name' => 'Vehículos',
                'description' => 'Clasificación de automóviles, motocicletas, bicicletas.'
            ],
            [
                'name' => 'Música',
                'description' => 'Géneros musicales, instrumentos, equipos de sonido.'
            ],
            [
                'name' => 'Arte',
                'description' => 'Pinturas, esculturas, materiales de dibujo.'
            ],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
