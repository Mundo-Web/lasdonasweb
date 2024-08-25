<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = ['Globos', 'Postres y Pasteles', 'Peluches', 'Vinos y Licores', 'Joyera', 'Dulces y Botanas', 'Velas', 'Belleza', 'Regalos', 'Chocolates'];

        foreach ($tags as $tag) {
            Tag::factory()->create([
                'name' => $tag,
                'description' => 'Aquí va la descripción de la etiqueta ' . $tag,
                'status' => 1,
                'visible' => 1,
            ]);
        }
    }
}
