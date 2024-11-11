<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $electronics = Category::where('name', 'Electronics')->first();
        $furniture = Category::where('name', 'Furniture')->first();

        Product::create([
            'name' => 'Laptop',
            'category_id' => $electronics->id,
            'price' => 15000000,
            'stock' => 10,
        ]);

        Product::create([
            'name' => 'Sofa',
            'category_id' => $furniture->id,
            'price' => 5000000,
            'stock' => 5,
        ]);
    }
}
