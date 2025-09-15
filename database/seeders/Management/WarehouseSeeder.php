<?php

namespace Database\Seeders\Management;

use App\Models\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Warehouse::create([
            'name' => 'Almacén Principal',
            'location' => fake()->address() . ' ' . fake()->country()
        ]);

        for ($i = 1; $i <= 3; $i++) {
            Warehouse::create([
                'name' => 'Almacén N°' . ' ' . $i . ': ' . fake()->sentence(3),
                'location' => fake()->address() . ' ' . fake()->country()
            ]);
        }
    }
}
