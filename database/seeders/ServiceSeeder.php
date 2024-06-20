<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for ($i = 1; $i <= 5; $i++) {
            Service::create([
                'title' => 'Servicio '. $i,
                'description' => 'Yep Advisors, entendemos que cada individuo tiene objetivos financieros únicos. Nuestro servicio de Wealth Management ofrece soluciones personalizadas diseñadas para proteger y hacer tu patrimonio. Desde la planificación de la jubilación hasta la gestión de inversiones, nuestro enfoque centrado en el cliente garantiza que tus necesidades estén siempre en el centro de nuestras decisiones. Confía en nosotros para ayudarte a alcanzar tus metas financieras con confianza y tranquilidad.',
                'url_image' => 'https://picsum.photos/id/'. $i * 33 .'/50',
                'status' => 1,
            ]);
        }
        
    }
}
