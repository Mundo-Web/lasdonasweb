<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = Category::where('name', 'CONDOLENCIAS')->first();
        $condolencias = [
            'ARREGLOS',
            'CORONAS',
            'LÁGRIMAS DE PIE',
            'LÁGRIMAS DE PISO',
            'MANTOS',
            'CRUCES',
        ];

        foreach ($condolencias as $subcategory) {
            Subcategory::updateOrCreate(['name' => $subcategory], [
                'category_id' => $category->id,
                'description' => 'Descripcion de ' . $subcategory,
                'status' => true
            ]);
        }
    }
}
