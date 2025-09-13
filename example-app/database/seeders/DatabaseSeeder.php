<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\Blog;
use App\Models\Customer;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Создаем категории
        Category::factory(5)->create();
        
        // Создаем продукты
        Product::factory(20)->create();
        
        // Создаем блоги
        Blog::factory(10)->create();
        
        // Создаем клиентов
        Customer::factory(8)->create();
    }
}