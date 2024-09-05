<?php

namespace App\Http\Controllers;

use App\Models\Cupon;
use App\Models\User;
use Illuminate\Http\Request;

class CuponController extends Controller
{
    //
    public function index()
    {
        $cupones = Cupon::with('cliente')->get();
        return view('pages.cupones.index', compact('cupones'));
    }

    public function create()
    {
        $clientes = User::all();
        return view('pages.cupones.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|unique:cupons',
            'cliente_id' => 'required',
        ]);
        $data= $request->all();
        $data['fecha_asignacion'] = now();

        Cupon::create($data);
        return redirect()->route('cupones.index');
    }

    public function edit(Cupon $cupon)
    {
        $clientes = User::all();
        return view('cupones.edit', compact('cupon', 'clientes'));
    }

    public function update(Request $request, Cupon $cupon)
    {
        $request->validate([
            'codigo' => 'required|unique:cupons,codigo,' . $cupon->id,
            'cliente_id' => 'required|exists:clientes,id',
        ]);

        $cupon->update($request->all());
        return redirect()->route('cupones.index');
    }

    public function destroy(Cupon $cupon , $id)
    {
        try {
            
            Cupon::destroy($id);
            
        } catch (\Throwable $th) {
            //throw $th;
            
        }
        

        return redirect()->route('cupones.index');
    }
}
