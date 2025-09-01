<?php

namespace Database\Seeders;

// use App\Models\User;
use Database\Seeders\Management\CategorySeeder;
use Database\Seeders\Management\ProductSeeder;
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

        if (Storage::exists('images/products')) {
            Storage::deleteDirectory('images/products');
            echo "Folder 'images products' deleted.\n";
        }

        if (Storage::exists('images')) {
            Storage::deleteDirectory('images');
            echo "Folder 'images' deleted.\n";
        }

        // User::factory(10)->create();

        $this->call([AuthenticatedUserSeeder::class, CategorySeeder::class, ProductSeeder::class]);
    }
}
