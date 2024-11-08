<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Galerie;
use App\Models\Products;
use App\Models\Subcategory;
use App\Models\TipoFlor;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Facades\Excel;
use SoDe\Extend\File;
use SoDe\Extend\Text;
use Illuminate\Support\Str;

class ItemSeeder extends Seeder
{
    use Importable;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $path2search = "./public/storage/seed/";

        $images = [];
        try {
            $images = File::scan($path2search);
        } catch (\Throwable $th) {
            dump($th->getMessage());
        }

        Excel::import(new class($images) implements ToModel
        {
            private array $images;

            public function __construct(array $images)
            {
                $this->images = $images;
            }

            public function model(array $item)
            {
                if (!is_numeric($item[0])) return null;

                try {
                    // Ahora accedemos a $this->images en lugar de $images
                    $productImages = \array_filter($this->images, fn($image) => Text::startsWith($image, $item[2]));

                    $categoryJpa = new Category();
                    if ($item[11]) {
                        $categoryJpa = Category::updateOrCreate([
                            'name' => $item[11]
                        ], [
                            'slug' => Str::slug($item[5]),
                            'visible' => 1
                        ]);
                    }

                    $subcategoryJpa = new Subcategory();
                    if ($item[15]) {
                        $subcategoryJpa = SubCategory::updateOrCreate([
                            'category_id' => $categoryJpa->id,
                            'name' => $item[15]
                        ], [
                            // 'slug' => Str::slug($item[15]),
                            // 'visible' => 1
                        ]);
                    }

                    $tipoFlorJpa = new TipoFlor();
                    if ($item[14]) {
                        $tipoFlorJpa = TipoFlor::updateOrCreate([
                            'name' => $item[14]
                        ], [
                            'visible' => 1,
                            'status' => 1
                        ]);
                    }

                    $productJpa = Products::updateOrCreate([
                        'sku' => $item[2],
                    ], [
                        'producto' => $item[3],
                        'extract' => $item[4],
                        'description' => $item[5],
                        'precio' => $item[8],
                        'descuento' => $item[8] - $item[10] > 0 ? $item[10] : 0,
                        'preciofiltro' => $item[10],
                        'categoria_id' => $categoryJpa?->id,
                        'parent_id' => $item[1],
                        'tipo_servicio' => strtolower($item[7]),
                        'puntos_complemento' => $item[12],
                        'tipo_flor_id' => $tipoFlorJpa?->id,
                        'subcategory_id' => $subcategoryJpa?->id,
                        'descripcion_dinamica' => $item[6]
                    ]);

                    $i = 0;
                    Galerie::where('product_id', $productJpa->id)->delete();

                    if (\count($productImages) == 0) {
                        $productJpa->visible = 0;
                        $productJpa->save();
                    }

                    foreach ($productImages as $image) {
                        try {
                            $productImage = 'seed/' . $image;
                            if ($i == 0) {
                                $productJpa->imagen = $productImage;
                                $productJpa->save();
                            } else {
                                Galerie::updateOrCreate([
                                    'product_id' => $productJpa->id,
                                    'imagen' => $productImage
                                ]);
                            }
                        } catch (\Throwable $th) {
                            dump($th->getMessage());
                        }
                        $i++;
                    }
                } catch (\Throwable $th) {
                    dump($th->getMessage());
                }
            }
        }, 'storage/app/utils/Products.xlsx');
    }
}
