<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'producto' => $this->faker->word,
            'extract' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'precio' => $this->faker->randomNumber(2),
            'descuento' => $this->faker->randomNumber(2),
            'preciofiltro' => $this->faker->randomNumber(2),
            'sku' => $this->faker->unique()->word,
            'imagen' => $this->faker->imageUrl,
            'categoria_id' => 1, // Ajusta según sea necesario
            'tipo_prodct' => null,
            'parent_id' => null,
            'tipo_servicio' => 'producto',
        ];
    }
}
