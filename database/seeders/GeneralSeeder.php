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
            'address' => 'Av. Aramburu 1506',
            'inside' => 'Oficina 404 - Piso 4',
            'district' => 'Miraflores',
            'schedule' => "De Lunes a Viernes de 9:00am a 6:00pm y Sábados de 9:00am a 1:00pm",
            'city' => 'Lima',
            'country' => 'Perú',
            'cellphone' => '555-555-123' ,
            'office_phone' => '5555-1025' ,
            'email' => 'usuario@mundoweb.pe',
            'facebook' => 'https://www.facebook.com/Doomineoficial/',
            'instagram' => 'https://www.instagram.com/doomineoficial',
            // 'youtube' => 'www.youtube.com',
            // 'twitter' => 'www.twitter.com',
            'tiktok' => 'https://www.tiktok.com/@doomineoficial',
            'whatsapp' => '555-555-123' ,
            'form_email' => 'usuario@mundoweb.pe',
            'business_hours' => 'horas',
            'mensaje_whatsapp' => 'Hola estamos atentos a lo que ud desee',
            'aboutus' => 'Dommine se encuentra interesado en ti. Si deseas tener más información sobre nuestros productos y promociones, entonces completa el siguiente formulario para contactarte o ten en cuenta nuestra ubicación, número telefónico y dirección de correo electrónico.'

        ]);
    }
}
