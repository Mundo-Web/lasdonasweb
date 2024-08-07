<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use Illuminate\Http\Request;

class TipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tipos = Tipo::all();
        return view('pages.tipos.index', compact('tipos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('pages.tipos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        
        $data = $request->all();
        $id= $request->id;
        $is_on = false ; 
        if(isset($request->is_default)){
            if($request->is_default == 'on'){
                $is_on = true;
            }
        }
        $data['is_default'] = $is_on;

        if(isset($id)){
            $tipo = Tipo::find($id);
            $tipo->update($data);
        }else{
            $tipo = Tipo::create($data);
        }

        return redirect()->route('tipos.index');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Tipo $tipo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        //
        $tipo= Tipo::find($id);
        return view('pages.tipos.edit', compact('tipo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tipo $tipo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deletetipos(Request $request)
    {
        //
        $id = $request->id;
        $tipo = Tipo::find($id);
        $tipo->delete();
        return response()->json(['success' => 'Tipo eliminado correctamente']);
    }
    
}
