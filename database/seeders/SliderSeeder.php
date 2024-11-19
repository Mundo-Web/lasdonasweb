<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 3; $i++) {
            Slider::updateOrCreate([
                'url_image' => 'images/seed/',
                'url_image2' => 'images/seed/',
                'name_image' => 'sl' . $i . '.jpg',
                'name_image2' => 'slsq' . $i . '.png',
                'visible' => true,
            ]);
        }
    }
}
