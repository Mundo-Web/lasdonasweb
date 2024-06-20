<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class AboutUsController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $aboutUs = AboutUs::all();
    return view('pages.aboutus.index', compact('aboutUs'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('pages.aboutus.create');
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
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      'titulo' => 'required',
    ]);

    $AboutUs = new AboutUs();
    try {

      if ($request->hasFile("imagen")) {
        $file = $request->file('imagen');
        $routeImg = 'storage/images/imagen/';
        $nombreImagen = Str::random(10) . '_' . $file->getClientOriginalName();

        $this->saveImg($file, $routeImg, $nombreImagen);

        $AboutUs->imagen = $routeImg . $nombreImagen;
        // $AboutUs->name_image = $nombreImagen;
      }

      $AboutUs->titulo = $request->titulo;
      $AboutUs->descripcion = $request->descripcion;
      $AboutUs->save();

      return redirect()->route('aboutus.index')->with('success', 'Publicación creado exitosamente.');
    } catch (\Throwable $th) {
      return response()->json(['messge' => 'Verifique sus datos '], 400);
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(AboutUs $aboutUs)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $aboutUs = AboutUs::find($id);

    return view('pages.aboutus.edit', compact('aboutUs'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $request->validate([
      'titulo' => 'required',
    ]);
		$aboutUs = AboutUs::find($id);
		try {
			
			if ($request->hasFile("imagen")) {
				$file = $request->file('imagen');
				$routeImg = 'storage/images/imagen/';
				$nombreImagen = Str::random(10) . '_' . $file->getClientOriginalName();

				$this->saveImg($file, $routeImg, $nombreImagen);
	
				$aboutUs->imagen = $routeImg.$nombreImagen;
				// $aboutUs->name_image = $nombreImagen;
			}
	
			$aboutUs->titulo = $request->titulo;
			$aboutUs->descripcion = $request->descripcion;
			$aboutUs->save();

			return redirect()->route('aboutus.index')->with('success', 'Publicación creado exitosamente.');


		} catch (\Throwable $th) {
			return response()->json(['messge' => 'Verifique sus datos '], 400); 
		}
  }

  /**
   * Remove the specified resource from storage.
   */
  public function borrar(Request $request)
  {
    $strength = AboutUs::find($request->id);

		
		if ($strength->imagen && file_exists($strength->imagen)) {
			unlink($strength->imagen);
		}

		$strength->delete();
		return response()->json(['message'=>'Logo eliminado']);
  }

  public function updateVisible(Request $request)
  {
    
    $id = $request->id;
    $stauts = $request->status;
    $staff = AboutUs::find($id);
    $staff->status = $stauts;

    $staff->save();
    return response()->json(['message' => 'registro actualizado']);
  }
}
