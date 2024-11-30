<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create(['name' => 'Electronics']);
        Category::create(['name' => 'Furniture']);
        Category::create(['name' => 'Clothing']);
        Category::create(['name' => 'Home Appliances']);
        Category::create(['name' => 'Toys']);
        Category::create(['name' => 'Sports Equipment']);
        Category::create(['name' => 'Books']);
        Category::create(['name' => 'Beauty Products']);
        Category::create(['name' => 'Groceries']);
        Category::create(['name' => 'Digital Products']);
    }
}
