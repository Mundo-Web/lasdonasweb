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
    return view('pages.cupones.create', compact('clientes', 'cupon'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'codigo' => 'required|unique:cupons',
      'fecha_caducidad' => 'required',
      'monto' => 'required',
    ]);
    $data = $request->all();
    $data['codigo'] = strtoupper($data['codigo']);
    $data['porcentaje'] = $request->has('porcentaje') ? true : false;




    Cupon::create($data);
    return redirect()->route('cupones.index');
  }

  public function edit(Cupon $cupon, string $id)
  {
    $clientes = User::all();

    $cupon = Cupon::find($id);
    return view('pages.cupones.edit', compact('cupon', 'clientes'));
  }

  public function update(Request $request, string $id, Cupon $cupon)
  {
    $request->validate([
      'codigo' => 'required',
      'fecha_caducidad' => 'required',
      'monto' => 'required',
    ]);

    $cupon  = Cupon::find($id);
    $data = $request->all();
    $data['codigo'] = strtoupper($data['codigo']);
    $data['porcentaje'] = $request->has('porcentaje') ? true : false;

    $cupon->update($data);
    return redirect()->route('cupones.index');
  }

  public function destroy(Cupon $cupon, $id)
  {
    try {
      DB::table('historico_cupones')->where('cupones_id', $id)->delete();
      Cupon::destroy($id);
    } catch (\Throwable $th) {
      //throw $th;


    }


    return redirect()->route('cupones.index');
  }

  public function deletecupon($id)
  {
    try {
      DB::table('historico_cupones')->where('id', $id)->delete();
      // Cupon::destroy($id);
    } catch (\Throwable $th) {
      //throw $th;
    }
  }

  public function addHistorico(Request $request)
  {


    // buscamos el usuario logueado 
    $usuario = null;
    if (Auth::check()) {
      
      $usuario = Auth::user()->id;
    }

    try {
      //code...
      $user = User::find(Auth::user())->toArray();



      //consultamos en el historico de cupones si la persona tiene un cupon sin usar 
      $cupon = HistoricoCupon::where('user_id', $usuario)->where('usado', false)->first();


      if (isset($cupon)) {
        // si tiene un cupon sin usar , no se le asigna otro cupon y se actualiza el id del cupon en el historico de cupones
        $cupon->update(['cupones_id' => $request->id]);
      } else {
        // si no tiene un cupon sin usar , se le asigna un cupon con id del cupon en el historico de cupones
        $cupon = HistoricoCupon::create([
          'cupones_id' => $request->id,
          'user_id' => $usuario,

          'usado' => false,

        ]);
      }
      $cupon = HistoricoCupon::with('cupon')->where('user_id', $usuario)->where('usado', false)->first();
      return response()->json(['message' => 'Cupon asignado.', 'cupon' => $cupon], 200);
    } catch (\Throwable $th) {
      //throw $th;


    }
  }

  public function validar(Request $request)
  {

    $valido = true;
    $hoyFecha = date('Y-m-d');
    
    try {
      //code...
      $cupon = Cupon::where('codigo', '=', $request->cupon)->where('status', 1)->where('fecha_caducidad', '>', $hoyFecha)->firstOrFail();

      $Usoesecupon =  HistoricoCupon::where('cupones_id', $cupon->id)->where('usado', true)->first();
      if (isset($Usoesecupon)) {
        $valido = false;
        return response()->json(['message' => 'Este cupon ya ha sido usado', 'valido' => $valido], 400);
      }
      


      return response()->json(['message' => 'Cupon validado.', 'valido' => $valido, 'cupon' => $cupon], 200);
    } catch (\Throwable $th) {
      //throw $th;
      $valido = false;
      return response()->json(['message' => 'El cupón ingresado no es válido.', 'valido' => $valido], 400);
    }
  }

  public function updateVisible(Request $request)
  {
    // Lógica para manejar la solicitud AJAX
    //return response()->json(['mensaje' => 'Solicitud AJAX manejada con éxito']);
    $id = $request->id;

    $field = $request->field;

    $status = $request->status;

    $testimony = Cupon::findOrFail($id);

    $testimony->$field = $status;

    $testimony->save();

    return response()->json(['message' => 'Estado modificado.']);
  }
}
