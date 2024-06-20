<?php

namespace Database\Seeders;

use App\Models\StatusOrden;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusOrdensSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StatusOrden::create([ 'descripcion' => 'Pendiente',
        'status' => '1' ]);
        StatusOrden::create([ 'descripcion' => 'Procesada',
        'status' => '1' ]);
    }
}

