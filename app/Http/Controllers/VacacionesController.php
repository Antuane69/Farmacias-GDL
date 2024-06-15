<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Audit;
use App\Models\Empleados;
use App\Mail\TokyoCorreos;
use App\Models\Vacaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class VacacionesController extends Controller
{
    public function show(){
        
        if(auth()->user()->hasRole('admin')){
            $vacaciones = Vacaciones::where('estado','!=','Pendiente')->orderBy('created_at', 'desc')->with('empleado')->get();
        }else{
            $vacaciones = Vacaciones::where('curp',auth()->user()->curp)->orderBy('created_at', 'desc')->with('empleado')->get();
        }
        
        if($vacaciones){
            foreach($vacaciones as $vacacion){
                $auxf = new Carbon($vacacion->fecha_solicitud);
                $auxf2 = new Carbon($vacacion->fecha_inicioVac);
                $auxf3 = new Carbon($vacacion->fecha_regresoVac);
    
                $vacacion->solicitud = $auxf->format('d/m/Y');
                $vacacion->inicio = $auxf2->format('d/m/Y');
                $vacacion->regreso = $auxf3->format('d/m/Y');

                $nombres = $vacacion->empleados_cubren;
                $vacacion->nombre_real = substr(str_replace('_', ', ', $nombres),1);
            }
        }

        return view('gestion.mostrarVacaciones',[
            'vacaciones' => $vacaciones
        ]);
    }

    public function show_pendientes(){
        
        $vacaciones = Vacaciones::where('estado','Pendiente')->orderBy('created_at', 'desc')->with('empleado')->get();
        
        foreach($vacaciones as $vacacion){
            $auxf = new Carbon($vacacion->fecha_solicitud);
            $auxf2 = new Carbon($vacacion->fecha_inicioVac);
            $auxf3 = new Carbon($vacacion->fecha_regresoVac);

            $vacacion->solicitud = $auxf->format('d/m/Y');
            $vacacion->inicio = $auxf2->format('d/m/Y');
            $vacacion->regreso = $auxf3->format('d/m/Y');

            $nombres = $vacacion->empleados_cubren;
            $vacacion->nombre_real = substr(str_replace('_', ', ', $nombres),1);
        }

        return view('gestion.mostrarVacacionesPendientes',[
            'vacaciones' => $vacaciones
        ]);
    }

    public function create()
    {
        if(auth()->user()->hasRole('admin')){
            $nombres = Empleados::all();
        }else{
            $nombres = Empleados::where('puesto',auth()->user()->puesto)->get();
        }
        $nombres = $nombres->pluck('nombre')->toArray();

        return view('gestion.crearVacaciones',[
            'nombres' => $nombres
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nombresreg' => 'required',
            'curp' => 'required|min:18',
            'fecha_solicitud' => 'required|date',
            'fecha_inicioVac' => 'required|date',
            'fecha_regresoVac' => 'required|date|after:fecha_inicioVac',
        ]);

        $datos = $request->input('nombresreg');
        $empleado['nombre'] = "";

        foreach ($datos as $nombre) {
            $empleado['nombre'] = $empleado['nombre'] . '_' . $nombre;
        }

        Vacaciones::create([
            'curp' => $request->curp,
            'fecha_solicitud' => $request->fecha_solicitud,
            'fecha_inicioVac' => $request->fecha_inicioVac,
            'fecha_regresoVac' => $request->fecha_regresoVac,
            'dias_usados' => $request->diasTomados,
            'estado' => 'Pendiente',
            'empleados_cubren' => $empleado['nombre'],
        ]);

        $id = Vacaciones::max('id');

        return redirect()->route('vacaciones.correo', ['tipo' => 'Vacaciones', 'id' => $id, 'aux' => 'Pedir']);

    }

    public function search(Request $request){

        $empleado = Empleados::where('nombre', 'LIKE', $request->nombre . '%')->first();
    
        return response()->json([
            'success' => true,
            'empleado' => $empleado
        ]);
    }

    public function edit_show($id)
    {
        $vacacion = Vacaciones::with('empleado')->find($id);

        return view('gestion.editVacaciones',[
            'vacacion' =>$vacacion,
        ]);
    }

    public function edit_store(Request $request, $id)
    {
        $vacacion = Vacaciones::find($id);
        $originalValues = $vacacion->getOriginal();

        $empleado = Empleados::where('curp',$request->curp)->first();

        if($request->curp == $vacacion->curp){
            $empleado->dias_vacaciones = $empleado->dias_vacaciones + $vacacion->dias_usados;
            $empleado->dias_vacaciones = $empleado->dias_vacaciones - $request->diasTomados;
            $empleado->save(); 
        };

        $vacacion->curp = $request->curp;
        $vacacion->fecha_solicitud = $request->fecha_solicitud;
        $vacacion->fecha_inicioVac = $request->fecha_inicioVac;
        $vacacion->fecha_regresoVac = $request->fecha_regresoVac;
        $vacacion->dias_usados = $request->diasTomados;
        $vacacion->save();

        // Registrar los cambios en la tabla de auditoría
        $changes = $vacacion->getChanges();
        $campos = '';
        foreach ($changes as $field => $newValue) {
            if ($field == 'updated_at') {
                continue;
            }
            if ($originalValues[$field] != $newValue) {
                $campos .= $field . '|';
            }
        }

        Audit::create([
            'nombre_usuario' => auth()->user()->nombre,
            'campos' => $campos,
            'fecha_cambio' => now(),
            'tipo' => 'Vacaciones',
        ]);

        return redirect()->route('mostrarVacaciones.show');
    }  

    public function eliminar($id)
    {
        Vacaciones::find($id)->delete();

        return back()->with('success', 'Registro de Vacación Eliminado con éxito.');
    }
    
    public function accept(Request $request, $id){

        $solicitud = Vacaciones::find($id);
        $solicitud->where('id',$id)->update(['comentario' => $request->comentario]); 
        $solicitud->where('id',$id)->update(['estado' => 'Si']); 

        $empleado = Empleados::where('curp',$solicitud->curp)->first();
        $empleado->dias_vacaciones = $empleado->dias_vacaciones - $solicitud->dias_usados;
        $empleado->save(); 

        $solicitud->save();

        return redirect()->route('vacaciones.correo', ['tipo' => 'Vacaciones', 'id' => $id, 'aux' => 'Autorizada']);
    }

    public function reject(Request $request, $id){

        $solicitud = Vacaciones::find($id);
        $solicitud->where('id',$id)->update(['comentario' => $request->comentario]);  
        $solicitud->where('id',$id)->update(['estado' => 'No']); 
        $solicitud->save();

        return redirect()->route('vacaciones.correo', ['tipo' => 'Vacaciones', 'id' => $id, 'aux' => 'Rechazada']);
    }

    public function correo($tipo,$id,$aux){

        Mail::to('antuanealex49@gmail.com')->send(new TokyoCorreos($tipo,$id,$aux));

        if($aux == 'Pedir'){
            return redirect()->route('mostrarVacaciones.show');
        }elseif($aux == 'Autorizada'){
            return redirect()->route('mostrarVacaciones.show')->with('success', 'Se ha aceptado correctamente la solicitud');
        }elseif($aux == 'Rechazada'){
            return redirect()->route('mostrarVacaciones.show')->with('success', 'Se ha rechazado correctamente la solicitud');
        }

    }

    public function vacacionesCheck(Request $request){

        $enviar = true;
        $curp = $request->curp;

        $fecha_inicio = Carbon::createFromFormat('Y-m-d', $request->inicio);
        $fecha_regreso = Carbon::createFromFormat('Y-m-d', $request->regreso);
        $empleado = Empleados::where('curp', $curp)->first();
        $puesto_empleado = $empleado->puesto;

        $vacaciones = Vacaciones::where(function ($query) use ($fecha_inicio, $fecha_regreso) {
            $query->whereBetween('fecha_inicioVac', [$fecha_inicio, $fecha_regreso])
                  ->orWhereBetween('fecha_regresoVac', [$fecha_inicio, $fecha_regreso])
                  ->orWhere(function ($query) use ($fecha_inicio, $fecha_regreso) {
                      $query->where('fecha_inicioVac', '<=', $fecha_inicio)
                            ->where('fecha_regresoVac', '>=', $fecha_regreso);
                  });
        })->get();

        foreach ($vacaciones as $vacacion) {
            $empleado_vacacion = Empleados::where('curp', $vacacion->curp)->first();
            if ($empleado_vacacion && ($puesto_empleado == $empleado_vacacion->puesto)) {
                $enviar = false;
            }
        }

        return response()->json([
            'success' => true,
            'enviar' => $enviar
        ]);
    }
}
