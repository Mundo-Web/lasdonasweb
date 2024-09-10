<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CuponController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HorariosController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MereyRest;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PrecioEnvioController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SaleDetailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/items/{type}', [ProductsController::class, 'search']);
Route::post('/products/paginate', [ProductsController::class, 'paginate'])->name('products.paginate');

Route::post('/products/AddOrder', [ProductsController::class, 'AddOrder'])->name('products.AddOrder');
Route::post('/products/addComplemento', [ProductsController::class, 'addComplemento'])->name('products.addComplemento');

Route::middleware('web')->post('/payment/culqi', [PaymentController::class, 'culqi'])->name('payment.culqi');
Route::post('/consultar-localidad', [PrecioEnvioController::class, 'searchzip'])->name('payment.searchzip');
Route::post('/actualizar-perfil', [IndexController::class, 'actualizarPerfil'] );

Route::post('/horarios/updateVisible', [HorariosController::class, 'updateVisible']);
Route::post('/horarios/destroy', [HorariosController::class, 'destroy']);
Route::post('/horarios/save', [HorariosController::class, 'store']);
Route::get('/horarios/{id}', [HorariosController::class, 'edit']);


Route::post('signup', [AuthController::class, 'signup']);

Route::middleware(['web'])->post('/people/search', [MereyRest::class, 'get']);

Route::middleware(['web', 'auth:sanctum', 'verified'])->group(function () {

    Route::get('/dashboard/top-products/{orderBy}', [DashboardController::class, 'topProducts'])->name('dashboard.top-products');

    Route::get('/direccion', [IndexController::class, 'direccion'])->name('address.all');

    Route::post('/address', [AddressController::class, 'save'])->name('address.save');
    Route::delete('/address/{id}', [AddressController::class, 'delete'])->name('address.delete');
    Route::patch('/address/markasfavorite', [AddressController::class, 'markasfavorite'])->name('address.markasfavorite');

    Route::post('/sales/paginate', [SaleController::class, 'paginate'])->name('sales.paginate');
    Route::post('/sales/confirmation', [SaleController::class, 'confirmation'])->name('sales.confirmation');
    Route::patch('/sales/status', [SaleController::class, 'status'])->name('sales.status');
    Route::get('/saledetails/{sale}', [SaleDetailController::class, 'bySale'])->name('sale.bySale');

    Route::post('/reminders', [ReminderController::class, 'create']);
    Route::put('/reminders/{id}', [ReminderController::class, 'update']);

    Route::post('/eliminarCuenta', [IndexController::class, 'eliminarCuenta'] );

    Route::post('/cupon', [CuponController::class, 'addHistorico'] );
   
   
   

   /*  Route::get('/offers', [OfferController::class, 'all'])->name('offers.all');
    Route::patch('/offers', [OfferController::class, 'save'])->name('offers.save');
    Route::delete('/offers/{offer_id}', [OfferController::class, 'delete'])->name('offers.delete'); */
});