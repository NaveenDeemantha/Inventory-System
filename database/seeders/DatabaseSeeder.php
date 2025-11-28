<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        if (\App\Models\User::count() === 0) {
             \App\Models\User::factory()->create([
                 'name' => 'Admin User',
                 'email' => 'admin@example.com',
                 'role' => 'super_admin',
             ]);
        }

        $categories = [
            'Telecommunication Equipment' => ['Fiber Splicer', 'Optical Time-Domain Reflectometer', 'Network Switch', 'Router', 'Patch Panel'],
            'Construction Materials' => ['Cement', 'Bricks', 'Steel Rods', 'Sand', 'Gravel'],
            'Cables & Wiring' => ['Fiber Optic Cable (Single Mode)', 'Cat6 Ethernet Cable', 'Coaxial Cable', 'Power Cable', 'Conduit'],
            'Tools & Hardware' => ['Drill Machine', 'Hammer', 'Screwdriver Set', 'Pliers', 'Wrench'],
            'Safety Gear' => ['Safety Helmet', 'Reflective Vest', 'Safety Boots', 'Gloves', 'Goggles'],
            'Fleet & Vehicles' => ['Pickup Truck', 'Excavator', 'Van', 'Forklift'],
        ];

        foreach ($categories as $categoryName => $products) {
            $category = Category::create([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName),
                'description' => 'Inventory items for ' . $categoryName,
            ]);

            foreach ($products as $productName) {
                Product::create([
                    'name' => $productName,
                    'sku' => strtoupper(Str::random(8)),
                    'description' => 'Standard ' . $productName,
                    'price' => rand(10, 5000),
                    'quantity' => rand(0, 100),
                    'category_id' => $category->id,
                ]);
            }
        }
    }
}
