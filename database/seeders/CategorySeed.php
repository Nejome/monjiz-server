<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['title' => 'البرمجة والتطوير']);
        Category::create(['title' => 'التصميم']);
        Category::create(['title' => 'التسويق الإلكتروني']);
        Category::create(['title' => 'الكتابة والترجمة']);
        Category::create(['title' => 'كتابة المحتوي']);
    }
}
