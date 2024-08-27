<?php

namespace App\Http\Controllers;

use App\Models\PrecioEnvio;
use Illuminate\Http\Request;

class PrecioEnvioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $opcionesEnvio  = PrecioEnvio::where('status',1)->get();
        return view ('pages.precioEnvio.index', compact('opcionesEnvio') ) ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $envio = new PrecioEnvio();
        return view ('pages.precioEnvio.save', compact('envio') ) ;

    }

    /**
     * Store a newly created resource in storage.
     */
    public function save(Request $request)
    {
        //
        // dump($request->all());
        $request->validate([
            'name' => 'required',
            'direcction' => 'required',
            'zip_code' => 'required',
            'price' => 'required',
        ]);

        if($request->id){
            $envio = PrecioEnvio::find($request->id);
            $envio->update($request->all());
        }else{
            $envio = PrecioEnvio::create($request->all());
        }
        return redirect()->route('precio-envio.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(PrecioEnvio $precioEnvio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PrecioEnvio $precioEnvio)
    {
        //
        $envio = $precioEnvio; 
        return view ('pages.precioEnvio.save', compact('envio') ) ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PrecioEnvio $precioEnvio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PrecioEnvio $precioEnvio)
    {
        //
    }
    public function borrar(Request $request)
    {
      //softdelete
      
  
      $product = PrecioEnvio::find($request->id);
      $product->status = 0;
      $product->save();
    }
  
    public function updateVisible(Request $request)
    {
      $id = $request->id;
      $field = $request->field;
      $status = $request->status;
  
      // Verificar si el producto existe
      $product = PrecioEnvio::find($id);
  
      if (!$product) {
        return response()->json(['message' => 'Producto no encontrado'], 404);
      }
  
      // Actualizar el campo dinámicamente
      $product->update([
        $field => $status
      ]);
      return response()->json(['message' => 'registro actualizado']);
    }
}
