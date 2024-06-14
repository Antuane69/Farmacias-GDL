<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Empleados;
use App\Mail\TokyoCorreos;
use App\Models\Audit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{
    public function inicio(){

        $empleados = Empleados::all();
        $fecha_actual = Carbon::now();
        $tipo = 'Contrato';

        foreach($empleados as $empleado){
            $diferencia = $fecha_actual->diff($empleado->fecha_2doContrato); 
            $anios = $diferencia->y;
            $meses = $diferencia->m;
            $dias = $diferencia->d;

            $diferencia2 = $fecha_actual->diff($empleado->fecha_3erContrato); 
            $anios2 = $diferencia2->y;
            $meses2 = $diferencia2->m;
            $dias2 = $diferencia2->d;

            $diferencia3 = $fecha_actual->diff($empleado->fecha_indefinido); 
            $anios3 = $diferencia3->y;
            $meses3 = $diferencia3->m;
            $dias3 = $diferencia3->d;

            $diferencia4 = $fecha_actual->diff($empleado->evaluacion_fecha); 
            $anios4 = $diferencia4->y;
            $meses4 = $diferencia4->m;
            $dias4 = $diferencia4->d;

            if($anios == 0 && $meses == 0 && $dias < 5){
                if($empleado->correo_fecha != $fecha_actual->format('Y-m-d')){
                    $aux = 'Segundo Contrato';
                    Mail::to('antuanealex49@gmail.com')->send(new TokyoCorreos($tipo,$empleado->id,$aux));
                    $tipo = 'Evaluacion';
                    Mail::to('antuanealex49@gmail.com')->send(new TokyoCorreos($tipo,$empleado->id,$aux));
                    $empleado->correo_fecha = $fecha_actual->format('Y-m-d');
                }
            }elseif($anios2 == 0 && $meses2 == 0 && $dias2 < 5){
                if($empleado->correo_fecha != $fecha_actual->format('Y-m-d')){
                    $aux = 'Tercer Contrato';
                    Mail::to('antuanealex49@gmail.com')->send(new TokyoCorreos($tipo,$empleado->id,$aux));
                    $tipo = 'Evaluacion';
                    Mail::to('antuanealex49@gmail.com')->send(new TokyoCorreos($tipo,$empleado->id,$aux));
                    $empleado->correo_fecha = $fecha_actual->format('Y-m-d');
                }
            }elseif($anios3 == 0 && $meses3 == 0 && $dias3 < 5){
                if($empleado->correo_fecha != $fecha_actual->format('Y-m-d')){
                    $aux = 'Contrato Indefinido';
                    Mail::to('antuanealex49@gmail.com')->send(new TokyoCorreos($tipo,$empleado->id,$aux));
                    $tipo = 'Evaluacion';
                    $aux = 'Evaluacion 3';
                    if($empleado->evaluacion_export != true){
                        Mail::to('antuanealex49@gmail.com')->send(new TokyoCorreos($tipo,$empleado->id,$aux));
                    }
                    $empleado->correo_fecha = $fecha_actual->format('Y-m-d');
                }
            }

            if($anios4 == 0 && $meses4 == 2 && $dias4 == 25){
                if($empleado->correo_fecha != $fecha_actual->format('Y-m-d')){
                    $tipo = 'Evaluacion';
                    $aux = 'Evaluacion 3';
                    Mail::to('antuanealex49@gmail.com')->send(new TokyoCorreos($tipo,$empleado->id,$aux));
                    $empleado->correo_fecha = $fecha_actual->format('Y-m-d');
                }
            }

            $tipo = 'Contrato';

            $dif_vacaciones = $fecha_actual->diff($empleado->fecha_ingreso); 
            $anioTrabajado = $dif_vacaciones->y;
            $mesTrabajado = $dif_vacaciones->m;
            $diasTrabajado = $dif_vacaciones->d;

            $actualizado = $fecha_actual->diff($empleado->updated_at); 
            $mesActu = $actualizado->m;
            $diasActu = $actualizado->d;

            if($anioTrabajado == 1 && $diasTrabajado == 0 && $mesTrabajado == 0){
                $empleado->liquidacion_dias = $empleado->liquidacion_dias + $empleado->dias_vacaciones;
                $empleado->dias_vacaciones = 0;
                $empleado->dias_vacaciones = $empleado->dias_vacaciones + 2;
            }elseif($anioTrabajado == 2 && $diasTrabajado == 0 && $mesTrabajado == 0){
                $empleado->liquidacion_dias = $empleado->liquidacion_dias + $empleado->dias_vacaciones;
                $empleado->dias_vacaciones = 0;
                $empleado->dias_vacaciones = $empleado->dias_vacaciones + 3;
            }elseif($anioTrabajado == 3 && $diasTrabajado == 0 && $mesTrabajado == 0){
                $empleado->liquidacion_dias = $empleado->liquidacion_dias + $empleado->dias_vacaciones;
                $empleado->dias_vacaciones = 0;
                $empleado->dias_vacaciones = $empleado->dias_vacaciones + 4;
            }elseif($anioTrabajado == 4 && $diasTrabajado == 0 && $mesTrabajado == 0){
                $empleado->liquidacion_dias = $empleado->liquidacion_dias + $empleado->dias_vacaciones;
                $empleado->dias_vacaciones = 0;
                $empleado->dias_vacaciones = $empleado->dias_vacaciones + 5;
            }elseif($anioTrabajado == 5 && $diasTrabajado == 0 && $mesTrabajado == 0){
                $empleado->liquidacion_dias = $empleado->liquidacion_dias + $empleado->dias_vacaciones;
                $empleado->dias_vacaciones = 0;
                $empleado->dias_vacaciones = $empleado->dias_vacaciones + 6;
            }elseif($anioTrabajado == 6 && $diasTrabajado == 0 && $mesTrabajado == 0){
                $empleado->liquidacion_dias = $empleado->liquidacion_dias + $empleado->dias_vacaciones;
                $empleado->dias_vacaciones = 0;
                $empleado->dias_vacaciones = $empleado->dias_vacaciones + 7;
            }elseif($anioTrabajado == 7 && $diasTrabajado == 0 && $mesTrabajado == 0){
                $empleado->liquidacion_dias = $empleado->liquidacion_dias + $empleado->dias_vacaciones;
                $empleado->dias_vacaciones = 0;
                $empleado->dias_vacaciones = $empleado->dias_vacaciones + 8;
            }elseif($anioTrabajado == 8 && $diasTrabajado == 0 && $mesTrabajado == 0){
                $empleado->liquidacion_dias = $empleado->liquidacion_dias + $empleado->dias_vacaciones;
                $empleado->dias_vacaciones = 0;
                $empleado->dias_vacaciones = $empleado->dias_vacaciones + 9;
            }elseif($anioTrabajado == 9 && $diasTrabajado == 0 && $mesTrabajado == 0){
                $empleado->liquidacion_dias = $empleado->liquidacion_dias + $empleado->dias_vacaciones;
                $empleado->dias_vacaciones = 0;
                $empleado->dias_vacaciones = $empleado->dias_vacaciones + 10;
            }elseif($anioTrabajado == 10 && $diasTrabajado == 0 && $mesTrabajado == 0){
                $empleado->liquidacion_dias = $empleado->liquidacion_dias + $empleado->dias_vacaciones;
                $empleado->dias_vacaciones = 0;
                $empleado->dias_vacaciones = $empleado->dias_vacaciones + 11;
            }elseif($anioTrabajado == 11 && $diasTrabajado == 0 && $mesTrabajado == 0){
                $empleado->liquidacion_dias = $empleado->liquidacion_dias + $empleado->dias_vacaciones;
                $empleado->dias_vacaciones = 0;
                $empleado->dias_vacaciones = $empleado->dias_vacaciones + 12;
            }elseif($anioTrabajado == 12 && $diasTrabajado == 0 && $mesTrabajado == 0){
                $empleado->liquidacion_dias = $empleado->liquidacion_dias + $empleado->dias_vacaciones;
                $empleado->dias_vacaciones = 0;
                $empleado->dias_vacaciones = $empleado->dias_vacaciones + 13;
            }

            if(($diasTrabajado == 0 && $mesTrabajado != 0) && $diasActu != 0){
                // for($i=1;$i<=$mesTrabajado;$i++){
                //     $empleado->dias_vacaciones = $empleado->dias_vacaciones + 1;
                // }
                $empleado->dias_vacaciones = $empleado->dias_vacaciones + 1;
            }

            $empleado->save();
        }

        if(Auth::check()){
            return view('dashboard');
        }else{
            return view('auth.login');
        };
        
    }

    public function editar_historico(){
        $historial = Audit::where('tipo','Empleado')->latest()->get();

        foreach($historial as $item){

            $aCampo = explode('*', str_replace('|', ', ', $item->campos));

            // Obtén el índice del último elemento
            $lastIndex = count($aCampo) - 1;
            // Obtén el último elemento del array
            $lastElement = $aCampo[$lastIndex];
            // Elimina el último carácter del último elemento
            $aCampo[$lastIndex] = substr($lastElement, 0, -1);

            $item->campo_real = $aCampo;

            $aux = new Carbon($item->fecha_cambio);
            $item->fecha = $aux->format('d/m/Y');
        }

        $tipos = ['Empleado','Vacaciones','Falta al Reglamento','Incapacidad','Permiso','Herramienta','Uniforme','Stock','Baja','Nomina'];

        return view('gestion.editarHistorico',[
            'historial' => $historial,
            'tipos' => $tipos,
        ]);
    }

    public function filtro(Request $request)
    {
        $historial = Audit::where('tipo', $request->tipo)->latest()->get();

        foreach($historial as $item){

            $aCampo = explode('*', str_replace('|', ', ', $item->campos));

            // Obtén el índice del último elemento
            $lastIndex = count($aCampo) - 1;
            // Obtén el último elemento del array
            $lastElement = $aCampo[$lastIndex];
            // Elimina el último carácter del último elemento
            $aCampo[$lastIndex] = substr($lastElement, 0, -1);

            $item->campo_real = $aCampo;

            $aux = new Carbon($item->fecha_cambio);
            $item->fecha = $aux->format('d/m/Y');
        }
        
        return response()->json([
            'success' => true,
            'historial' => $historial
        ]);
    }
}
