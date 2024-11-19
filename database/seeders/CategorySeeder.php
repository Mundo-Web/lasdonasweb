<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use SoDe\Extend\Text;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'AMOR',
            'ANIVERSARIO',
            'NACIMIENTOS',
            'PARA ÉL',
            'GRADUACIÓN',
            'INAUGURACIÓN',
            'PLANTAS Y ORQUÍDEAS',
            'CONDOLENCIAS',
        ];

        foreach ($categories as $category) {
            $slug = Str::slug($category);
            Category::updateOrCreate([
                'name' => $category
            ], [
                'slug' => $slug,
                'description' => 'Descripcion de ' . Text::toTitleCase($category),
                'url_image' => 'images/seed/',
                'name_image' => 'cat-' . $slug . '.jpg',
                'img_miniatura' => 'images/seed/catmini-' . $slug . '.jpg',
                'status' => true,
                'visible' => true,
                'is_active_campaing' => false
            ]);
        }
    }
}
