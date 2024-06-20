<?php

namespace App\Http\Controllers;

use App\Models\Liquidacion;
use App\Http\Requests\StoreLiquidacionRequest;
use App\Http\Requests\UpdateLiquidacionRequest;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class LiquidacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $liquidacion = Liquidacion::where("status", "=", true)->get();

        return view('pages.liquidacion.index', compact('liquidacion'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.liquidacion.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);
        $liquidacion = new Liquidacion();
        $manager = new ImageManager(new Driver());

        try {
			
			if ($request->hasFile("imagen")) {
				$file = $request->file('imagen');
				$routeImg = 'storage/images/liquidacion/';
				$nombreImagen = Str::random(10) . '_' . $file->getClientOriginalName();
				$this->saveImg($file, $routeImg, $nombreImagen);

                $liquidacion ->url_image = $routeImg;
                $liquidacion ->name_image = $nombreImagen;
			}else{
                $routeImg = 'images/img/';
                $nombreImagen = 'noimagenliquidacion.jpg';

                $liquidacion ->url_image = $routeImg;
                $liquidacion ->name_image = $nombreImagen;
            }

            $liquidacion ->botontext1 = $request->botontext1;
            $liquidacion ->link1 = '/liquidacion';
            $liquidacion ->title = $request->title;
            $liquidacion ->description = $request->description;
            $liquidacion ->save();
    
            return redirect()->route('liquidacion.index')->with('success', 'Liquidación creado exitosamente.');


		} catch (\Throwable $th) {
			return response()->json(['messge' => 'Verifique sus datos'], 400); 
		}
    }

    /**
     * Display the specified resource.
     */
    public function show(Liquidacion $liquidacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $liquidacion = Liquidacion::find($id);

        return view('pages.liquidacion.edit', compact('liquidacion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $liquidacion = Liquidacion::findOrfail($id);
      
        try {
			
			if ($request->hasFile("imagen")) {
				$file = $request->file('imagen');
				$routeImg = 'storage/images/liquidacion/';
				$nombreImagen = Str::random(10) . '_' . $file->getClientOriginalName();

                if ($liquidacion->url_image !== 'images/img/') {
                    File::delete($liquidacion->url_image . $liquidacion->name_image);
                }
                  
                $this->saveImg($file, $routeImg, $nombreImagen);
	
                $liquidacion->url_image = $routeImg;
                $liquidacion->name_image = $nombreImagen;

			}

            $liquidacion->title = $request->title;
            $liquidacion->description = $request->description;
            $liquidacion ->botontext1 = $request->botontext1;
            $liquidacion ->link1 = $request->link1;
            $liquidacion->update();

			return redirect()->route('liquidacion.index')->with('success', 'Slider modificado exitosamente.');


		} catch (\Throwable $th) {
			return response()->json(['messge' => 'Verifique sus datos '], 400); 
		}
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Liquidacion $liquidacion)
    {
        //
    }


    public function saveImg($file, $route, $nombreImagen){
		$manager = new ImageManager(new Driver());
		$img =  $manager->read($file);        
        $img->coverDown(1344, 700, 'center'); 
		if (!file_exists($route)) {
			mkdir($route, 0777, true); // Se crea la ruta con permisos de lectura, escritura y ejecución
	}
		$img->save($route . $nombreImagen);
	}


    public function deleteLiquidacion(Request $request)
    {
        //Recupero el id mandado mediante ajax
        $id = $request->id;
        
        //Busco el servicio con id como parametro
        $service = Liquidacion::findOrfail($id);
        //Modifico el status a false
        $service->status = false;
        //Guardo 
        $service->save();

        // Devuelvo una respuesta JSON u otra respuesta según necesites
        return response()->json(['message' => 'Banner de liquidación eliminado.']);
    }



    public function updateVisible(Request $request)
    {    
        $cantidad = $this->contarLiquidacionVisible();

        if($cantidad >= 1 && $request->status == 1){
            return response()->json(['message' => 'Solo puedes hacer visible 1 banner de liquidacion'], 409 );
        }

        $id = $request->id;
        $field = $request->field;
        $status = $request->status;
        $service = Liquidacion::findOrFail($id);
        $service->$field = $status;
        $service->save();

        $cantidad = $this->contarLiquidacionVisible();

        return response()->json(['message' => 'Banner de liquidación modificado',  'cantidad' => $cantidad]);
    }


    public function contarLiquidacionVisible(){

        $cantidad = Liquidacion::where('visible', '=', 1)->count();
        return  $cantidad;
    }
}
