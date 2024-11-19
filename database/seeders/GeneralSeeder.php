<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\General;

class GeneralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        General::create([
            'point_equivalence' => 10,
            'primer_text' => 'Categoría más vendida',
            'second_text' => null,
            'url_cintillo' => 'https://lasdonas.atalaya.pe/catalogo/16',
            'address' => 'Av. Aramburu 1506',
            'inside' => 'Oficina 404 - Piso 4',
            'district' => 'Miraflores',
            'schedule' => "De Lunes a Viernes de 9:00am a 6:00pm y Sábados de 9:00am a 1:00pm",
            'city' => 'Lima',
            'country' => 'Perú',
            'cellphone' => '555-555-123' ,
            'office_phone' => '5555-1025' ,
            'email' => 'usuario@mundoweb.pe',
            'facebook' => 'https://www.facebook.com/FLORERIALASDONAS',
            'instagram' => 'https://www.instagram.com/florerialasdonas',
            'youtube' => 'https://www.youtube.com/@Lasdo%C3%B1as.artesanasfloristas',
            'twitter' => null,
            'tiktok' => 'https://www.tiktok.com/@florerialasdonas',
            'whatsapp' => '555-555-123' ,
            'form_email' => 'usuario@mundoweb.pe',
            'business_hours' => 'horas',
            'mensaje_whatsapp' => 'En Florería Las Doñas, creemos que a través de las flores se pueden expresar los sentimientos más genuinos y profundos. Cada uno de nuestros arreglos está inspirado en el alma de nuestra cultura, donde combinamos elementos artesanales como peluches tejidos a crochet, tarjetas hechas a mano, trabajos en mimbre, corteza de madera y cerámicas.',
            'ig_token' => 'https://www.instagram.com/florerialasdonas?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==',
            'url_video' => 'pv8JSjT68Eo',

        ]);
    }
}
