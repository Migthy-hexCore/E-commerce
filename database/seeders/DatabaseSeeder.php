<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Database\Factories\ProductFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Storage::deleteDirectory('products');
        Storage::makeDirectory('products');
        
        User::factory()->create([
            'name' => 'Cesar Alejandro',
            'last_name' => 'Jaramillo Ramirez',
            'document_type' => 1,
            'document_number' => '87654321',
            'email' => 'cesarjaramillormz@gmail.com',
            'phone' => '987654321',
            'password' => bcrypt('cesar123'),
        ]);

        User::factory(10)->create();

        $this->call([
            FamilySeeder::class,
            OptionSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
        ]);

        Product::factory(10)->create();
    }
}
