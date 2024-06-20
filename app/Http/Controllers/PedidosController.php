<?php

namespace App\Http\Controllers;

use App\Models\AddressUser;
use App\Models\DetalleOrden;
use App\Models\Ordenes;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidosController extends Controller
{
    public function listadoPedidos()
    {
        
        $orders = Ordenes::with('usuarioPedido')->with('statusOrdenes')->get();
        
        return view('pages.orders.index', compact('orders'));  
    }


    public function verPedido($id)
    {
        $orders = Ordenes::where('id',  $id)->with('usuarioPedido')->with('statusOrdenes')->with('DetalleOrden')->first();
        
        $direccion = AddressUser::where('id', '=', $orders->address_id)->first();

        $subtotal = 0;

        foreach ($orders->DetalleOrden as $item) {
            $subtotal += $item->precio * $item->cantidad;
        } 

        $producto = Products::select('products.*', 'imagen_productos.name_imagen')
                        ->join('detalle_ordens' , 'products.id', '=', 'detalle_ordens.producto_id')
                        ->join('imagen_productos', 'products.id' , '=', 'imagen_productos.product_id')
                        ->where('detalle_ordens.orden_id', '=', $id)
                        ->where('imagen_productos.caratula', '=', 1)
                        ->get();
        
        return view('pages.orders.show', compact('orders','direccion','producto', 'subtotal'));

    }
}
