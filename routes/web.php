<?php

use App\Models\Empleados;
use App\Models\Incapacidades;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaltasController;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\HerramientasController;
use App\Http\Controllers\VacacionesController;
use App\Http\Controllers\IncapacidadesController;
use App\Http\Controllers\PermisosController;
use App\Http\Controllers\StockUniformesController;
use App\Http\Controllers\UniformesController;
use App\Models\Herramientas;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/dashboard', function(){
    if(Auth::check()){
        return view('dashboard');
    }else{
        return view('auth.login');
    };
})->name('dashboard');

Route::get('/', function () {
    
    if(Auth::check()){
        return view('dashboard');
    }else{
        return view('auth.login');
    };
});

// Empleados

//Route::get('/solicitudes/inicio',[SolicitudVehiculoController::class, 'dashboard'])->name('siveInicio.show');

Route::get('/gestion/mostrarEmpleados',[EmpleadosController::class, 'show'])->name('mostrarEmpleado.show');
Route::get('/gestion/altaEmpleados',[EmpleadosController::class, 'create'])->name('crearEmpleado.create');
Route::post('/gestion/guardarEmpleados',[EmpleadosController::class, 'store'])->name('crearEmpleado.store');
Route::get('/gestion/detallesEmpleados/{id}',[EmpleadosController::class, 'detalles'])->name('detallesEmpleado.show');

Route::get('/gestion/mostrarVacaciones',[VacacionesController::class, 'show'])->name('mostrarVacaciones.show');
Route::get('/gestion/registrarVacaciones',[VacacionesController::class, 'create'])->name('crearVacacion.create');
Route::post('/gestion/guardarVacaciones',[VacacionesController::class, 'store'])->name('crearVacacion.store');
Route::get('/gestion/registrarVacaciones/buscar',[VacacionesController::class, 'search'])->name('crearVacacion.search');

Route::get('/gestion/mostrarFaltas',[FaltasController::class, 'show'])->name('mostrarFaltas.show');
Route::get('/gestion/registrarFaltas',[FaltasController::class, 'create'])->name('crearFaltas.create');
Route::post('/gestion/guardarFaltas',[FaltasController::class, 'store'])->name('crearFaltas.store');
Route::get('/gestion/registrarFaltas/buscar',[FaltasController::class, 'search'])->name('crearFaltas.search');

Route::get('/gestion/mostrarIncapacidades',[IncapacidadesController::class, 'show'])->name('mostrarIncapacidades.show');
Route::get('/gestion/registrarIncapacidades',[IncapacidadesController::class, 'create'])->name('crearIncapacidad.create');
Route::post('/gestion/guardarIncapacidades',[IncapacidadesController::class, 'store'])->name('crearIncapacidad.store');
Route::get('/gestion/registrarIncapacidades/buscar',[IncapacidadesController::class, 'search'])->name('crearIncapacidad.search');

Route::get('/gestion/mostrarPermisos',[PermisosController::class, 'show'])->name('mostrarPermisos.show');
Route::get('/gestion/registrarPermisos',[PermisosController::class, 'create'])->name('crearPermisos.create');
Route::post('/gestion/guardarPermisos',[PermisosController::class, 'store'])->name('crearPermisos.store');
Route::get('/gestion/registrarPermisos/buscar',[PermisosController::class, 'search'])->name('crearPermisos.search');

Route::get('/almacen/mostrarUniformes',[UniformesController::class, 'show'])->name('mostrarUniformes.show');
Route::get('/almacen/registrarUniformes',[UniformesController::class, 'create'])->name('crearUniformes.create');
Route::post('/almacen/guardarUniformes',[UniformesController::class, 'store'])->name('crearUniformes.store');
Route::get('/almacen/registrarUniformes/buscar',[UniformesController::class, 'search'])->name('crearUniformes.search');
Route::get('/almacen/registrarUniformes/buscar/opciones',[UniformesController::class, 'search_talla'])->name('crearUniformes.search_talla');
Route::get('/almacen/registrarUniformes/buscar/codigo',[UniformesController::class, 'search_codigo'])->name('crearUniformes.search_codigo');
Route::get('/almacen/registrarUniformes/buscar/cantidad',[UniformesController::class, 'search_cantidad'])->name('crearUniformes.search_cantidad');
Route::get('/almacen/registrarUniformes/buscar/total',[UniformesController::class, 'search_total'])->name('crearUniformes.search_total');

Route::get('/almacen/mostrar/stockUniformes',[StockUniformesController::class, 'show'])->name('mostrarStock.show');
Route::get('/almacen/stockUniformes',[StockUniformesController::class, 'create'])->name('crearStockUniformes.create');
Route::post('/almacen/guardarStockUniformes',[StockUniformesController::class, 'store'])->name('crearStockUniformes.store');

Route::get('/almacen/mostrarHerramientas',[HerramientasController::class, 'show'])->name('mostrarHerramientas.show');
Route::get('/almacen/registrarHerramientas',[HerramientasController::class, 'create'])->name('crearHerramientas.create');
Route::post('/almacen/guardarHerramientas',[HerramientasController::class, 'store'])->name('crearHerramientas.store');
Route::get('/almacen/registrarHerramientas/buscar',[HerramientasController::class, 'search'])->name('crearHerramientas.search');
