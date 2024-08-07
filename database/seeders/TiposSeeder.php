<?php

namespace Database\Seeders;

use App\Models\Tipo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Tipo::create(['name' => 'Clasico', 'description' => 'Servicio Clasico ', 'is_default' => '1', 'visible'=> '1', 'status'=> '1']);
        Tipo::create(['name' => 'Premium', 'description' => 'Servicio Premium ', 'is_default' => '0', 'visible'=> '1', 'status'=> '1']);
        Tipo::create(['name' => 'Deluxe', 'description' => 'Servicio Deluxe ', 'is_default' => '0', 'visible'=> '1', 'status'=> '1']);
    }
}
