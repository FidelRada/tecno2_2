<?php

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::get('/categoria-insumo', function () {
        return view('view-formulario-categoria-insumo');
    })->name('formulario.categoria.insumos');

    Route::get('/insumo', function () {
        return view('view-formulario-insumo');
    })->name('formulario.insumos');


    Route::get('/cliente', function () {
        return view('view-formulario-cliente');
    })->name('formulario.clientes');
    
    Route::get('/empleado', function () {
        return view('view-formulario-empleado');
    })->name('formulario.empleados');

    Route::get('/proveedor', function () {
        return view('view-formulario-proveedor');
    })->name('formulario.proveedores');

    Route::get('/rol', function () {
        return view('view-formulario-rol');
    })->name('formulario.roles');

    Route::get('/ingreso', function () {
        return view('view-formulario-ingreso');
    })->name('formulario.ingresos');

    Route::get('/egreso', function () {
        return view('view-formulario-egreso');
    })->name('formulario.egresos');

    Route::get('/servicio', function () {
        return view('view-formulario-servicio');
    })->name('formulario.servicios');

    Route::get('/categoria-diseño', function () {
        return view('view-formulario-categoria-diseño');
    })->name('formulario.categoria.diseño');

    Route::get('/subcategoria-diseño', function () {
        return view('view-formulario-subcategoria-diseño');
    })->name('formulario.subcategoria.diseño');

    Route::get('/plantilla-diseño', function () {
        return view('view-formulario-plantilla-diseño');
    })->name('formulario.plantilla.diseño');

    Route::get('/metodos-pago', function () {
        return view('view-formulario-metodo-pago');
    })->name('formulario.formas.pago');

    

    
});
