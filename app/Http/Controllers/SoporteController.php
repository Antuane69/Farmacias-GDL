<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Soporte;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SoporteController extends Controller
{
    public function create()
    {
        $importancias = ['Básica', 'Intermedia', 'Urgente'];
        $tipos = ['Correción de Errores', 'Nueva Caracteristica', 'Actualizar algo Existente'];
        $ticket = new Soporte();
        return view('usuario.crearSoporte',[
            'importancias' => $importancias,
            'tipos' => $tipos,
            'ticket' => $ticket
        ]);
    }

    public function store(Request $request, $id = null)
    {
        $this->validate($request, [
            // ... tus reglas de validación ...
            'titulo' => 'required',
            'descripcion' => 'required',
            'tipo' => 'required',
            'urgencia' => 'required',
            'evidencia' => 'mimes:jpg,jpeg,png,pdf|max:10240',
        ]);

        $nombreOriginal = '';
        $evidencia = $request->file('evidencia');

        if($evidencia){
            if($evidencia->getClientOriginalExtension() == 'pdf'){
                $archivopdf = $request->file('evidencia')->store('public/Soporte/' . $request->titulo);
                $nombreOriginal = 'Evidencia_' . $request->titulo . '.pdf';
                $ruta = 'public/Soporte/' . $request->titulo . '/' . $nombreOriginal;
                Storage::move($archivopdf,$ruta);
            }else{
                $ruta = public_path() . '/soporte' . '/' . $request->titulo;
                $nombreOriginal = 'Evidencia_' . $request->titulo . '.' . $evidencia->getClientOriginalExtension();
                $evidencia->move($ruta,$nombreOriginal);
            }
        }

        if($id){
            $soporte = Soporte::find($id);

            $soporte->titulo = $request->titulo;
            $soporte->descripcion = $request->descripcion;
            $soporte->tipo = $request->tipo;
            $soporte->urgencia = $request->urgencia;
            
            if($nombreOriginal != ""){
                $soporte->evidencia = $nombreOriginal;
            }

            $soporte->save();
        }else{
            Soporte::create([
                'titulo' => $request->titulo,
                'descripcion' => $request->descripcion,
                'tipo' => $request->tipo,
                'urgencia' => $request->urgencia,
                'evidencia' => $nombreOriginal
            ]);
        }

        return redirect()->route('soporte.mostrar');
    }

    public function show(){
        $tickets = Soporte::all();

        foreach($tickets as $ticket){
            $aux = new Carbon($ticket->created_at);
            $ticket->fecha = $aux->format('d/m/Y');
            $ticket->fecha_entrega = 'N/A';
        }

        return view('usuario.mostrarSoporte',[
            'tickets' => $tickets
        ]);
    }

    public function edit($id){
        $importancias = ['Básica', 'Intermedia', 'Urgente'];
        $tipos = ['Correción de Errores', 'Nueva Caracteristica', 'Actualizar algo Existente'];
        $ticket = Soporte::find($id);

        return view('usuario.crearSoporte',[
            'importancias' => $importancias,
            'tipos' => $tipos,
            'ticket' => $ticket,
        ]);
    }

    public function delete($id){
        Soporte::find($id)->delete();

        return redirect()->route('soporte.mostrar');
    }

    public function download($id){
        $soporte = Soporte::find($id);
        $evidencia = $soporte->evidencia;
        
        if($evidencia != ''){
            $position = strpos($evidencia, '.');
    
            if ($position !== false) {
                // Extrae la subcadena desde el punto en adelante
                $substring = substr($evidencia, $position);
            }
            
            if($substring == '.pdf'){
                $path = storage_path('app/public/Soporte/' . $soporte->titulo . '/' . $soporte->evidencia);

                if (file_exists($path)) {
                    // Configurar el id de respuesta como PDF
                    $headers = ['Content-Type' => 'application/pdf'];
            
                    // Descargar el archivo
                    return response()->file($path, $headers);
                };
            }else{
                $path = public_path() . '/soporte' . '/' . $soporte->titulo . '/' . $soporte->evidencia;

                if (file_exists($path)) {
                    return response()->download($path, $soporte->evidencia, [
                        'Content-Disposition' => 'attachment; filename="' . $soporte->evidencia . '"'
                    ]);
                } else {
                    return response()->json(['message' => 'File not found.'], 404);
                }
            }
        }


    }
}

