<?php

namespace App\Http\Controllers;

use App\Models\Attributes;
use App\Models\TypeAttribute;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class AttributesController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $attributes = Attributes::where('status', true)->get();
    return view('pages.attributes.index', compact('attributes'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $typeatributo = TypeAttribute::all();
    return view('pages.attributes.create', compact('typeatributo'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    
    $request->validate([
      'titulo' => 'required',
    ]);

    $atributo = new Attributes();
    try {

      if ($request->hasFile("imagen")) {
        $file = $request->file('imagen');
        $routeImg = 'storage/images/atributos/';
        $nombreImagen = Str::random(10) . '_' . $file->getClientOriginalName();

        $this->saveImg($file, $routeImg, $nombreImagen);

        $atributo->imagen = $routeImg . $nombreImagen;
        // $AboutUs->name_image = $nombreImagen;
      }

      $atributo->titulo = $request->titulo;
      $atributo->descripcion = $request->descripcion;
      $atributo->color = $request->color;
      $atributo->type_atributte_id = $request->typeattribute_id;
      $atributo->save();

      return redirect()->route('attributes.index')->with('success', 'Publicación creado exitosamente.');
    } catch (\Throwable $th) {
      return redirect()->route('attributes.create')->with('success', 'Error al crear.');
      // return response()->json(['messge' => $th], 400);
    }
  }

  public function saveImg($file, $route, $nombreImagen)
  {
    $manager = new ImageManager(new Driver());
    $img =  $manager->read($file);


    if (!file_exists($route)) {
      mkdir($route, 0777, true); // Se crea la ruta con permisos de lectura, escritura y ejecución
    }

    $img->save($route . $nombreImagen);
  }
  /**
   * Display the specified resource.
   */
  public function show(Request $request)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $typeatributo = TypeAttribute::all();
    $attributes = Attributes::find($id);
   
    return view('pages.attributes.edit', compact('typeatributo', 'attributes'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    
    $request->validate([
      'titulo' => 'required',
    ]);
		$atributo = Attributes::find($id);
		try {
			
			if ($request->hasFile("imagen")) {
				$file = $request->file('imagen');
				$routeImg = 'storage/images/atributos/';
				$nombreImagen = Str::random(10) . '_' . $file->getClientOriginalName();

				$this->saveImg($file, $routeImg, $nombreImagen);
	
				$atributo->imagen = $routeImg.$nombreImagen;
				// $aboutUs->name_image = $nombreImagen;
			}
	
			$atributo->titulo = $request->titulo;
			$atributo->descripcion = $request->descripcion;
			$atributo->color = $request->color;
      $atributo->type_atributte_id = $request->typeattribute_id;

			$atributo->save();

			return redirect()->route('attributes.index')->with('success', 'Publicación creado exitosamente.');
 

		} catch (\Throwable $th) {
			return response()->json(['messge' => 'Verifique sus datos '], 400); 
		}
   
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Attributes $attributes)
  {
    //
  }
  public function updateVisible(Request $request)
  {
    
    $id = $request->id;
    $status = $request->status;
    $Attributes = Attributes::find($id);
    $Attributes->visible = $status;

    $Attributes->save();
    return response()->json(['message' => 'registro actualizado']);
  }

  public function borrar(Request $request)
  {
    $Attributes = Attributes::find($request->id);

		if ($Attributes->imagen && file_exists($Attributes->imagen)) {
			unlink($Attributes->imagen);
		}

		$Attributes->delete();

		return response()->json(['message'=>'Atributo eliminado']);
  }
}
