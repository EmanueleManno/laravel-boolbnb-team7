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

        // Categories List
        $categories = [
            ['name' => 'Casa', 'icon' => 'house'],
            ['name' => 'Appartamento', 'icon' => 'couch'],
            ['name' => 'Hotel', 'icon' => 'hotel'],
            ['name' => 'Pensione', 'icon' => 'bed']
        ];

        foreach ($categories as $category) {

            $new_category = new Category();

            $new_category->name = $category['name'];
            $new_category->icon = $category['icon'];

            $new_category->save();
        }
    }
}
