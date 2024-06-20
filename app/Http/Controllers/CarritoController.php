<?php

namespace App\Http\Controllers;

use App\Models\AttributesValues;
use App\Models\Products;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function buscarProducto(Request $request){
       $id =  $request->id; 
       $cantidad =  (int)$request->cantidad; 
       
        //busco producto 

        $producto = Products::find($id);
        $attributos = AttributesValues::find($request->colorId);

        $caratula = Products::where('id', '=', $id)
        ->with([ 'images' => function($query){
            $query->where('caratula', 1);
        }

        ])->first();

        
        return response()->json(['message' => 'Producto encontrado ', 'data' => $producto , 'cantidad'=> $cantidad , 'caratula' => $caratula , 'valorAtributo' => $attributos] );
    }
}


// ->join('imagen_productos', 'products.id' , '=', 'imagen_productos.product_id')