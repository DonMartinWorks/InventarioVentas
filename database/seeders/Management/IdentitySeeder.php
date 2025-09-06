<?php

namespace Database\Seeders\Management;

use App\Models\Identity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IdentitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $identities = [
            'RUT',
            'Pasaporte',
            'Carnet de extranjería',
            'RUC',
            'DNI',
            'Sin Documento'
        ];

        foreach ($identities as $identity) {
            Identity::create([
                'name' => $identity
            ]);
        }
    }
}
