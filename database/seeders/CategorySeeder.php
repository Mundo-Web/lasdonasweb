<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use SoDe\Extend\Text;

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
            Category::updateOrCreate([
                'name' => $category
            ], [
                'slug' => Text::slug($category),
                'description' => 'Descripcion de ' . $category,
                'status' => true,
                'visible' => true,
                'is_active_campaing' => false
            ]);
        }
    }
}
