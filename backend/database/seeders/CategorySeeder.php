<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement("SET foreign_key_checks=0");

        Category::truncate();

        Category::insert([
            [
                'title' => 'Category One',
                'slug' => 'category-one'
            ],
            [
                'title' => 'Category Two',
                'slug' => 'category-two'
            ],
            [
                'title' => 'Category Three',
                'slug' => 'category-three'
            ],
            [
                'title' => 'Category Four',
                'slug' => 'category-four'
            ],
            [
                'title' => 'Category Five',
                'slug' => 'category-five'
            ]
        ]);
    }
}
