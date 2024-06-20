<?php

namespace Database\Seeders;

use App\Models\Attributes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AtributosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Attributes::create([ 'titulo' => 'Talla',
        'type_atributte_id'=> '1',
        'status' => '1' ,
        'visible' => '1' 
    ]);
    Attributes::create([ 'titulo' => 'Color',
        'type_atributte_id'=> '2',
        'status' => '1' ,
        'visible' => '1' 
    ]);
    }
}
