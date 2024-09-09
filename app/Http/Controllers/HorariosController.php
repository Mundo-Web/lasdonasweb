<?php

namespace App\Http\Controllers;

use App\Models\Horarios;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HorariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $url_env = env('APP_URL');
        $horarios = Horarios::all();

        return view('pages.horarios.index', compact('horarios'));
       /*  return Inertia::render('Horarios', [
            'horarios' => $horarios,
            'url_env' => $url_env,

        ])->rootView('admin'); */
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $horarios = new Horarios();
        return view('pages.horarios.save', compact('horarios'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function save(Request $request)
    {
        //

        if ($request->id) {
            $horario = Horarios::find($request->id);
            $horario->update($request->all());
            // return response()->json(['message' => 'Horario Actualizado ']);
            return redirect()->route('horarios.index');
        } else {

            $horario = new Horarios();
            $data = $request->all();
            $data['visible'] = 1;
            $horario->fill($data);
            $horario->save();
            // return response()->json(['message' => 'Horario creado', 'horario' => $horario]);
            return redirect()->route('horarios.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Horarios $horarios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Horarios $horarios,$id)
    {
        //
        $horarios = Horarios::find($id);
        // return response()->json(['horario' => $horarios]);
        return view('pages.horarios.save', compact('horarios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Horarios $horarios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Horarios $horarios, Request $request)
    {
        //
        $id = $request->id;
        $horario = Horarios::find($id);
        $horario->delete();

        return response()->json(['message' => 'Horario eliminado']);
    }

    public function updateVisible(Request $request)
    {

        $id = $request->id;
        $horario = Horarios::find($id);

        $horario->visible = $horario->visible == 1 ? 0 : 1;
        $horario->save();



        return response()->json(['message' => 'Horario actualizado']);
    }
}
