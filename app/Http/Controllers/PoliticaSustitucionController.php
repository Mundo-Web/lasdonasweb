<?php

namespace App\Http\Controllers;

use App\Models\PoliticaSustitucion;
use Illuminate\Http\Request;

class PoliticaSustitucionController extends Controller
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
    public function show(PoliticaSustitucion $politicaSustitucion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PoliticaSustitucion $PoliticaSustitucion)
    {
        $terms = PoliticaSustitucion::first();
        if (!$terms) {
            $terms = PoliticaSustitucion::create(['content' => '']);
        }
        
        return view('pages.PoliticaSustitucion.edit', compact('terms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request , $id)
    {
        $request->validate([
            'content' => 'required',
        ]);
    
        $terms = PoliticaSustitucion::findOrfail($id); 
        $terms->update($request->all());
        $terms->save();

        return back()->with('success', 'Registro actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PoliticaSustitucion $politicaSustitucion)
    {
        //
    }
}
