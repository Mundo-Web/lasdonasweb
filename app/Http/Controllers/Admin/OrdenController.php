<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BasicController;
use App\Models\Ordenes;

class OrdenController extends BasicController
{
    public $model = Ordenes::class;
    public $recatView = 'Admin/Sales';

    public function setPaginationInstance(string $model)
    {
        return $model::with([
            'horarioEnvio',
            'usuarioPedido',
            'statusOrdenes',
            'DetalleOrden',
            'DetalleOrden.producto',
            'DetalleOrden.imagenProducto',
        ]);
    }
}
