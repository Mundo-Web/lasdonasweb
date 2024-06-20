<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staff = Staff::all();
        return view('pages.staff.index', compact('staff') );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.staff.create');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        Staff::create($request->all());

        return redirect()->route('staff.index')->with('success', 'Publicación creado exitosamente.');

        
        
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
        $staff = Staff::find($id);

        return view('pages.staff.edit', compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        Staff::updateOrCreate(
            ['id' => $id], // Condiciones para buscar el registro existente
            $request->all() // Datos para actualizar o crear el registro
        );
        return redirect()->route('staff.index')->with('success', 'Publicación Actualizada exitosamente.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function updateVisible(Request $request){
        $id = $request->id; 
        $stauts = $request->status; 
        $staff = Staff::find($id);
        $staff->status = $stauts; 

        $staff->save();
        return response()->json(['message'=> 'registro actualizado']);
    }
}
