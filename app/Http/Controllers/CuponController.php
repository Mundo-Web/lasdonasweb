<?php

namespace App\Http\Controllers;

use App\Models\Cupon;
use App\Models\HistoricoCupon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $cupon = new Cupon();
        return view('pages.cupones.create', compact('clientes' , 'cupon'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|unique:cupons',
            'fecha_caducidad' => 'required',
            'monto' => 'required',
        ]);
        $data= $request->all();
        $data['codigo'] = strtoupper($data['codigo']);
        $data['porcentaje'] = $request->has('porcentaje') ? true : false;
        



        Cupon::create($data);
        return redirect()->route('cupones.index');
    }

    public function edit(Cupon $cupon, string $id)
    {
        $clientes = User::all();

        $cupon= Cupon::find($id);
        return view('pages.cupones.edit', compact('cupon', 'clientes'));
    }

    public function update(Request $request,string $id, Cupon $cupon)
    {
        $request->validate([
            'codigo' => 'required',
            'fecha_caducidad' => 'required',
            'monto' => 'required',
        ]);

        $cupon  = Cupon::find($id);
        $data= $request->all();
        $data['codigo'] = strtoupper($data['codigo']);
        $data['porcentaje'] = $request->has('porcentaje') ? true : false;

        $cupon->update($data);
        return redirect()->route('cupones.index');
    }

    public function destroy(Cupon $cupon , $id)
    {
        try {
            DB::table('historico_cupones')->where('cupones_id', $id)->delete();
            Cupon::destroy($id);
            
        } catch (\Throwable $th) {
            //throw $th;
            
            
        }
        

        return redirect()->route('cupones.index');
    }

    public function addHistorico(Request $request ){

        
        // buscamos el usuario logueado 
        try {
            //code...
            $user = User::find( Auth::user())->toArray();
        

            //consultamos en el historico de cupones si la persona tiene un cupon sin usar 
            $cupon = HistoricoCupon::where('user_id', $user[0]['id'])->where('usado', false)->first();
            

            if(isset($cupon)){
                // si tiene un cupon sin usar , no se le asigna otro cupon y se actualiza el id del cupon en el historico de cupones
                $cupon->update(['cupones_id' => $request->id]);
            }else{
                // si no tiene un cupon sin usar , se le asigna un cupon con id del cupon en el historico de cupones
                HistoricoCupon::create([
                    'cupones_id' => $request->id,
                    'user_id' => $user[0]['id'],
                    
                    'usado' => false,
                    
                ]);
            }
    
            
    
    
        } catch (\Throwable $th) {
            //throw $th;

            
        }
       
    }
}
