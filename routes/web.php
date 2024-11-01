<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DetallePedidoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\SaborController;
use App\Models\DetallePedido;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Sabores
Route::get('/sabores', [SaborController::class, 'index'])->middleware('auth')->name('sabores.index');
Route::get('/sabores/crear', [SaborController::class, 'create'])->middleware('auth')->name('sabores.create');
Route::post('/sabores/crear/store', [SaborController::class, 'store'])->middleware('auth')->name('sabores.store');
Route::get('/sabores/{sabor}/editar', [SaborController::class, 'edit'])->middleware('auth')->name('sabores.edit');
Route::put('/sabores/{sabor}/update', [SaborController::class, 'update'])->middleware('auth')->name('sabores.update');
Route::delete('/sabores/{id}/eliminar', [SaborController::class, 'destroy'])->middleware('auth')->name('sabores.destroy');

// Clientes
Route::get('/clientes', [ClienteController::class, 'index'])->middleware('auth')->name('clientes.index');
Route::get('/clientes/crear', [ClienteController::class, 'create'])->middleware('auth')->name('clientes.create');
Route::post('/clientes/crear/store', [ClienteController::class, 'store'])->middleware('auth')->name('clientes.store');
Route::get('/clientes/{cliente}/editar', [ClienteController::class, 'edit'])->middleware('auth')->name('clientes.edit');
Route::put('/clientes/{cliente}/update', [ClienteController::class, 'update'])->middleware('auth')->name('clientes.update');
Route::delete('/clientes/{id}/eliminar', [ClienteController::class, 'destroy'])->middleware('auth')->name('clientes.destroy');

// Pedidos
Route::get('/pedidos', [PedidoController::class,'index'])->middleware('auth')->name('pedidos.index');
Route::get('/pedidos/crear', [PedidoController::class, 'create'])->middleware('auth')->name('pedidos.create');
Route::get('/pedidos/{pedido}/ver', [PedidoController::class, 'view'])->middleware('auth')->name('pedidos.view');

// Detalle pedidos
Route::get('/pedidos/crear', [DetallePedidoController::class, 'index'])->middleware('auth')->name('DetallePedidos.index');
Route::post('/pedidos/add', [DetallePedidoController::class, 'agregarItem'])->middleware('auth')->name('agregarItem.index');
Route::post('/pedidos/{rowId}/delete', [DetallePedidoController::class, 'eliminarItem'])->middleware('auth')->name('eliminarItem');
Route::post('/pedidos/finalizar-pedido', [DetallePedidoController::class, 'finalizarPedido'])->middleware('auth')->name('finalizarPedido');