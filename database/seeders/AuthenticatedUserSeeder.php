<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AuthenticatedUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $name1 = 'Administrador';

        User::factory()->create([
            'name' => 'Usuario' . ' ' . $name1,
            'email' => Str::slug($name1) . '@' . str_replace(' ', '', Str::lower(config('app.name'))) . '.com',
            'password' => Hash::make('1234'),
            'email_verified_at' => now(),
            'remember_token' => null
        ]);
    }
}
