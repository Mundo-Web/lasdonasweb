<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComplementosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $complementos = [
            [
                'name' => 'Globos',
                'slug' => '', 
                'description' => 'Descripción del complemento 1',
                'url_image' => 'https://via.placeholder.com/150',
                'name_image' => 'complemento-1.jpg',
                'destacar' => true,
                'visible' => true,
                'status' => true,
            ],
            [
                'name' => 'Postres y pasteles',
                'slug' => 'complemento-2',
                'description' => 'Descripción del complemento 2',
                'url_image' => 'https://via.placeholder.com/150',
                'name_image' => 'complemento-2.jpg',
                'destacar' => false,
                'visible' => true,
                'status' => true,
            ],
            [
                'name' => 'Peluches',
                'slug' => 'complemento-3',
                'description' => 'Descripción del complemento 3',
                'url_image' => 'https://via.placeholder.com/150',
                'name_image' => 'complemento-3.jpg',
                'destacar' => true,
                'visible' => true,
                'status' => true,
            ],
            [
                'name' => 'Vinos y licores',
                'slug' => 'complemento-4',
                'description' => 'Descripción del complemento 4',
                'url_image' => 'https://via.placeholder.com/150',
                'name_image' => 'complemento-4.jpg',
                'destacar' => false,
                'visible' => true,
                'status' => true,
            ],
            [
                'name' => 'Joyería',
                'slug' => 'complemento-5',
                'description' => 'Descripción del complemento 5',
                'url_image' => 'https://via.placeholder.com/150',
                'name_image' => 'complemento-5.jpg',
                'destacar' => true,
                'visible' => true,
                'status' => true,
            ],
            [
                'name' => 'Dulces y Botanas',
                'slug' => '',
                'description' => 'Descripción del complemento 5',
                'url_image' => 'https://via.placeholder.com/150',
                'name_image' => 'complemento-5.jpg',
                'destacar' => true,
                'visible' => true,
                'status' => true,
            ],
            [
                'name' => 'Velas',
                'slug' => '',
                'description' => 'Descripción del complemento 5',
                'url_image' => 'https://via.placeholder.com/150',
                'name_image' => 'complemento-5.jpg',
                'destacar' => true,
                'visible' => true,
                'status' => true,
            ],
            [
                'name' => 'Belleza',
                'slug' => '',
                'description' => 'Descripción del complemento 5',
                'url_image' => 'https://via.placeholder.com/150',
                'name_image' => 'complemento-5.jpg',
                'destacar' => true,
                'visible' => true,
                'status' => true,
            ],
            [
                'name' => 'Regalos',
                'slug' => '',
                'description' => 'Descripción del complemento 5',
                'url_image' => 'https://via.placeholder.com/150',
                'name_image' => 'complemento-5.jpg',
                'destacar' => true,
                'visible' => true,
                'status' => true,
            ],
            [
                'name' => 'Chocolates',
                'slug' => '',
                'description' => 'Descripción del complemento 5',
                'url_image' => 'https://via.placeholder.com/150',
                'name_image' => 'complemento-5.jpg',
                'destacar' => true,
                'visible' => true,
                'status' => true,
            ],
        ];

        foreach ($complementos as $complemento) {
            \App\Models\Complemento::create($complemento);
        }
    }
}
