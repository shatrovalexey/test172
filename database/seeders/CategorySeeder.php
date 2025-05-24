<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category as CategoryModel;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (['легкий', 'хрупкий', 'тяжелый',] as $title) {
            error_log($title);
            CategoryModel::create(['title' => $title,]);
        }
    }
}
