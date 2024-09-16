<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BasicController;
use App\Models\Ordenes;
use App\Models\Status;
use Illuminate\Http\Request;

class OrdenController extends BasicController
{
    public $model = Ordenes::class;
    public $recatView = 'Admin/Sales';
    public $prefix4filter = 'ordenes';

    public function setReactViewProperties(Request $request)
    {
        $statuses = Status::where('status', true)->get();
        return [
            'statuses' => $statuses
        ];
    }

    public function setPaginationInstance(string $model)
    {
        return $model::select([
            'ordenes.*'

        ])
            ->with([
                'horarioEnvio',
                'usuarioPedido',
                'statusOrdenes',
                'DetalleOrden',
                'DetalleOrden.producto',
                'DetalleOrden.imagenProducto',
            ])
            ->join('statuses AS status_ordenes', 'status_ordenes.id', 'ordenes.status_id');
    }
}
