<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
        {
            //
            $cat = ['Agradecimiento', 'Para Ella', 'Aniversario', 'Nacimiento', 'Globos', 'Postres y pasteles', 'Peluches', 'Vinos y licores', 'Joyería',
            'Dulces y Botanas', 'Velas', 'Belleza', 'Regalos', 'Chocolates'];

            foreach ($cat as $name) {
                Category::factory()->create([
                    'name' => $name,
                    'description' => 'Aquí va la descripción de la categoria ' . $name,
                    'status' => 1,
                    'visible' => 1,
                    'is_active_campaing' => 0
                ]);
            }
        }
    
       
}
