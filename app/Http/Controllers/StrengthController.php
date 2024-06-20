<?php

namespace App\Http\Controllers;

use App\Models\Strength;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class StrengthController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$strength = Strength::all();
		return view('pages.strength.index', compact('strength'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return view('pages.strength.create');
	}

	public function saveImg($file, $route, $nombreImagen){
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
		
		$fortaleza = new Strength();
		try {
			if ($request->hasFile("icono")) {
				$file = $request->file('icono');
				$route = 'storage/images/icon/';
				$nombreImagen = Str::random(10) . '_' . $file->getClientOriginalName();
				
				$this->saveImg($file, $route, $nombreImagen);
	
				$fortaleza->icono = $route.$nombreImagen;
				// $fortaleza->name_image = $nombreImagen;
			}
			if ($request->hasFile("imagen")) {
				$file = $request->file('imagen');
				$routeImg = 'storage/images/imagen/';
				$nombreImagen = Str::random(10) . '_' . $file->getClientOriginalName();

				$this->saveImg($file, $routeImg, $nombreImagen);
	
				$fortaleza->imagen = $routeImg.$nombreImagen;
				// $fortaleza->name_image = $nombreImagen;
			}
	
			$fortaleza->titulo = $request->titulo;
			$fortaleza->descripcionshort = $request->descripcionshort;
			$fortaleza->descripcion = $request->descripcion;
			$fortaleza->save();

			return redirect()->route('strength.index')->with('success', 'Publicación creado exitosamente.');


		} catch (\Throwable $th) {
			return response()->json(['messge' => 'Verifique sus datos '], 400); 
		}

    

    

		// return redirect()->route('strength.index')->with('success', 'Publicación creado exitosamente.');

	}

	/**
	 * Display the specified resource.
	 */
	public function show(Strength $strength)
	{
		
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id)
	{
		
		$strength = Strength::find($id);

        return view('pages.strength.edit', compact('strength'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		$request->validate([
      'titulo' => 'required',
    ]);
		$fortaleza = Strength::find($id);
		try {
			if ($request->hasFile("icono")) {
				$file = $request->file('icono');
				$route = 'storage/images/icon/';
				$nombreImagen = Str::random(10) . '_' . $file->getClientOriginalName();
				
				$this->saveImg($file, $route, $nombreImagen);
	
				$fortaleza->icono = $route.$nombreImagen;
				// $fortaleza->name_image = $nombreImagen;
			}
			if ($request->hasFile("imagen")) {
				$file = $request->file('imagen');
				$routeImg = 'storage/images/imagen/';
				$nombreImagen = Str::random(10) . '_' . $file->getClientOriginalName();

				$this->saveImg($file, $routeImg, $nombreImagen);
	
				$fortaleza->imagen = $routeImg.$nombreImagen;
				// $fortaleza->name_image = $nombreImagen;
			}
	
			$fortaleza->titulo = $request->titulo;
			$fortaleza->descripcionshort = $request->descripcionshort;
			$fortaleza->descripcion = $request->descripcion;
			$fortaleza->save();

			return redirect()->route('strength.index')->with('success', 'Publicación creado exitosamente.');


		} catch (\Throwable $th) {
			return response()->json(['messge' => 'Verifique sus datos '], 400); 
		}
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function borrar(Request $request)
	{
		$strength = Strength::find($request->id);

		if ($strength->icono && file_exists($strength->icono)) {
			unlink($strength->icono);
		}
		if ($strength->imagen && file_exists($strength->imagen)) {
			unlink($strength->imagen);
		}

		$strength->delete();
		return response()->json(['message'=>'Logo eliminado']);
	}

	public function updateVisible(Request $request){
		$id = $request->id; 
		$stauts = $request->status; 
		$staff = Strength::find($id);
		$staff->status = $stauts; 

		$staff->save();
		return response()->json(['message'=> 'registro actualizado']);
}
}
