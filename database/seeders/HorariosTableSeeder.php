<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HorariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['start_time' => '10:00:00', 'end_time' => '13:00:00', 'day' => 'hoy', 'visible' => 1, 'status' => 1],
            ['start_time' => '15:00:00', 'end_time' => '17:00:00', 'day' => 'hoy', 'visible' => 1, 'status' => 1],
            ['start_time' => '08:00:00', 'end_time' => '10:00:00', 'day' => 'hoy', 'visible' => 1, 'status' => 1],
        ];

        DB::table('horarios')->insert($data);
    }
}
