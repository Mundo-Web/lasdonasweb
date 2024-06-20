<?php

namespace App\Http\Controllers;

use App\Models\Testimony;
use App\Http\Requests\StoreTestimonyRequest;
use App\Http\Requests\UpdateTestimonyRequest;
use Illuminate\Http\Request;

class TestimonyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimony = Testimony::where("status", "=", true)->get();

        return view('pages.testimonies.index', compact('testimony'));

        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.testimonies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $testimony = new Testimony(); 

        $testimony->name = $request->name;
        $testimony->ocupation = $request->ocupation;
        $testimony->testimonie = $request->testimonie;
        $testimony->status = 1;
        $testimony->visible = 1;

        $testimony->save();
       
        return redirect()->route('testimonios.index')->with('success', 'Testimonio creado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Testimony $testimony)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimony $testimony, $id)
    {
        $testimony = Testimony::findOrfail($id);

        return view('pages.testimonies.edit', compact('testimony'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $testimony = Testimony::findOrfail($id); 

        // $testimony->name = $request->name;
        // $testimony->email = $request->email;
        // $testimony->ocupation = $request->ocupation;
        // $testimony->testimonie = $request->testimonie;
        // $testimony->ocupation = $request->ocupation;
        // $testimony->status = $request->status;

        $testimony->update($request->all());

        $testimony->save();

        return redirect()->route('testimonios.index')->with('success', 'Testimonio modificado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimony $testimony)
    {
        //
    }

    public function deleteTestimony(Request $request)
    {
        $id = $request->id;
        //Busco el servicio con id como parametro
        $testimony = Testimony::findOrfail($id); 
        //Modifico el status a false
        $testimony->status = false;
        //Guardo 
        $testimony->save();

        // Devuelvo una respuesta JSON u otra respuesta según necesites
        return response()->json(['message' => 'Testimonio eliminado.']);
    }


    
    public function updateVisible(Request $request)
    {
        // Lógica para manejar la solicitud AJAX
        //return response()->json(['mensaje' => 'Solicitud AJAX manejada con éxito']);
        $id = $request->id;

        $field = $request->field;

        $status = $request->status;

        $testimony = Testimony::findOrFail($id);
        
        $testimony->$field = $status;

        $testimony->save();

         return response()->json(['message' => 'Estado modificado.']);
    
    }
}
