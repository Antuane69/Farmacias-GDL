<?php

namespace App\Http\Controllers;

use App\Models\Empleados;
use App\Models\Herramientas;
use Illuminate\Http\Request;

class HerramientasController extends Controller
{
    public function create()
    {
        $opciones = ['Cocina','Servicio','Barra','Producción'];

        return view('almacen.crearHerramienta',[
            'opciones' => $opciones
        ]);
    }

    public function show(){

        $herramientas = Herramientas::all();
        
        return view('almacen.mostrarStock',[
            'herramientas' => $herramientas
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'fecha_solicitud' => 'date',
        ]);

        Herramientas::create([
            'fecha_solicitud' => $request->fecha_solicitud,
            'nuevos_existencia' => $request->nuevos_existencia, 
            'usados_existencia' => $request->usados_existencia, 
            'nuevos_codigo' => $request->nuevos_codigo, 
            'usados_codigo' => $request->usados_codigo, 
            'nuevos_talla' => $request->nuevos_talla, 
            'usados_talla' => $request->usados_talla, 
            'nuevos_precio' => $request->nuevos_precio, 
            'usados_precio' => $request->usados_precio, 
            'nuevos_descripcion' => $request->nuevos_descripcion, 
            'usados_descripcion' => $request->usados_descripcion, 
        ]);

        return redirect()->route('mostrarStock.show');
    }

    public function detalles($id){

        $empleado = Empleados::query()->find($id);

        return view('gestion.detallesEmpleado',[
            'empleado' => $empleado,
        ]);
    }

    public function search(Request $request){

        $empleado = Empleados::where('nombre', 'LIKE' , $request->nombre . '%')->first();
    
        return response()->json([
            'success' => true,
            'empleado' => $empleado
        ]);
    }
}
