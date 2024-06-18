<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use App\Models\Permisos;
use App\Models\Empleados;
use App\Mail\TokyoCorreos;
use Illuminate\Http\Request;
use App\Models\Incapacidades;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class PermisosController extends Controller
{
    public function show(){

        if(auth()->user()->hasRole('admin')){
            $permisos = Permisos::where('estado','!=','Pendiente')->orderBy('created_at', 'desc')->with('empleado')->get();
        }elseif(auth()->user()->hasRole('coordinador')){
            $puesto = auth()->user()->puesto;
            $permisos = Permisos::whereHas('empleado', function ($query) use ($puesto) {
                $query->where('puesto', $puesto);
            })
            ->orderBy('created_at', 'desc')
            ->with('empleado')
            ->get();
        }else{
            $permisos = Permisos::where('curp',auth()->user()->curp)->orderBy('created_at', 'desc')->with('empleado')->get();
        }

        if($permisos){
            foreach($permisos as $permiso){
                $auxf = new Carbon($permiso->fecha_solicitud);
                $auxf2 = new Carbon($permiso->fecha_inicio);
                $auxf3 = new Carbon($permiso->fecha_regreso);
                $auxf4 = new Carbon($permiso->fecha_anteriorPermiso);
    
                $permiso->solicitud = $auxf->format('d/m/Y');
                $permiso->inicio = $auxf2->format('d/m/Y');
                $permiso->regreso = $auxf3->format('d/m/Y');
                $permiso->anterior = $auxf4->format('d/m/Y');

                $nombres = $permiso->empleados_cubren;
                $permiso->nombre_real = substr(str_replace('_', ', ', $nombres),1);
            }
        }
        
        return view('gestion.mostrarPermisos',[
            'permisos' => $permisos
        ]);
    }

    public function show_pendientes(){
        
        $permisos = Permisos::where('estado','Pendiente')->orderBy('created_at', 'desc')->with('empleado')->get();
        
        foreach($permisos as $permiso){
            $auxf = new Carbon($permiso->fecha_solicitud);
            $auxf2 = new Carbon($permiso->fecha_inicio);
            $auxf3 = new Carbon($permiso->fecha_regreso);
            $auxf4 = new Carbon($permiso->fecha_anteriorPermiso);

            $permiso->solicitud = $auxf->format('d/m/Y');
            $permiso->inicio = $auxf2->format('d/m/Y');
            $permiso->regreso = $auxf3->format('d/m/Y');
            $permiso->anterior = $auxf4->format('d/m/Y');

            $nombres = $permiso->empleados_cubren;
            $permiso->nombre_real = substr(str_replace('_', ', ', $nombres),1);
        }

        return view('gestion.mostrarPermisosPendientes',[
            'permisos' => $permisos
        ]);
    }

    public function create()
    {
        if(auth()->user()->hasRole('admin')){
            $nombres = Empleados::all();
        }elseif(auth()->user()->hasRole('coordinador')){
            $puesto = auth()->user()->puesto;
            $nombres = Empleados::where('puesto',$puesto)->where('curp', '!=', auth()->user()->curp)->get();
        }else{
            $nombres = Empleados::where('puesto',auth()->user()->puesto)->get();
        }
        $nombres = $nombres->pluck('nombre')->toArray();

        return view('gestion.crearPermisos',[
            'nombres' => $nombres
        ]);
    }

    public function store(Request $request)
    {
    
        $this->validate($request, [
            'nombresreg' => 'required',
            'curp' => 'required|min:18',
            'fecha_solicitud' => 'required|date',
            'fecha_inicio' => 'required|date',
            'motivo' => 'required|max:100',
        ]);
        
        $datos = $request->input('nombresreg');
        $empleado['nombre'] = "";

        foreach ($datos as $nombre) {
            $empleado['nombre'] = $empleado['nombre'] . '_' . $nombre;
        }

        $fechaSoli = Carbon::parse($request->input('fecha_solicitud'))->format('Y-m-d');
        $fechaInicio = Carbon::parse($request->input('fecha_inicio'))->format('Y-m-d');
        $fechaRegreso = Carbon::parse($request->input('fecha_regreso'))->format('Y-m-d');

        $Ultimopermiso = Permisos::where('curp',$request->curp)->orderBy('created_at', 'desc')->first();

        if($Ultimopermiso == null){
            $fechaAnterior = $fechaInicio;
        }else{
            $fechaAnterior = $Ultimopermiso->fecha_inicio;
        }

        Permisos::create([
            'curp' => $request->curp,
            'fecha_solicitud' => $fechaSoli,
            'fecha_inicio' => $fechaInicio,
            'fecha_regreso' => $fechaRegreso,
            'dias_totales' => $request->dias_totales,
            'motivo' => $request->motivo,
            'fecha_anteriorPermiso' => $fechaAnterior,
            'estado' => 'Pendiente',
            'empleados_cubren' => $empleado['nombre'],
        ]);

        $id = Permisos::max('id');

        return redirect()->route('permisos.correo', ['tipo' => 'Permisos', 'id' => $id, 'aux' => 'Pedir']);
    }

    public function search(Request $request){

        $empleado = Empleados::where('nombre', 'LIKE', $request->nombre . '%')
        ->orderBy('created_at', 'desc')
        ->with(['permisos' => function ($query) {
            $query->latest()->first();
        }])
        ->first();

        $test = Permisos::where('curp',$empleado->curp)->first();

        if($test != null){
            $permiso_anterior = "";
        }else{
            $permiso_anterior = "No existe";
        };

        return response()->json([
            'success' => true,
            'empleado' => $empleado,
            'permiso_anterior' => $permiso_anterior,
        ]);
    }

    public function edit_show($id)
    {
        $permiso = Permisos::find($id);

        return view('gestion.editPermisos',[
            'permiso' =>$permiso,
        ]);
    }

    public function edit_store(Request $request, $id)
    {
        $permiso = Permisos::with('empleado')->find($id);
        $originalValues = $permiso->getOriginal();

        $permiso->curp = $request->curp;
        $permiso->fecha_solicitud = $request->fecha_solicitud;
        $permiso->fecha_inicio = $request->fecha_inicio;
        $permiso->fecha_regreso = $request->fecha_regreso;
        $permiso->dias_totales = $request->dias_totales;
        $permiso->motivo = $request->motivo;

        $fechaInicio = Carbon::parse($request->input('fecha_inicio'))->format('Y-m-d');

        $Ultimopermiso = Permisos::where('curp',$request->curp)->orderBy('created_at', 'desc')->first();

        if($Ultimopermiso == null){
            $fechaAnterior = $fechaInicio;
        }else{
            $fechaAnterior = $Ultimopermiso->fecha_inicio;
        }

        $permiso->fecha_anteriorPermiso = $fechaAnterior;
        $permiso->save();

        // Registrar los cambios en la tabla de auditoría
        $changes = $permiso->getChanges();
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
            'tipo' => 'Permiso',
        ]);

        return redirect()->route('mostrarPermisos.show');
    }  

    public function eliminar($id)
    {
        Permisos::find($id)->delete();

        return back()->with('success', 'Registro de Permiso Eliminado con éxito.');
    }
    
    public function accept(Request $request, $id){
        
        $solicitud = Permisos::find($id);
        $solicitud->where('id',$id)->update(['comentario' => $request->comentario]); 
        $solicitud->where('id',$id)->update(['estado' => 'Si']); 
        $solicitud->save();

        return redirect()->route('permisos.correo', ['tipo' => 'Permisos', 'id' => $id, 'aux' => 'Autorizada']);
    }

    public function reject(Request $request, $id){

        $solicitud = Permisos::find($id);
        $solicitud->where('id',$id)->update(['comentario' => $request->comentario]);  
        $solicitud->where('id',$id)->update(['estado' => 'No']); 
        $solicitud->save();

        return redirect()->route('permisos.correo', ['tipo' => 'Permisos', 'id' => $id, 'aux' => 'Rechazada']);
    }

    public function correo($tipo,$id,$aux){

        Mail::to('antuanealex49@gmail.com')->send(new TokyoCorreos($tipo,$id,$aux));

        if($aux == 'Pedir'){
            return redirect()->route('mostrarPermisos.show');
        }elseif($aux == 'Autorizada'){
            return redirect()->route('mostrarPermisos.show')->with('success', 'Se ha aceptado correctamente la solicitud');
        }elseif($aux == 'Rechazada'){
            return redirect()->route('mostrarPermisos.show')->with('success', 'Se ha rechazado correctamente la solicitud');
        }

    }
}