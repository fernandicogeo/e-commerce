<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Item;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        for ($i = 1; $i <= 10; $i++) {
            Item::create([
                'name' => 'Barang ' . $i,
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus asperiores voluptatum dolorum illum officia dignissimos sequi qui sed nemo similique.',
                'price' => 'Rp' . rand(10, 100) . '.000',
                'stock' => rand(1, 50),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
