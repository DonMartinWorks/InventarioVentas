<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /**
         * ================
         *  DELETE FOLDERS
         * ================
         */
        if (Storage::exists('livewire-tmp')) {
            Storage::deleteDirectory('livewire-tmp');
            echo "Folder 'livewire-tmp' deleted.\n";
        }

        if (Storage::exists('profile-photos')) {
            Storage::deleteDirectory('profile-photos');
            echo "Folder 'profile-photos' deleted.\n";
        }

        // User::factory(10)->create();

        $this->call(AuthenticatedUserSeeder::class);
    }
}
