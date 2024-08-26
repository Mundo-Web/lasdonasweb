<?php

namespace App\Http\Controllers;

use App\Http\Classes\dxResponse;
use App\Models\Attributes;
use App\Models\AttributesValues;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Combinacion;
use App\Models\Complemento;
use App\Models\dxDataGrid;
use App\Models\Horarios;
use App\Models\ImagenProducto;
use App\Models\Products;
use App\Models\Specifications;
use App\Models\Tag;
use App\Models\Tipo;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use SoDe\Extend\File as ExtendFile;
use Illuminate\Validation\ValidationException;

class ProductsController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $products =  Products::where("status", "=", true)->where('parent_id', '=', null)->with('images')->get();
    return view('pages.products.index', compact('products'));
  }


  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $product  = new Products();
    $atributos = Attributes::where("status", "=", true)->get();
    $valorAtributo = AttributesValues::where("status", "=", true)->get();
    $allTags = Tag::where("status", "=", true)->get();
    $categoria = Category::all();
    $collection = Collection::all();
    $tipo = Tipo::where("status", "=", true)->get();
    $complementos  = Complemento::where('status', 1)->get();
    $especificacion = [];
    $subproductos = [];
    return view('pages.products.save', compact('product', 'atributos', 'valorAtributo', 'categoria', 'allTags', 'collection', 'tipo', 'complementos', 'especificacion', 'subproductos'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {

    $product =  Products::with('tags')->find($id);
    $subproductos = Products::where('parent_id', '=', $id)->with('images')->get();
    $tipo = Tipo::where("status", "=", true)->get();


    $atributos = Attributes::where("status", "=", true)->get();
    $valorAtributo = AttributesValues::where("status", "=", true)->get();


    $especificacion = Specifications::where("product_id", "=", $id)->get();
    $allTags = Tag::all();
    $categoria = Category::all();
    $collection = Collection::all();

    $subproductosEspeccifications = [];

    // Itera sobre los subproductos para extraer los IDs
    foreach ($subproductos as $subproducto) {
      // Añade el ID del subproducto al array
      $subproductosEspeccifications[$subproducto->id] = Specifications::where("product_id", "=", $subproducto->id)->get();
    }


    return view('pages.products.save', compact('product', 'subproductosEspeccifications', 'subproductos', 'tipo', 'atributos', 'valorAtributo', 'allTags', 'categoria', 'especificacion', 'collection'));
  }

  public function save(Request $request)
  {

    $actualizacion = true;
    $valoresFormulario = $request->input('valoresFormulario');
    // Si 'valoresFormulario' es una cadena JSON, decodificarla a un array PHP
    if (is_string($valoresFormulario)) {
      $valoresFormulario = json_decode($valoresFormulario, true);
    }


    $especificaciones = [];
    $precioFiltro = 0;
    $data = $request->except('valoresFormulario');
    $atributos = null;
    $tagsSeleccionados = $request->input('tags_id');
    $onlyOneCaratula = false;


    if (is_null($request->input('descuento'))) {
      $request->merge(['descuento' => 0]);
      $data['descuento'];
    }

    try {
      //code...
      $request->validate([
        'producto' => 'required',
        'categoria_id' => 'required',
        'precio' => 'min:0|required|numeric',
        'descuento' => 'lt:' . $request->input('precio'),
      ]);

      $data['imagen'] = $this->handleImageUpload($request);
      list($cleanedData, $atributos, $especificaciones) = $this->processAndCleanProductData($data);


      $product = Products::find($request->id);
      if (!$product) {
        $product = new Products($cleanedData);
        $product->save();
      }
      else $product->update($cleanedData);
      dump($product);

      if ($product['descuento'] == 0 || is_null($product['descuento'])) {
        $precioFiltro = $product['precio'];
      } else {
        $precioFiltro = $product['descuento'];
      }
      $product->update(['preciofiltro' => $precioFiltro]);

      $this->GuardarEspecificaciones($product->id, $especificaciones, $actualizacion);

      $this->associateAttributesToProduct($atributos, $product, $actualizacion);
      $product->tags()->sync($tagsSeleccionados);

      $this->processAndSaveProductImages($data, $request, $product);
      foreach ($request->files as $key => $file) {
        if (strpos($key, 'input-file-') === 0) {
          $file = $request->file($key);
          $number = substr($key, strpos($key, 'input-file-') + strlen('input-file-')); // Esto imprimirá "541" si $key es "input-file-541"

          $this->actImg($file, $number);
        }
      }

      $this->procesarOpciones($product, $valoresFormulario, $tagsSeleccionados, $request, $actualizacion);
    } catch (\Throwable $th) {
      //throw $th;

      dd($th->getMessage() . ' Ln' . $th->getLine());


    }


    // return;

    return redirect()->route('products.index')->with('success', 'Producto editado exitosamente.');
  }

  public function search(Request $request)
  {
    $search = $request->input('q');
    $products = Products::where('tipo_servicio', 'producto')->where('producto', 'like', '%' . $search . '%')->get();
    return response()->json($products);
  }

  public function saveImg($file, $route, $nombreImagen)
  {
    $manager = new ImageManager(new Driver());
    $img =  $manager->read($file);
    $img->coverDown(800, 800, 'center');

    if (!file_exists($route)) {
      mkdir($route, 0777, true);
    }

    $img->save($route . $nombreImagen);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {





    $valoresFormulario = $request->input('valoresFormulario');

    // Si 'valoresFormulario' es una cadena JSON, decodificarla a un array PHP
    if (is_string($valoresFormulario)) {
      $valoresFormulario = json_decode($valoresFormulario, true);
    }

    // Aquí puedes trabajar con $valoresFormulario como un array PHP

    $especificaciones = [];
    $data = $request->except('valoresFormulario');
    $atributos = null;
    $tagsSeleccionados = $request->input('tags_id');
    $onlyOneCaratula = false;

  
    // return ;

    //imprimir valores request 
    if (isset($data['uppsell'])) {
      $data['uppsell'] = json_encode($data['uppsell']);
    }

    if (isset($data['complementos'])) {
      $data['complementos'] = json_encode($data['complementos']);
    }

    if (is_null($request->input('descuento'))) {
      $request->merge(['descuento' => 0]);
      $data['descuento'];
    }

    //vemos si el tipo seleccionado es el por defecto 

    $data['parent_id'] = null;

    if (isset($request->complemento)) {
      $data["tipo_servicio"] = 'complemento'; // cambiar 
    } else {
      $data["tipo_servicio"] = 'producto';
    }


    // $valorprecio = $request->input('precio') - 0.1;

    try {
      $request->validate([
        'producto' => 'required',
        'categoria_id' => 'required',
        'precio' => 'min:0|required|numeric',
        'descuento' => 'lt:' . $request->input('precio'),
      ]);



      $data['imagen'] = $this->handleImageUpload($request);


      list($cleanedData, $atributos, $especificaciones) = $this->processAndCleanProductData($data);
      // $cleanedData = $this->processAndCleanProductData($data, $request);



      $producto = Products::create($cleanedData);




      if ($producto['descuento'] == 0 || is_null($producto['descuento'])) {
        $precioFiltro = $producto['precio'];
      } else {
        $precioFiltro = $producto['descuento'];
      }
      $producto->update(['preciofiltro' => $precioFiltro]);

      $this->associateAttributesToProduct($atributos, $producto);




      $this->GuardarEspecificaciones($producto->id, $especificaciones);

      /*  if (!is_null($tagsSeleccionados)) {
        $this->TagsXProducts($producto->id, $tagsSeleccionados);
      } */

      $producto->tags()->sync($tagsSeleccionados);



      $this->processAndSaveProductImages($data, $request, $producto);

      //procesarOpciones Adicionales 
      $this->procesarOpciones($producto, $valoresFormulario, $tagsSeleccionados, $request);


      return redirect()->route('products.index')->with('success', 'Publicación creado exitosamente.');
    } catch (ValidationException $e) {
      // Redirigir con los errores de validación y los datos de entrada

      /* return redirect()->back()
        ->withErrors($e->validator)
        ->withInput(); */
    } catch (\Throwable $th) {
      //throw $th;
      // dump($th);

      return redirect()->route('products.create')->with('error', 'Llenar campos obligatorios');
    }
  }
  private function convertirArray($arrayEntrada)
  {
    $arrayResultado = [];

    // Procesar cada elemento del array de entrada
    foreach ($arrayEntrada as $elemento) {
      foreach ($elemento as $subElemento) {
        foreach ($subElemento as $clave => $valor) {
          // Ignorar claves 'undefined'
          if ($clave !== 'undefined' && $clave !== '') {
            // Convertir y agregar al array resultado
            $arrayResultado[$clave] = $valor;
          }
        }
      }
    }

    return $arrayResultado;
  }

  private function procesarOpciones($productoParent, $valoresFormulario, $tags, $request, $actualizacion = false)
  {
    if (!is_null($valoresFormulario)) {
      foreach ($valoresFormulario as $key => $value) {
        $arrayConvertido =  $value;


        $precioFiltro = 0;

        if ($arrayConvertido['descuento'] == 0 || is_null($arrayConvertido['descuento'])) {
          $precioFiltro = $arrayConvertido['precio'];
        } else {
          $precioFiltro = $arrayConvertido['descuento'];
        }

        $request->replace($arrayConvertido);

        $imagenOpcion = $this->handleImageUpload($request);

        $data = [
          'producto' => $productoParent->producto,
          'extract' => $productoParent->extract,
          'description' => $arrayConvertido['description'],
          'precio' => $arrayConvertido['precio'],
          'descuento' => $arrayConvertido['descuento'],
          'preciofiltro' => $precioFiltro,
          'sku' => $arrayConvertido['sku'],

          'imagen' => $imagenOpcion,
          'categoria_id' => $productoParent->categoria_id,
          'tipo_prodct' => $arrayConvertido['tipo_prodct'],
          'parent_id' => $productoParent->id,
          'tipo_servicio' => 'complemento'
        ];

        if ($actualizacion && isset($value['id'])) {
          $producto = Products::find($value['id']);
          $producto->update($data);
        } else {
          $actualizacion = false ; 
          $producto = Products::create($data);
        }




        list($cleanedData, $atributos) = $this->processAndCleanProductData($arrayConvertido);

        $this->associateAttributesToProduct($atributos, $producto, $actualizacion);
        $this->GuardarEspecificaciones($producto->id, $arrayConvertido['specifiaciones'], $actualizacion);
        $producto->tags()->sync($tags);


        $this->processAndSaveProductImages($arrayConvertido,  $request, $producto);
      }
    }
  }
  /**
   * Procesa y guarda las imágenes del producto.
   *
   * @param  array  $data
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Product  $producto
   * @return void
   */
  private function processAndSaveProductImages(array $data, Request $request, $producto)
  {
    $onlyOneCaratula = false;
    $routeImg = '';
    $nombreImagen = '';


    foreach ($data as $key => $value) {
      if (strpos($key, 'attrid-') === 0) {


        $colorId = substr($key, strrpos($key, '-') + 1);
        foreach ($value as $file) {
          $this->GuardarGaleria($file, $producto->id, $colorId);
        }
      } elseif (strpos($key, 'imagenP-') === 0) {

        $colorId = substr($key, strrpos($key, '-') + 1);
        $isCaratula = 0;
        if (isset($data['caratula']) && !$onlyOneCaratula) {
          $isCaratula = 1;
          $onlyOneCaratula = true;
        }
        $file = $request->file($key);


        if (is_null($file)) {

          $this->GuardarGaleria($value, $producto->id, $colorId, $isCaratula);
        } else {

          $routeImg = 'storage/images/productos/';
          $nombreImagen = Str::random(10) . '_' . $file->getClientOriginalName();

          $this->saveImg($file, $routeImg, $nombreImagen);
          $dataGalerie = [
            'name_imagen' => $routeImg . $nombreImagen,
            'product_id' => $producto->id,
            'type_imagen' => 'primary',
            'caratula' => $isCaratula,
            // 'color_id' => $colorId,
          ];
          ImagenProducto::create($dataGalerie);
        }
      } elseif (strpos($key, 'conbinacion-') === 0) {
        $this->GuardarCombinacion($producto->id, $value);
      }
    }
  }
  /**
   * Asocia atributos y sus valores a un producto.
   *
   * @param  array  $atributos
   * @param  \App\Models\Product  $producto
   * @return void
   */
  private function associateAttributesToProduct(array $atributos, $producto, $actualizacion = false)
  {
    if (!empty($atributos)) {
      if ($actualizacion) {
        DB::table('attribute_product_values')->where('product_id', $producto->id)->delete();
      }
      foreach ($atributos as $atributo => $valores) {
        $idAtributo = Attributes::where('titulo', $atributo)->first();

        foreach ($valores as $valor) {
          $idValorAtributo = AttributesValues::where('valor', $valor)->first();

          if ($idAtributo && $idValorAtributo) {
            DB::table('attribute_product_values')->insert([
              'product_id' => $producto->id,
              'attribute_id' => $idAtributo->id,
              'attribute_value_id' => $idValorAtributo->id,
            ]);
          }
        }
      }
    }
  }

  /**
   * Procesa y limpia los datos del producto.
   *
   * @param  array  $data
   * @return array
   */
  private function processAndCleanProductData(array $data)
  {
    $atributos = [];
    $especificaciones = [];

    foreach ($data as $key => $value) {
      if (strstr($key, ':')) {
        // Separa el nombre del atributo y su valor
        $atributos = $this->stringToObject($key, $atributos);
        unset($data[$key]);
      } elseif (strstr($key, '-')) {
        if (strpos($key, 'tittle-') === 0 || strpos($key, 'title-') === 0) {
          $num = substr($key, strrpos($key, '-') + 1);
          $especificaciones[$num]['tittle'] = $value;
        } elseif (strpos($key, 'specifications-') === 0) {
          $num = substr($key, strrpos($key, '-') + 1);
          $especificaciones[$num]['specifications'] = $value;
        }
      }
    }

    $jsonAtributos = json_encode($atributos);
    $data['atributes'] = $jsonAtributos;

    // Procesar flags
    $flags = ['destacar', 'recomendar', 'liquidacion'];
    foreach ($flags as $flag) {
      if (array_key_exists($flag, $data)) {
        $data[$flag] = strtolower($data[$flag]) == 'on' ? 1 : 0;
      }
    }

    // Limpiar datos
    $cleanedData = Arr::where($data, function ($value, $key) {
      return !is_null($value);
    });

    // return $cleanedData;
    return [$cleanedData, $atributos, $especificaciones];
  }

  private function handleImageUpload(Request $request, $inputName = 'imagen', $defaultImage = 'images/img/noimagen.jpg', $storagePath = 'storage/images/productos/')
  {
    if ($request->hasFile($inputName)) {
      $file = $request->file($inputName);
      $nombreImagen = Str::random(10) . '_' . $file->getClientOriginalName();
      $this->saveImg($file, $storagePath, $nombreImagen);
      return $storagePath . $nombreImagen;
    } else {
      return $defaultImage;
    }
  }

  private function GuardarCombinacion($producto_id, $combinacion)
  {
    Combinacion::create([

      'product_id' => $producto_id,
      'color_id' => $combinacion['color'],
      'talla_id' => $combinacion['talla'],
      'stock' => $combinacion['stock'],
    ]);
  }
  private function GuardarGaleria($file, $producto_id, $colorId, $isCaratula = 0)
  {

    try {
      //code...
      [$first, $code] = explode(';base64,', $file);



      $imageData = base64_decode($code);


      $routeImg = 'storage/images/gallery/';
      $ext = ExtendFile::getExtention(str_replace("data:", '', $first));
      $nombreImagen = Str::random(10) . '.' . $ext;
      // Verificar si la ruta no existe y crearla si es necesario
      if (!file_exists($routeImg)) {
        mkdir($routeImg, 0777, true);
      }
      // Guardar los datos binarios en un archivo
      file_put_contents($routeImg . $nombreImagen, $imageData);
      $dataGalerie['name_imagen'] = $routeImg . $nombreImagen;
      $dataGalerie['product_id'] = $producto_id;
      $dataGalerie['type_imagen'] = 'secondary';
      $dataGalerie['caratula'] = $isCaratula;
      // $dataGalerie['color_id'] = $colorId;

      // $dataGalerie['type_img'] = 'gall';
      ImagenProducto::create($dataGalerie);
      return [$routeImg, $nombreImagen];
    } catch (\Throwable $th) {
      //throw $th;
    }
  }

  private function TagsXProducts($id, $nTags)
  {
    foreach ($nTags as $key => $value) {
      DB::insert('insert into tags_xproducts (producto_id, tag_id) values (?, ?)', [$id, $value]);
    }
  }


  private function GuardarEspecificaciones($id, $especificaciones, $actualizacion = false)
  {

    if ($actualizacion) {
      $this->actualizarEspecificacion($especificaciones, $id);
    } else {
      foreach ($especificaciones as $value) {
        $value['product_id'] = $id;
        Specifications::create($value);
      }
    }
  }

  private function actualizarEspecificacion($especificaciones, $product_id)
  {
    foreach ($especificaciones as $key => $value) {
      if (isset($value['tittle'])) {
        $espect = Specifications::find($key);
        if (!$espect) $espect = new Specifications();
        $espect->tittle = $value['tittle'];
        $espect->specifications = $value['specifications'];

        if ($value['specifications'] == null) {
          $espect->delete();
        } else {
          $espect->save();
        }
      }
    }
  }

  private function stringToObject($key, $atributos)
  {

    $parts = explode(':', $key);
    $nombre = strtolower($parts[0]); // Nombre del atributo
    $valor = strtolower($parts[1]); // Valor del atributo en minúsculas

    // Verifica si el atributo ya existe en el array
    if (isset($atributos[$nombre])) {
      // Si el atributo ya existe, agrega el nuevo valor a su lista
      $atributos[$nombre][] = $valor;
    } else {
      // Si el atributo no existe, crea una nueva lista con el valor
      $atributos[$nombre] = [$valor];
    }
    return $atributos;
  }

  /**
   * Display the specified resource.
   */
  public function show(Products $products)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {

    $actualizacion = true;
    $valoresFormulario = $request->input('valoresFormulario');
    // Si 'valoresFormulario' es una cadena JSON, decodificarla a un array PHP
    if (is_string($valoresFormulario)) {
      $valoresFormulario = json_decode($valoresFormulario, true);
    }

    
    $especificaciones = [];
    $precioFiltro = 0;
    $data = $request->except('valoresFormulario');
    $atributos = null;
    $tagsSeleccionados = $request->input('tags_id');
    $onlyOneCaratula = false;


    if (is_null($request->input('descuento'))) {
      $request->merge(['descuento' => 0]);
      $data['descuento'];
    }

    try {
      //code...
      $request->validate([
        'producto' => 'required',
        'categoria_id' => 'required',
        'precio' => 'min:0|required|numeric',
        'descuento' => 'lt:' . $request->input('precio'),
      ]);

      $data['imagen'] = $this->handleImageUpload($request);
      list($cleanedData, $atributos, $especificaciones) = $this->processAndCleanProductData($data);


      $product = Products::find($id);
      $product->update($cleanedData);

      if ($product['descuento'] == 0 || is_null($product['descuento'])) {
        $precioFiltro = $product['precio'];
      } else {
        $precioFiltro = $product['descuento'];
      }
      $product->update(['preciofiltro' => $precioFiltro]);

      $this->GuardarEspecificaciones($product->id, $especificaciones, $actualizacion);

      $this->associateAttributesToProduct($atributos, $product, $actualizacion);
      $product->tags()->sync($tagsSeleccionados);

      $this->processAndSaveProductImages($data, $request, $product);
      foreach ($request->files as $key => $file) {
        if (strpos($key, 'input-file-') === 0) {
          $file = $request->file($key);
          $number = substr($key, strpos($key, 'input-file-') + strlen('input-file-')); // Esto imprimirá "541" si $key es "input-file-541"

          $this->actImg($file, $number);
        }
      }

      $this->procesarOpciones($product, $valoresFormulario, $tagsSeleccionados, $request, $actualizacion);
    } catch (\Throwable $th) {
      //throw $th;
      
    }


    // return;

    return redirect()->route('products.index')->with('success', 'Producto editado exitosamente.');
  }

  private function actImg($file, $id)
  {

    try {
      $imagenGaleria = ImagenProducto::find($id);
      $rutaCompleta  = $imagenGaleria->name_imagen;

      $routeImg = 'storage/images/productos/';
      $nombreImagen = Str::random(10) . '_' . $file->getClientOriginalName();
      if (file_exists($rutaCompleta)) {
        // Intentar eliminar el archivo
        if (unlink($rutaCompleta)) {
          // Archivo eliminado con éxito
          $imagenGaleria->update(['name_imagen' => $routeImg . $nombreImagen]);
        }
      }
      $this->saveImg($file, $routeImg, $nombreImagen);
    } catch (\Throwable $th) {
      //throw $th;

    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function borrar(Request $request)
  {
    //softdelete
    DB::delete('delete from galeries where product_id = ?', [$request->id]);

    $product = Products::find($request->id);
    $product->status = 0;
    $product->save();
  }

  public function updateVisible(Request $request)
  {
    $id = $request->id;
    $field = $request->field;
    $status = $request->status;

    // Verificar si el producto existe
    $product = Products::find($id);

    if (!$product) {
      return response()->json(['message' => 'Producto no encontrado'], 404);
    }

    // Actualizar el campo dinámicamente
    $product->update([
      $field => $status
    ]);
    return response()->json(['message' => 'registro actualizado']);
  }

  public function borrarimg(Request $request)
  {
    try {
      //code...
      $imagenGaleria = ImagenProducto::find($request->id);
      $rutaCompleta  = $imagenGaleria->name_imagen;
      if (file_exists($rutaCompleta)) {
        // Intentar eliminar el archivo
        if (unlink($rutaCompleta)) {
          // Archivo eliminado con éxito

        }
      }
      $imagenGaleria->delete();
      return response()->json(['message' => 'imagen eliminada con exito ']);
    } catch (\Throwable $th) {
      //throw $th;
      return response()->json(['message' => 'no se ha podido eliminar la imagen '], 400);
    }
  }
  public function deleteOption(Request $request)
  {
    try {
      //code...

      Specifications::where('product_id', $request->id)->delete();

      $producto = Products::find((int) $request->id);
      $producto->delete();
      $this->borrarimg($request);
      return response()->json(['message' => 'opcion eliminada con exito ']);
    } catch (\Throwable $th) {
      //throw $th;
      return response()->json(['message' => 'no se ha podido eliminar la opcion '], 400);
    }
  }

  public function deleteEspect(Request $request)
  {
    try {
      //code...
      $espect = Specifications::find($request->id);
      $espect->delete();
      return response()->json(['message' => 'especificacion eliminada con exito ']);
    } catch (\Throwable $th) {
      //throw $th;
      return response()->json(['message' => 'no se ha podido eliminar la especificacion '], 400);
    }
  }

  public function saveSpec(Request $request)
  {
    try {
      //code...
      $espect = Specifications::create($request->all());
      return response()->json(['message' => 'especificacion guardada con exito ',  'especificacion' => $espect]);
    } catch (\Throwable $th) {
      //throw $th;
      return response()->json(['message' => 'no se ha podido guardar la especificacion '], 400);
    }
  }
  public function paginate(Request $request)
  {
    $response =  new dxResponse();

    try {
      $instance = Products::select([
        DB::raw('DISTINCT products.*')
      ])
        ->with(['categoria', 'images'])

        ->join('categories', 'categories.id', 'products.categoria_id')


        ->where('products.status', 1)
        ->where('categories.visible', 1)
        ->where('tipo_servicio', 'producto');

      if ($request->group != null) {
        [$grouping] = $request->group;
        $selector = \str_replace('.', '__', $grouping['selector']);
        $instance = Products::select([
          "{$selector} AS key"
        ])
          ->groupBy($selector);
      }

      if ($request->filter) {
        $instance->where(function ($query) use ($request) {
          dxDataGrid::filter($query, $request->filter ?? [], false);
        });
      }

      if ($request->sort != null) {
        foreach ($request->sort as $sorting) {
          // $selector = \str_replace('.', '__', $sorting['selector']);
          $selector = $sorting['selector'];
          $instance->orderBy(
            $selector,
            $sorting['desc'] ? 'DESC' : 'ASC'
          );
        }
      } else {
        $instance->orderBy('products.id', 'DESC');
      }

      $totalCount = 0;
      if ($request->requireTotalCount) {
        $instanceClone = clone $instance;

        // Obtén los IDs utilizando pluck
        $ids = $instanceClone->pluck('products.id');
        // $totalCount = $instance->count('*');
        $totalCount = $ids->count();
      }

      $jpas = [];
      if (!$request->ignoreData) {
        $jpas = $request->isLoadingAll
          ? $instance->get()
          : $instance
          ->skip($request->skip ?? 0)
          ->take($request->take ?? 10)
          ->get();
      }

      // $results = [];

      // foreach ($jpas as $jpa) {
      //   $result = JSON::unflatten($jpa->toArray(), '__');
      //   $results[] = $result;
      // }

      $response->status = 200;
      $response->message = 'Operación correcta';
      $response->data = $jpas;
      $response->totalCount = $totalCount;

      return response()->json(['message' => 'Operación correcta', 'data' => $jpas, 'totalCount' => $totalCount], 200);
    } catch (\Throwable $th) {
      $response->status = 400;
      $response->message = $th->getMessage() . " " . $th->getFile() . ' Ln.' . $th->getLine();
      return response()->json(['message' => $th->getMessage() . " " . $th->getFile() . ' Ln.' . $th->getLine()], 400);
    }
  }

  public function AddOrder(Request $request)
  {
    try {
      //code...
      $data = $request->all();
      $productos = Products::with(['images', 'tipos'])->find($data['opcion']);
      $horario = Horarios::select('id', 'start_time', 'end_time')->find($data['horario']);
      $complemento = [];
      $fecha = $data['fecha'];
      foreach ($data['complementos'] as $key => $value) {
        $complemento[] = Products::with(['images', 'tipos'])->find($value)->toArray();
      }

      if ($fecha == 'hoy') {
        $fecha = date('Y-m-d');
      } else if ($fecha == 'manana') {
        $fecha = date('Y-m-d', strtotime('+1 day'));
      }
      return response()->json([
        'message' => 'orden actualizado con exito ',
        'producto' => $productos,
        'horario' => $horario,
        'complementos' => $complemento,
        'fecha' => $fecha,
        'imagen' => $data['imagen']
      ]);
    } catch (\Throwable $th) {
      //throw $th;
      return response()->json(['message' => 'No se ha podido agregar el producto '], 400);
    }
  }
}
