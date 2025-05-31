<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert(
            [
                [
                    'name' => 'Isntree Sunscreen',
                    'slug' => 'Isntree Sunscreen',
                    'status' => 1,
                    'show_at_home' => 1
                ],
                [
                    'name' => 'Olya Samboo',
                    'slug' => 'Olya Samboo',
                    'status' => 1,
                    'show_at_home' => 1
                ],
                [
                    'name' => 'Mary & May',
                    'slug' => 'Mary & May',
                    'status' => 1,
                    'show_at_home' => 1
                ],
            ]
        );
    }
}
