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
        $cat = ['Vestidos', 'Blusas', 'Casacas', 'Pantalones', 'Sets', 'Polos y Hoodies', 'Accesorios'];
        for ($i = 0; $i < 4; $i++) {
            Category::create([
                'name' => $cat[$i],
                'description' => 'Aquí va la descripción de la categoria '.$cat[$i],
                'status' => 1,
                'visible' => 1,
            ]);
        }
    }
}
