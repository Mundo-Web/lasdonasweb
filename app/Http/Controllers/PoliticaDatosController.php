<?php

namespace App\Http\Controllers;

use App\Models\PoliticaDatos;
use Illuminate\Http\Request;

class PoliticaDatosController extends Controller
{
    //
    public function edit()
    {
        //resources\views\pages\politicaDatos\edit.blade.php
        $politicas = PoliticaDatos::first();
        $politicas = $politicas ?? new PoliticaDatos();
        return view('pages.politicaDatos.edit', compact('politicas'));
    }
    public function save(Request $request)
    {
        $id = $request->id;

        
        try {
            $request->validate([
                'content' => 'required',
            ]);

            if ($id == null) {
                 PoliticaDatos::create($request->all());
                
                return back()->with('success', 'Registro actualizado correctamente');
            } else {
                $terms = PoliticaDatos::findOrfail($id);
                $terms->update($request->all());
                $terms->save();
                return back()->with('success', 'Registro actualizado correctamente');
            }
        } catch (\Throwable $th) {
            //throw $th;
            
        }







        // return view('pages.politicaDatos.edit', compact('politicas'));
        // return back()->with('success', 'Registro actualizado correctamente');
    }
}
