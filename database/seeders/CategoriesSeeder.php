<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Electronics', 'description' => 'Electronic items'],
            ['name' => 'Furniture', 'description' => 'Furniture items'],
            ['name' => 'Computers', 'description' => 'Computer items'],
            ['name' =>  'Heavy Machinery', 'description' => 'Heavy Machinery items'],
            ['name' => 'Automobiles', 'description' => 'Automobile items'],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
