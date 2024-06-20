<?php

namespace App\Http\Controllers;

use App\Models\opciones_envio;
use Illuminate\Http\Request;

class OpcionesEnvioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $opcionesEnvio = [];
        return view('pages.opcionesEnvio.index', compact("opcionesEnvio"));
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
    public function show(opciones_envio $opciones_envio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(opciones_envio $opciones_envio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, opciones_envio $opciones_envio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(opciones_envio $opciones_envio)
    {
        //
    }
}
