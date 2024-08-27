<?php

namespace Database\Seeders;

use App\Models\TipoFlor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TiposFlorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'ROSAS',
            'TULIPANES',
            'GIRASOLES',
            'ORQUÍDEAS',
            'GERBERAS',
        ];

        foreach ($types as $type) {
            TipoFlor::updateOrCreate([
                'name' => $type
            ], [
                'status' => true,
            ]);
        }
    }
}
