<?php

namespace Database\Seeders;

use App\Models\AboutUs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutUs::create([
            'titulo' => 'Sobre nosotros',
            'descripcion' => 'En Florería Las Doñas, creemos que a través de las flores se pueden expresar los sentimientos más genuinos y profundos. Cada uno de nuestros arreglos está inspirado en el alma de nuestra cultura, donde combinamos elementos artesanales como peluches tejidos a crochet, tarjetas hechas a mano, trabajos en mimbre, corteza de madera y cerámicas.',
            'imagen' => 'imagen.jpg',
        ]);
    }
}
