<?php

namespace App\Http\Controllers;

use App\Models\TipoFlor;
use Illuminate\Http\Request;

class TipoFlorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $tipos = TipoFlor::where('status', 1)->get();
        return view('pages.tiposFlor.index', compact('tipos'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $tipos  =  new TipoFlor();
        return view('pages.tiposFlor.save', compact('tipos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function save(Request $request)
    {
        //
        $body = $request->all();
        unset($body['_token']);
        $tipoFlor = TipoFlor::find($request->id);
        if (!$tipoFlor) {
            $tipoFlor = TipoFlor::create($body);
        } else {
            $tipoFlor->update($body);
        }
        return redirect()->route('tipo-flor.index')->with('success', 'Mensaje guardado');
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoFlor $tipoFlor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TipoFlor $tipoFlor)
    {
        //
        $tipos = $tipoFlor;
        return view('pages.tiposFlor.save', compact('tipos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TipoFlor $tipoFlor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoFlor $tipoFlor)
    {
        //
    }
    public function borrar(Request $request ) {
        $tipoFlor = TipoFlor::where('id', $request->id)->first();
        if ($tipoFlor) {
            $tipoFlor->update(['status' => 0]);
        }

        return response()->json(['success' => 'Tipo de flor eliminado']);
    }
}
