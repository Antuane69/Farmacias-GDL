<?php

use App\Models\Faltas;
use App\Models\Empleados;
use App\Models\Herramientas;
use App\Models\Incapacidades;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BajasController;
use App\Http\Controllers\FaltasController;
use App\Http\Controllers\NominaController;
use App\Http\Controllers\HorariosController;
use App\Http\Controllers\PermisosController;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\UniformesController;
use App\Http\Controllers\VacacionesController;
use App\Http\Controllers\HerramientasController;
use App\Http\Controllers\IncapacidadesController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SoporteController;
use App\Http\Controllers\StockUniformesController;
use App\Http\Controllers\SubTaskController;
use App\Http\Controllers\TaskController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
Route::get('/dashboard',[DashboardController::class, 'inicio'])->name('dashboard');
Route::get('/',[DashboardController::class, 'inicio'])->name('login_2');
Route::get('/register',[DashboardController::class, 'register'])->name('register');
Route::post('/register/guardar',[DashboardController::class, 'register_save'])->name('register.guardar');

Route::get('/task/create',[TaskController::class, 'create'])->name('create.task');
Route::post('/task/save/{id?}',[TaskController::class, 'save'])->name('save.task');
Route::get('/task/show',[TaskController::class, 'show'])->name('show.task');
Route::get('/task/edit/{id}',[TaskController::class, 'edit'])->name('edit.task');
Route::delete('/task/delete',[TaskController::class, 'delete'])->name('delete.task');
Route::post('/task/complete/{id}',[TaskController::class, 'update'])->name('complete.task');

Route::get('/subtask/create',[SubTaskController::class, 'create'])->name('create.subtask');
Route::post('/subtask/save/{id?}',[SubTaskController::class, 'save'])->name('save.subtask');
Route::get('/subtask/show',[SubTaskController::class, 'show'])->name('show.subtask');
Route::get('/subtask/edit/{id}',[SubTaskController::class, 'edit'])->name('edit.subtask');
Route::delete('/subtask/delete',[SubTaskController::class, 'delete'])->name('delete.subtask');
Route::post('/subtask/complete/{id}',[SubTaskController::class, 'update'])->name('complete.subtask');



Route::middleware(['auth.redirect'])->group( function () {

    // Gestion
    Route::get('/gestion/mostrarEmpleados',[EmpleadosController::class, 'show'])->name('mostrarEmpleado.show');
    Route::get('/gestion/altaEmpleados',[EmpleadosController::class, 'create'])->name('crearEmpleado.create');
    Route::post('/gestion/guardarEmpleados',[EmpleadosController::class, 'store'])->name('crearEmpleado.store');
    Route::get('/gestion/detallesEmpleados/{id}',[EmpleadosController::class, 'detalles'])->name('detallesEmpleado.show');
    Route::get('/gestion/editarEmpleados/{id}',[EmpleadosController::class, 'edit_show'])->name('editarEmpleado.show');
    Route::post('/gestion/editarEmpleadosVista/{id}',[EmpleadosController::class, 'edit_store'])->name('editarEmpleado.store');
    
    Route::get('/gestion/altaBajasExtra/vista',[BajasController::class, 'createExtraVista'])->name('crearBajas.extraVista');
    Route::post('/gestion/altaBajasExtra',[BajasController::class, 'createExtraStore'])->name('crearBajas.extraStore');
    Route::get('/gestion/altaBajas/{id}',[BajasController::class, 'create'])->name('crearBajas.create');
    Route::post('/gestion/guardarBajas/{id}',[BajasController::class, 'store'])->name('crearBajas.store');
    Route::get('/gestion/mostrarBajas',[BajasController::class, 'show'])->name('mostrarBajas.show');
    Route::get('/gestion/detallesBajas/{id}',[BajasController::class, 'detalles'])->name('detallesBajas.show');
    Route::get('/gestion/restaurarEmpleado/{id}', [BajasController::class, 'restaurar'])->name('restaurarEmpleado');
    Route::get('/gestion/editarBajasVista/{id}',[BajasController::class, 'edit_show'])->name('editarBaja.show');
    Route::post('/gestion/editarBajas/{id}',[BajasController::class, 'edit_store'])->name('editarBaja.store');
    Route::get('/gestion/bajas/antiguedad/{baja}/{ingreso}',[BajasController::class, 'antiguedad'])->name('antiguedad');

    Route::get('/gestion/mostrarVacaciones/Pendientes',[VacacionesController::class, 'show_pendientes'])->name('vacacionesPendientes.show');
    Route::post('/gestion/aceptarVacaciones/{id}',[VacacionesController::class, 'accept'])->name('aceptarVacacion.accept');
    Route::post('/gestion/rechazarVacaciones/{id}',[VacacionesController::class, 'reject'])->name('rechazarVacacion.reject');

    Route::get('/gestion/mostrarFaltas',[FaltasController::class, 'show'])->name('mostrarFaltas.show');
    Route::get('/gestion/registrarFaltas',[FaltasController::class, 'create'])->name('crearFaltas.create');
    Route::post('/gestion/guardarFaltas',[FaltasController::class, 'store'])->name('crearFaltas.store');
    Route::get('/gestion/registrarFaltas/buscar',[FaltasController::class, 'search'])->name('crearFaltas.search');
    Route::get('/gestion/editarFaltas/{id}',[FaltasController::class, 'edit_show'])->name('editarFaltas.show');
    Route::post('/gestion/editarFaltasVista/{id}',[FaltasController::class, 'edit_store'])->name('editarFaltas.store');
    Route::delete('/gestion/eliminarFaltas/{id}', [FaltasController::class, 'eliminar'])->name('eliminarFaltas');
    Route::get('/gestion/registrarFaltas/buscar/faltas',[FaltasController::class, 'buscarFaltas'])->name('crearFaltas.search_faltas');
    
    Route::get('/gestion/mostrarIncapacidades',[IncapacidadesController::class, 'show'])->name('mostrarIncapacidades.show');
    Route::get('/gestion/registrarIncapacidades',[IncapacidadesController::class, 'create'])->name('crearIncapacidad.create');
    Route::post('/gestion/guardarIncapacidades',[IncapacidadesController::class, 'store'])->name('crearIncapacidad.store');
    Route::get('/gestion/registrarIncapacidades/buscar',[IncapacidadesController::class, 'search'])->name('crearIncapacidad.search');
    Route::get('/gestion/editarIncapacidades/{id}',[IncapacidadesController::class, 'edit_show'])->name('editarIncapacidad.show');
    Route::post('/gestion/editarIncapacidadesVista/{id}',[IncapacidadesController::class, 'edit_store'])->name('editarIncapacidad.store');
    Route::delete('/gestion/eliminarIncapacidades/{id}', [IncapacidadesController::class, 'eliminar'])->name('eliminarIncapacidad');
    
    Route::get('/gestion/mostrarPermisos/Pendientes',[PermisosController::class, 'show_pendientes'])->name('permisosPendientes.show');
    Route::post('/gestion/aceptarPermisos/{id}',[PermisosController::class, 'accept'])->name('aceptarPermiso.accept');
    Route::post('/gestion/rechazarPermisos/{id}',[PermisosController::class, 'reject'])->name('rechazarPermiso.reject');

    // Almacen
    Route::get('/almacen/inicio',[UniformesController::class, 'dashboard'])->name('almacenInicio.show');
    Route::get('/almacen/mostrarUniformes',[UniformesController::class, 'show'])->name('mostrarUniformes.show');
    Route::get('/almacen/registrarUniformes',[UniformesController::class, 'create'])->name('crearUniformes.create');
    Route::post('/almacen/guardarUniformes',[UniformesController::class, 'store'])->name('crearUniformes.store');
    Route::get('/almacen/registrarUniformes/buscar',[UniformesController::class, 'search'])->name('crearUniformes.search');
    Route::get('/almacen/registrarUniformes/buscar/opciones',[UniformesController::class, 'search_talla'])->name('crearUniformes.search_talla');
    Route::get('/almacen/registrarUniformes/buscar/codigo',[UniformesController::class, 'search_codigo'])->name('crearUniformes.search_codigo');
    Route::get('/almacen/registrarUniformes/buscar/cantidad',[UniformesController::class, 'search_cantidad'])->name('crearUniformes.search_cantidad');
    Route::get('/almacen/registrarUniformes/buscar/total',[UniformesController::class, 'search_total'])->name('crearUniformes.search_total');
    Route::get('/almacen/editarUniformes/{id}',[UniformesController::class, 'edit_show'])->name('editarUniformes.show');
    Route::post('/almacen/editarUniformesVista/{id}',[UniformesController::class, 'edit_store'])->name('editarUniformes.store');
    Route::delete('/almacen/eliminarUniformes/{id}', [UniformesController::class, 'eliminar'])->name('eliminarUniformes');
    
    Route::get('/almacen/mostrar/stockUniformes',[StockUniformesController::class, 'show'])->name('mostrarStock.show');
    Route::get('/almacen/stockUniformes',[StockUniformesController::class, 'create'])->name('crearStockUniformes.create');
    Route::post('/almacen/guardarStockUniformes',[StockUniformesController::class, 'store'])->name('crearStockUniformes.store');
    Route::get('/almacen/editarStockUniformes/{id}',[StockUniformesController::class, 'edit_show'])->name('editarStockUniformes.show');
    Route::post('/almacen/editarStockUniformesVista/{id}',[StockUniformesController::class, 'edit_store'])->name('editarStockUniformes.store');
    Route::delete('/almacen/eliminarStockUniformes/{id}', [StockUniformesController::class, 'eliminar'])->name('eliminarStockUniformes');
    
    Route::get('/almacen/mostrarHerramientas',[HerramientasController::class, 'show'])->name('mostrarHerramientas.show');
    Route::get('/almacen/registrarHerramientas',[HerramientasController::class, 'create'])->name('crearHerramientas.create');
    Route::post('/almacen/guardarHerramientas',[HerramientasController::class, 'store'])->name('crearHerramientas.store');
    Route::get('/almacen/registrarHerramientas/buscar',[HerramientasController::class, 'search'])->name('crearHerramientas.search');
    Route::delete('/almacen/eliminarHerramientas/{id}', [HerramientasController::class, 'eliminar'])->name('eliminarHerramientas');
    Route::get('/almacen/editarHerramientasVista/{id}',[HerramientasController::class, 'edit_show'])->name('editarHerramientas.show');
    Route::post('/almacen/editarHerramientas/{id}',[HerramientasController::class, 'edit_store'])->name('editarHerramientas.store');

    //PDF
    Route::get('/almacen/uniformes/pdf/{id}', [UniformesController::class,'generate_pdf'])->name('uniformes.generarpdf');//*
    Route::post('/almacen/subirUniformes/pdf/{id}', [UniformesController::class,'subir_pdf'])->name('uniformes.subirpdf');//*
    Route::get('/almacen/verUniformes/pdf/{id}', [UniformesController::class,'ver_pdf'])->name('uniformes.verpdf');//*
    Route::get('/almacen/mostrarUniformes/pdf', [UniformesController::class,'mostrar_pdf'])->name('uniformes.mostrarpdf');//*
    Route::delete('/almacen/eliminarUniformesPDF/{id}', [UniformesController::class, 'eliminar_pdf'])->name('eliminarUniformes.pdf');
    
    Route::get('/pdf/inicio',[HerramientasController::class, 'dashboard'])->name('pdfInicio.show');
    Route::get('/almacen/herramientas/pdf/{id}', [HerramientasController::class,'generate_pdf'])->name('herramientas.generarpdf');//*
    Route::post('/almacen/subirHerramientas/pdf/{id}', [HerramientasController::class,'subir_pdf'])->name('herramientas.subirpdf');//*
    Route::get('/almacen/verHerramientas/pdf/{id}', [HerramientasController::class,'ver_pdf'])->name('herramientas.verpdf');//*
    Route::get('/pdf/mostrarHerramientas/pdf', [HerramientasController::class,'mostrar_pdf'])->name('herramientas.mostrarpdf');//*
    Route::delete('/almacen/eliminarHerramientasPDF/{id}', [HerramientasController::class, 'eliminar_pdf'])->name('eliminarHerramientas.pdf');
    
    Route::get('/gestion/datosActa/pdf/{id}', [FaltasController::class,'crear_datosPDF'])->name('faltas.crear_datospdf');//*
    Route::post('/gestion/generarActa/pdf/{id}', [FaltasController::class,'datos_pdf'])->name('faltas.datospdf');//*
    Route::post('/gestion/subirActa/pdf/{id}', [FaltasController::class,'subir_pdf'])->name('faltas.subirpdf');//*
    Route::get('/gestion/verActa/pdf/{id}', [FaltasController::class,'ver_pdf'])->name('faltas.verpdf');//*
    Route::get('/pdf/mostrarActa/pdf', [FaltasController::class,'mostrar_pdf'])->name('faltas.mostrarpdf');//*
    Route::delete('/gestion/eliminarActa/pdf/{id}', [FaltasController::class, 'eliminar_pdf'])->name('eliminarFaltas.pdf');
    
    Route::get('/gestion/verDocumentacion/pdf/{tipo}/{id}', [EmpleadosController::class,'ver_pdf'])->name('empleados.verpdf');//*
    Route::get('/gestion/datosContrato/pdf/{id}', [EmpleadosController::class,'crear_datosPDF'])->name('empleados.crear_datospdf');//*
    Route::post('/gestion/generarContrato/pdf/{id}', [EmpleadosController::class,'datos_pdf'])->name('empleados.datospdf');//*
    Route::post('/gestion/subirContrato/pdf/{id}', [EmpleadosController::class,'subir_pdf'])->name('empleados.subirpdf');//*

    // correos
    Route::get('/correos/Vacaciones/{tipo}/{id}/{aux}',[VacacionesController::class, 'correo'])->name('vacaciones.correo');
    Route::get('/correos/Permisos/{tipo}/{id}/{aux}',[PermisosController::class, 'correo'])->name('permisos.correo');
    Route::get('/correos/Horarios/{tipo}/{id}/{aux}',[HorariosController::class, 'correo'])->name('horarios.correo');

    //Nómina
    Route::get('/nominas/subirExcel',[NominaController::class, 'csv'])->name('nomina.csv');
    Route::post('/nominas/subirExcel/guardado',[NominaController::class, 'store_csv'])->name('nomina.storecsv');
    Route::get('/nominas/historico',[NominaController::class, 'historico'])->name('nomina.historico');
    Route::get('/nominas/ver',[NominaController::class, 'show'])->name('nomina.mostrar');
    Route::post('/nominas/guardar',[NominaController::class, 'store'])->name('nomina.store');
    Route::get('/nomina/generarNomina/pdf/{id}', [NominaController::class,'datos_pdf'])->name('nomina.datospdf');//*
    Route::get('/nomina/editarNominaVista/{id}',[NominaController::class, 'edit_show'])->name('editarNomina.show');
    Route::post('/nomina/editarNomina/{id}',[NominaController::class, 'edit_store'])->name('editarNomina.store');
    Route::get('/nomina/buscar/total',[NominaController::class, 'search_total'])->name('nomina.search_total');
    
    //Nómina de Número de Trabajador
    Route::get('/nomina/numerotrabajador',[NominaController::class, 'show_numtrab'])->name('nomina.numerotrabajador');
    Route::delete('/nomina/numerotrabajador/eliminar/{id}',[NominaController::class, 'delete_numtrab'])->name('nomina.numerotrabajador.delete');
    Route::post('/nomina/numerotrabajador/edit/guardar/{id}',[NominaController::class, 'editshow_numtrab'])->name('nomina.numerotrabajador.editshow');
    Route::post('/nomina/numerotrabajador/crear/guardar',[NominaController::class, 'store_numtrab'])->name('nomina.numerotrabajador.store');
    Route::get('/nomina/buscar/numeroTrabajadores',[NominaController::class, 'search_numtrab'])->name('nomina.search_numtrab');
    
    Route::get('/soporte/crear', [SoporteController::class,'create'])->name('soporte.crear');
    Route::post('/soporte/guardar/{id?}', [SoporteController::class,'store'])->name('soporte.guardar');
    Route::get('/soporte/mostrar', [SoporteController::class,'show'])->name('soporte.mostrar');
    Route::get('/soporte/descargar/{id}', [SoporteController::class,'download'])->name('soporte.descargar');
    
    Route::get('/soporte/editar/{id}', [SoporteController::class,'edit'])->name('soporte.editar');
    //Route::post('/soporte/editar/guardar', [SoporteController::class,'edit_store'])->name('soporte.editarGuardar');
    Route::delete('/soporte/eliminar/{id}', [SoporteController::class,'delete'])->name('soporte.eliminar');

    Route::get('/roles', [EmpleadosController::class,'roles'])->name('roles');
});

Route::middleware(['users.redirect'])->group( function () {

    Route::get('/gestion/empleados/inicio',[EmpleadosController::class, 'dashboard'])->name('empleadosInicio.show');
    Route::get('/gestion/detallesEmpleados/navigation/{curp}',[EmpleadosController::class, 'detalles_navigation'])->name('detallesEmpleado.nav');

    Route::get('/gestion/mostrarVacaciones',[VacacionesController::class, 'show'])->name('mostrarVacaciones.show');
    Route::get('/gestion/registrarVacaciones',[VacacionesController::class, 'create'])->name('crearVacacion.create');
    Route::post('/gestion/guardarVacaciones',[VacacionesController::class, 'store'])->name('crearVacacion.store');
    Route::get('/gestion/registrarVacaciones/buscar',[VacacionesController::class, 'search'])->name('crearVacacion.search');
    Route::get('/gestion/editarVacaciones/{id}',[VacacionesController::class, 'edit_show'])->name('editarVacacion.show');
    Route::post('/gestion/editarVacacionesVista/{id}',[VacacionesController::class, 'edit_store'])->name('editarVacacion.store');
    Route::delete('/gestion/eliminarVacaciones/{id}', [VacacionesController::class, 'eliminar'])->name('eliminarVacacion');
    Route::get('/gestion/vacacionesCheck',[VacacionesController::class, 'vacacionesCheck'])->name('vacacion.check');

    Route::get('/gestion/mostrarPermisos',[PermisosController::class, 'show'])->name('mostrarPermisos.show');
    Route::get('/gestion/registrarPermisos',[PermisosController::class, 'create'])->name('crearPermisos.create');
    Route::post('/gestion/guardarPermisos',[PermisosController::class, 'store'])->name('crearPermisos.store');
    Route::get('/gestion/registrarPermisos/buscar',[PermisosController::class, 'search'])->name('crearPermisos.search');
    Route::get('/gestion/editarPermisos/{id}',[PermisosController::class, 'edit_show'])->name('editarPermiso.show');
    Route::post('/gestion/editarPermisosVista/{id}',[PermisosController::class, 'edit_store'])->name('editarPermiso.store');
    Route::delete('/gestion/eliminarPermisos/{id}', [PermisosController::class, 'eliminar'])->name('eliminarPermiso');

    Route::get('/horario/verHorario', [HorariosController::class,'show'])->name('horario.mostrar');
    Route::post('/horario/crearHorario/guardar/{area}', [HorariosController::class,'store'])->name('horario.store');
    Route::get('/horario/crearTemplate/{tipo}', [HorariosController::class,'createTemplate'])->name('template.crear');
    Route::get('/horario/llenarTemplate/{tipo}', [HorariosController::class,'storeTemplate'])->name('template.store');
    Route::post('/horario/filtroHorarios', [HorariosController::class,'filtro'])->name('horario.filtro');

    Route::post('/horario/vacacionStore/{area}', [HorariosController::class,'store_vacaciones'])->name('horario.vacacionStore');
    

    Route::get('/cambiarContraseña', [ChangePasswordController::class,'cambiar_contraseña'])->name('cambiar_contraseña');
    Route::post('/guardarContraseña', [ChangePasswordController::class,'guardar_contraseña'])->name('guardar_contraseña');
    Route::post('/foto_perfil', [DashboardController::class,'foto_perfil'])->name('foto_perfil');
    
    Route::get('/editarHistorico', [DashboardController::class,'editar_historico'])->name('editar_historico');
    Route::post('/editarHistorico/filtro', [DashboardController::class,'filtro'])->name('editar_historico.filtro');

});
