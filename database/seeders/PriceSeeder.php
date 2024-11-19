<?php

namespace Database\Seeders;

use App\Models\PrecioEnvio;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Facades\Excel;

class PriceSeeder extends Seeder
{
    use Importable;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Excel::import(new class implements ToModel
        {
            public function model(array $item)
            {
                if (!is_numeric($item[0])) return null;
                if ($item[4] == '') return null;
                try {
                    PrecioEnvio::create([
                        'name' => $item[1],
                        'direcction' => $item[2],
                        'zip_code' => $item[3],
                        'price' => str_replace(',', '.', $item[4]),
                    ]);
                } catch (\Throwable $th) {
                    dump($th->getMessage());
                }
            }
        }, 'storage/app/utils/PrecioEnvios.xlsx');
    }
}
