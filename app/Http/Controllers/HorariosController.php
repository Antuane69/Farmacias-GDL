<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Horarios;
use App\Models\Empleados;
use App\Mail\TokyoCorreos;
use App\Models\Vacaciones;
use Illuminate\Http\Request;
use App\Models\HorariosServicio;
use App\View\Components\Horario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class HorariosController extends Controller
{
    public function show(){

        $horario = Horarios::orderBy('created_at', 'desc')->first();
        $horarioServicio = HorariosServicio::orderBy('created_at', 'desc')->first();

        $areas = ['COCINA','SERVICIO','BARRA'];

        if($horario){
            $nombreArea = 'COCINA';

            $nombres = $horario->cocinero_lunes;
            $clunes = explode('*', str_replace('_', ', ', $nombres));
            // Eliminar la coma al final de cada nombre
            for ($i = 0; $i < count($clunes); $i++) {
                $clunes[$i] = ltrim($clunes[$i], ',');
            }
    
            $horario->clunes = $clunes;
    
            $nombres = $horario->cocinero_martes;
            $cmartes = explode('*', str_replace('_', ', ', $nombres));
            // Eliminar la coma al final de cada nombre
            for ($i = 0; $i < count($cmartes); $i++) {
                $cmartes[$i] = ltrim($cmartes[$i], ',');
            }
    
            $horario->cmartes = $cmartes;
    
            $nombres = $horario->cocinero_miercoles;
            $cmiercoles = explode('*', str_replace('_', ', ', $nombres));
            // Eliminar la coma al final de cada nombre
            for ($i = 0; $i < count($cmiercoles); $i++) {
                $cmiercoles[$i] = ltrim($cmiercoles[$i], ',');
            }
    
            $horario->cmiercoles = $cmiercoles;
    
            $nombres = $horario->cocinero_jueves;
            $cjueves = explode('*', str_replace('_', ', ', $nombres));
            // Eliminar la coma al final de cada nombre
            for ($i = 0; $i < count($cjueves); $i++) {
                $cjueves[$i] = ltrim($cjueves[$i], ',');
            }
    
            $horario->cjueves = $cjueves;
    
            $nombres = $horario->cocinero_viernes;
            $cviernes = explode('*', str_replace('_', ', ', $nombres));
            // Eliminar la coma al final de cada nombre
            for ($i = 0; $i < count($cviernes); $i++) {
                $cviernes[$i] = ltrim($cviernes[$i], ',');
            }
    
            $horario->cviernes = $cviernes;
    
            $nombres = $horario->cocinero_sabado;
            $csabado = explode('*', str_replace('_', ', ', $nombres));
            // Eliminar la coma al final de cada nombre
            for ($i = 0; $i < count($csabado); $i++) {
                $csabado[$i] = ltrim($csabado[$i], ',');
            }
    
            $horario->csabado = $csabado;
    
            $nombres = $horario->cocinero_domingo;
            $cdomingo = explode('*', str_replace('_', ', ', $nombres));
            // Eliminar la coma al final de cada nombre
            for ($i = 0; $i < count($cdomingo); $i++) {
                $cdomingo[$i] = ltrim($cdomingo[$i], ',');
            }
    
            $horario->cdomingo = $cdomingo;

            $auxf = new Carbon($horario->created_at);           
            $horario->registro = $auxf->format('d/m/Y');
            
            $horario->turno = ['12-00 AM a 18-00 PM','15-00 PM a 23 -00 AM','18-00 PM a 00-00 AM','Descansos'];
            $horario->turnoBarra = ['10-00 AM a 18-00 PM','18-00 PM a 00-00 AM'];

            return view('horarios.mostrarRegistroHorarios',[
                'horario' => $horario,
                'areas' => $areas,
                'nombreArea' => $nombreArea
            ]);

        }else if($horarioServicio){
            $nombreArea = 'SERVICIO';

            $nombres = $horarioServicio->servicio_lunes;
            $slunes = explode('*', str_replace('_', ', ', $nombres));
            // Eliminar la coma al final de cada nombre
            for ($i = 0; $i < count($slunes); $i++) {
                $slunes[$i] = ltrim($slunes[$i], ',');
            }
    
            $horarioServicio->slunes = $slunes;
    
            $nombres = $horarioServicio->servicio_martes;
            $smartes = explode('*', str_replace('_', ', ', $nombres));
            // Eliminar la coma al final de cada nombre
            for ($i = 0; $i < count($smartes); $i++) {
                $smartes[$i] = ltrim($smartes[$i], ',');
            }
    
            $horarioServicio->smartes = $smartes;
    
            $nombres = $horarioServicio->servicio_miercoles;
            $smiercoles = explode('*', str_replace('_', ', ', $nombres));
            // Eliminar la coma al final de cada nombre
            for ($i = 0; $i < count($smiercoles); $i++) {
                $smiercoles[$i] = ltrim($smiercoles[$i], ',');
            }
    
            $horarioServicio->smiercoles = $smiercoles;
    
            $nombres = $horarioServicio->servicio_jueves;
            $sjueves = explode('*', str_replace('_', ', ', $nombres));
            // Eliminar la coma al final de cada nombre
            for ($i = 0; $i < count($sjueves); $i++) {
                $sjueves[$i] = ltrim($sjueves[$i], ',');
            }
    
            $horarioServicio->sjueves = $sjueves;
    
            $nombres = $horarioServicio->servicio_viernes;
            $sviernes = explode('*', str_replace('_', ', ', $nombres));
            // Eliminar la coma al final de cada nombre
            for ($i = 0; $i < count($sviernes); $i++) {
                $sviernes[$i] = ltrim($sviernes[$i], ',');
            }
    
            $horarioServicio->sviernes = $sviernes;
    
            $nombres = $horarioServicio->servicio_sabado;
            $ssabado = explode('*', str_replace('_', ', ', $nombres));
            // Eliminar la coma al final de cada nombre
            for ($i = 0; $i < count($ssabado); $i++) {
                $ssabado[$i] = ltrim($ssabado[$i], ',');
            }
    
            $horarioServicio->ssabado = $ssabado;
    
            $nombres = $horarioServicio->servicio_domingo;
            $sdomingo = explode('*', str_replace('_', ', ', $nombres));
            // Eliminar la coma al final de cada nombre
            for ($i = 0; $i < count($sdomingo); $i++) {
                $sdomingo[$i] = ltrim($sdomingo[$i], ',');
            }
    
            $horarioServicio->sdomingo = $sdomingo;
    
            $nombres = $horarioServicio->barra_lunes;
            $blunes = explode('*', str_replace('_', ', ', $nombres));
            // Eliminar la coma al final de cada nombre
            for ($i = 0; $i < count($blunes); $i++) {
                $blunes[$i] = ltrim($blunes[$i], ',');
            }
    
            $horarioServicio->blunes = $blunes;
    
            $nombres = $horarioServicio->barra_martes;
            $bmartes = explode('*', str_replace('_', ', ', $nombres));
            // Eliminar la coma al final de cada nombre
            for ($i = 0; $i < count($bmartes); $i++) {
                $bmartes[$i] = ltrim($bmartes[$i], ',');
            }
    
            $horarioServicio->bmartes = $bmartes;
    
            $nombres = $horarioServicio->barra_miercoles;
            $bmiercoles = explode('*', str_replace('_', ', ', $nombres));
            // Eliminar la coma al final de cada nombre
            for ($i = 0; $i < count($bmiercoles); $i++) {
                $bmiercoles[$i] = ltrim($bmiercoles[$i], ',');
            }
    
            $horarioServicio->bmiercoles = $bmiercoles;
    
            $nombres = $horarioServicio->barra_jueves;
            $bjueves = explode('*', str_replace('_', ', ', $nombres));
            // Eliminar la coma al final de cada nombre
            for ($i = 0; $i < count($bjueves); $i++) {
                $bjueves[$i] = ltrim($bjueves[$i], ',');
            }
    
            $horarioServicio->bjueves = $bjueves;
    
            $nombres = $horarioServicio->barra_viernes;
            $bviernes = explode('*', str_replace('_', ', ', $nombres));
            // Eliminar la coma al final de cada nombre
            for ($i = 0; $i < count($bviernes); $i++) {
                $bviernes[$i] = ltrim($bviernes[$i], ',');
            }
    
            $horarioServicio->bviernes = $bviernes;
    
            $nombres = $horarioServicio->barra_sabado;
            $bsabado = explode('*', str_replace('_', ', ', $nombres));
            // Eliminar la coma al final de cada nombre
            for ($i = 0; $i < count($bsabado); $i++) {
                $bsabado[$i] = ltrim($bsabado[$i], ',');
            }
    
            $horarioServicio->bsabado = $bsabado;
    
            $nombres = $horarioServicio->barra_domingo;
            $bdomingo = explode('*', str_replace('_', ', ', $nombres));
            // Eliminar la coma al final de cada nombre
            for ($i = 0; $i < count($bdomingo); $i++) {
                $bdomingo[$i] = ltrim($bdomingo[$i], ',');
            }
    
            $horarioServicio->bdomingo = $bdomingo;

            $auxf = new Carbon($horarioServicio->created_at);           
            $horarioServicio->registro = $auxf->format('d/m/Y');
            
            $horarioServicio->turno = ['12-00 AM a 18-00 PM','15-00 PM a 23-00 AM','18-00 PM a 00-00 AM','Descansos'];
            $horarioServicio->turnoBarra = ['10-00 AM a 18-00 PM','18-00 PM a 00-00 AM'];

            return view('horarios.mostrarRegistroHorarios',[
                'horario' => $horarioServicio,
                'areas' => $areas,
                'nombreArea' => $nombreArea
            ]);
        }else{
            return view('horarios.mostrarRegistroHorarios',[
                'horario' => '',
                'areas' => $areas,
                'nombreArea' => 'COCINA'
            ]);
        }
    }

    public function createTemplate($tipo)
    {
        return redirect()->route('template.store',[
            'tipo' => $tipo
        ]);
    }

    public function storeTemplate($tipo)
    {
        $puesto = auth()->user()->puesto;

        $auxf = Carbon::now();       
        $fechaActual = $auxf->format('Y/m/d');

        $nombres_a = Empleados::all();
        $vacaciones = Vacaciones::where('fecha_regresoVac','>',$fechaActual)->where('fecha_inicioVac', '<=', $fechaActual)->with('empleado')->get();
        $arrayVacaciones = $vacaciones->pluck('empleado.nombre')->toArray();

        // Filtrar los nombres de los empleados que no están de vacaciones
        $nombres = $nombres_a->filter(function ($empleado) use ($arrayVacaciones) {
            return !in_array($empleado->nombre, $arrayVacaciones);
        });

        if($puesto == 'COCINERO' || $puesto == 'PRODUCCION' || $puesto == 'WASH' || $tipo == 'Cocina'){
            $horario = Horarios::orderBy('created_at', 'desc')->first();
            
            $nombres_coc = $nombres->where('puesto','COCINERO')->pluck('nombre')->toArray();
            $contadorCocina = count($nombres_coc);
            $arregloCocina = array();

            if($horario){
                $fechaHorario = Carbon::createFromFormat('Y-m-d H:i:s', $horario->created_at);
                $diferenciaDias = $auxf->diffInDays($fechaHorario);

                if ($diferenciaDias >= 6) {

                    if($contadorCocina == 5){

                        $arregloCocina[] = array(
                            'lunes' => 1,
                            'martes' => 1,
                            'miercoles' => 1,
                            'jueves' => 1,
                            'viernes' => 1,
                            'sabado' => 1,
                            'domingo' => 5 
                        );
                        
                        $arregloCocina[] = array(
                            'lunes' => 2,
                            'martes' => 2,
                            'miercoles' => 2,
                            'jueves' => 2,
                            'viernes' => 2,
                            'sabado' => 3,
                            'domingo' => 5 
                        );
            
                        $arregloCocina[] = array(
                            'lunes' => 1,
                            'martes' => 1,
                            'miercoles' => 1,
                            'jueves' => 2,
                            'viernes' => 2,
                            'sabado' => 1,
                            'domingo' => 5 
                        );
            
                        $arregloCocina[] = array(
                            'lunes' => 1,
                            'martes' => 1,
                            'miercoles' => 1,
                            'jueves' => 1,
                            'viernes' => 0,
                            'sabado' => 0,
                            'domingo' => 1 
                        );
            
                    }elseif($contadorCocina == 6){
            
                        $arregloCocina[] = array(
                            'lunes' => 2,
                            'martes' => 1,
                            'miercoles' => 2,
                            'jueves' => 2,
                            'viernes' => 2,
                            'sabado' => 2,
                            'domingo' => 6 
                        );
                        
                        $arregloCocina[] = array(
                            'lunes' => 1,
                            'martes' => 2,
                            'miercoles' => 2,
                            'jueves' => 2,
                            'viernes' => 2,
                            'sabado' => 3,
                            'domingo' => 6 
                        );
            
                        $arregloCocina[] = array(
                            'lunes' => 2,
                            'martes' => 1,
                            'miercoles' => 1,
                            'jueves' => 2,
                            'viernes' => 2,
                            'sabado' => 1,
                            'domingo' => 6 
                        );
            
                        $arregloCocina[] = array(
                            'lunes' => 1,
                            'martes' => 2,
                            'miercoles' => 1,
                            'jueves' => 1,
                            'viernes' => 0,
                            'sabado' => 0,
                            'domingo' => 1 
                        );
            
                    }elseif($contadorCocina == 7){
                        
                        $arregloCocina[] = array(
                            'lunes' => 3,
                            'martes' => 2,
                            'miercoles' => 2,
                            'jueves' => 3,
                            'viernes' => 3,
                            'sabado' => 2,
                            'domingo' => 6 
                        );
                        
                        $arregloCocina[] = array(
                            'lunes' => 0,
                            'martes' => 1,
                            'miercoles' => 1,
                            'jueves' => 0,
                            'viernes' => 1,
                            'sabado' => 2,
                            'domingo' => 6 
                        );
            
                        $arregloCocina[] = array(
                            'lunes' => 3,
                            'martes' => 2,
                            'miercoles' => 2,
                            'jueves' => 3,
                            'viernes' => 3,
                            'sabado' => 2,
                            'domingo' => 6 
                        );
            
                        $arregloCocina[] = array(
                            'lunes' => 1,
                            'martes' => 2,
                            'miercoles' => 2,
                            'jueves' => 1,
                            'viernes' => 0,
                            'sabado' => 0,
                            'domingo' => 1 
                        );
            
                    }elseif($contadorCocina == 8){
            
                        $arregloCocina[] = array(
                            'lunes' => 3,
                            'martes' => 3,
                            'miercoles' => 3,
                            'jueves' => 3,
                            'viernes' => 4,
                            'sabado' => 4,
                            'domingo' => 7 
                        );
                        
                        $arregloCocina[] = array(
                            'lunes' => 0,
                            'martes' => 0,
                            'miercoles' => 0,
                            'jueves' => 0,
                            'viernes' => 0,
                            'sabado' => 1,
                            'domingo' => 7
                        );
            
                        $arregloCocina[] = array(
                            'lunes' => 3,
                            'martes' => 3,
                            'miercoles' => 3,
                            'jueves' => 4,
                            'viernes' => 4,
                            'sabado' => 3,
                            'domingo' => 7 
                        );
            
                        $arregloCocina[] = array(
                            'lunes' => 2,
                            'martes' => 2,
                            'miercoles' => 2,
                            'jueves' => 1,
                            'viernes' => 0,
                            'sabado' => 0,
                            'domingo' => 1 
                        );
                    }elseif($contadorCocina >= 9){
            
                        $arregloCocina[] = array(
                            'lunes' => 3,
                            'martes' => 3,
                            'miercoles' => 3,
                            'jueves' => 4,
                            'viernes' => 4,
                            'sabado' => 4,
                            'domingo' =>8 
                        );
                        
                        $arregloCocina[] = array(
                            'lunes' => 1,
                            'martes' => 1,
                            'miercoles' => 1,
                            'jueves' => 1,
                            'viernes' => 1,
                            'sabado' => 1,
                            'domingo' => 8
                        );
            
                        $arregloCocina[] = array(
                            'lunes' => 3,
                            'martes' => 3,
                            'miercoles' => 3,
                            'jueves' => 3,
                            'viernes' => 4,
                            'sabado' => 3,
                            'domingo' => 8 
                        );
            
                        $arregloCocina[] = array(
                            'lunes' => 2,
                            'martes' => 2,
                            'miercoles' => 2,
                            'jueves' => 2,
                            'viernes' => 0,
                            'sabado' => 0,
                            'domingo' => 1 
                        );
            
                    }else{
                        
                        $arregloCocina[] = array(
                            'lunes' => 3,
                            'martes' => 3,
                            'miercoles' => 3,
                            'jueves' => 4,
                            'viernes' => 4,
                            'sabado' => 4,
                            'domingo' =>8 
                        );
                        
                        $arregloCocina[] = array(
                            'lunes' => 1,
                            'martes' => 1,
                            'miercoles' => 1,
                            'jueves' => 1,
                            'viernes' => 1,
                            'sabado' => 1,
                            'domingo' => 8
                        );
            
                        $arregloCocina[] = array(
                            'lunes' => 3,
                            'martes' => 3,
                            'miercoles' => 3,
                            'jueves' => 3,
                            'viernes' => 4,
                            'sabado' => 3,
                            'domingo' => 8 
                        );
            
                        $arregloCocina[] = array(
                            'lunes' => 2,
                            'martes' => 2,
                            'miercoles' => 2,
                            'jueves' => 2,
                            'viernes' => 0,
                            'sabado' => 0,
                            'domingo' => 1 
                        );
            
                    }

                    return view('horarios.crearRegistroHorarioCocina',[
                        'nombres' => $nombres_coc,
                        'arregloCocina' => $arregloCocina,
                        'area' => 'Cocina'
                    ]);

                }else{

                    $fecha = $horario->created_at->format('d/m/Y');
                    return view('horarios.crearRegistroHorarioCocina',[
                        'nombres' => $fecha,
                        'arregloCocina' => $arregloCocina,
                        'area' => ''
                    ]);
                }
            }else{

                if($contadorCocina == 5){

                    $arregloCocina[] = array(
                        'lunes' => 1,
                        'martes' => 1,
                        'miercoles' => 1,
                        'jueves' => 1,
                        'viernes' => 1,
                        'sabado' => 1,
                        'domingo' => 5 
                    );
                    
                    $arregloCocina[] = array(
                        'lunes' => 2,
                        'martes' => 2,
                        'miercoles' => 2,
                        'jueves' => 2,
                        'viernes' => 2,
                        'sabado' => 3,
                        'domingo' => 5 
                    );

                    $arregloCocina[] = array(
                        'lunes' => 1,
                        'martes' => 1,
                        'miercoles' => 1,
                        'jueves' => 2,
                        'viernes' => 2,
                        'sabado' => 1,
                        'domingo' => 5 
                    );

                    $arregloCocina[] = array(
                        'lunes' => 1,
                        'martes' => 1,
                        'miercoles' => 1,
                        'jueves' => 1,
                        'viernes' => 0,
                        'sabado' => 0,
                        'domingo' => 1 
                    );

                }elseif($contadorCocina == 6){

                    $arregloCocina[] = array(
                        'lunes' => 2,
                        'martes' => 1,
                        'miercoles' => 2,
                        'jueves' => 2,
                        'viernes' => 2,
                        'sabado' => 2,
                        'domingo' => 6 
                    );
                    
                    $arregloCocina[] = array(
                        'lunes' => 1,
                        'martes' => 2,
                        'miercoles' => 2,
                        'jueves' => 2,
                        'viernes' => 2,
                        'sabado' => 3,
                        'domingo' => 6 
                    );

                    $arregloCocina[] = array(
                        'lunes' => 2,
                        'martes' => 1,
                        'miercoles' => 1,
                        'jueves' => 2,
                        'viernes' => 2,
                        'sabado' => 1,
                        'domingo' => 6 
                    );

                    $arregloCocina[] = array(
                        'lunes' => 1,
                        'martes' => 2,
                        'miercoles' => 1,
                        'jueves' => 1,
                        'viernes' => 0,
                        'sabado' => 0,
                        'domingo' => 1 
                    );

                }elseif($contadorCocina == 7){
                    
                    $arregloCocina[] = array(
                        'lunes' => 3,
                        'martes' => 2,
                        'miercoles' => 2,
                        'jueves' => 3,
                        'viernes' => 3,
                        'sabado' => 2,
                        'domingo' => 6 
                    );
                    
                    $arregloCocina[] = array(
                        'lunes' => 0,
                        'martes' => 1,
                        'miercoles' => 1,
                        'jueves' => 0,
                        'viernes' => 1,
                        'sabado' => 2,
                        'domingo' => 6 
                    );

                    $arregloCocina[] = array(
                        'lunes' => 3,
                        'martes' => 2,
                        'miercoles' => 2,
                        'jueves' => 3,
                        'viernes' => 3,
                        'sabado' => 2,
                        'domingo' => 6 
                    );

                    $arregloCocina[] = array(
                        'lunes' => 1,
                        'martes' => 2,
                        'miercoles' => 2,
                        'jueves' => 1,
                        'viernes' => 0,
                        'sabado' => 0,
                        'domingo' => 1 
                    );

                }elseif($contadorCocina == 8){

                    $arregloCocina[] = array(
                        'lunes' => 3,
                        'martes' => 3,
                        'miercoles' => 3,
                        'jueves' => 3,
                        'viernes' => 4,
                        'sabado' => 4,
                        'domingo' => 7 
                    );
                    
                    $arregloCocina[] = array(
                        'lunes' => 0,
                        'martes' => 0,
                        'miercoles' => 0,
                        'jueves' => 0,
                        'viernes' => 0,
                        'sabado' => 1,
                        'domingo' => 7
                    );

                    $arregloCocina[] = array(
                        'lunes' => 3,
                        'martes' => 3,
                        'miercoles' => 3,
                        'jueves' => 4,
                        'viernes' => 4,
                        'sabado' => 3,
                        'domingo' => 7 
                    );

                    $arregloCocina[] = array(
                        'lunes' => 2,
                        'martes' => 2,
                        'miercoles' => 2,
                        'jueves' => 1,
                        'viernes' => 0,
                        'sabado' => 0,
                        'domingo' => 1 
                    );
                }elseif($contadorCocina >= 9){

                    $arregloCocina[] = array(
                        'lunes' => 3,
                        'martes' => 3,
                        'miercoles' => 3,
                        'jueves' => 4,
                        'viernes' => 4,
                        'sabado' => 4,
                        'domingo' =>8 
                    );
                    
                    $arregloCocina[] = array(
                        'lunes' => 1,
                        'martes' => 1,
                        'miercoles' => 1,
                        'jueves' => 1,
                        'viernes' => 1,
                        'sabado' => 1,
                        'domingo' => 8
                    );
        
                    $arregloCocina[] = array(
                        'lunes' => 3,
                        'martes' => 3,
                        'miercoles' => 3,
                        'jueves' => 3,
                        'viernes' => 4,
                        'sabado' => 3,
                        'domingo' => 8 
                    );
        
                    $arregloCocina[] = array(
                        'lunes' => 2,
                        'martes' => 2,
                        'miercoles' => 2,
                        'jueves' => 2,
                        'viernes' => 0,
                        'sabado' => 0,
                        'domingo' => 1 
                    );

                }else{
                    
                    $arregloCocina[] = array(
                        'lunes' => 3,
                        'martes' => 3,
                        'miercoles' => 3,
                        'jueves' => 4,
                        'viernes' => 4,
                        'sabado' => 4,
                        'domingo' =>8 
                    );
                    
                    $arregloCocina[] = array(
                        'lunes' => 1,
                        'martes' => 1,
                        'miercoles' => 1,
                        'jueves' => 1,
                        'viernes' => 1,
                        'sabado' => 1,
                        'domingo' => 8
                    );
        
                    $arregloCocina[] = array(
                        'lunes' => 3,
                        'martes' => 3,
                        'miercoles' => 3,
                        'jueves' => 3,
                        'viernes' => 4,
                        'sabado' => 3,
                        'domingo' => 8 
                    );
        
                    $arregloCocina[] = array(
                        'lunes' => 2,
                        'martes' => 2,
                        'miercoles' => 2,
                        'jueves' => 2,
                        'viernes' => 0,
                        'sabado' => 0,
                        'domingo' => 1 
                    );

                }

                return view('horarios.crearRegistroHorarioCocina',[
                    'nombres' => $nombres_coc,
                    'arregloCocina' => $arregloCocina,
                    'area' => 'Cocina'
                ]);
            }

        }else{
            $horarioServicio = HorariosServicio::orderBy('created_at', 'desc')->first();

            $nombres_ser = $nombres->whereIn('puesto', ['SERVICIO', 'MESERO', 'SERVICIO MIXTO'])->pluck('nombre')->toArray();
            $contadorServicio = count($nombres_ser);
            $arregloServicio = array();

            if($horarioServicio){
                $fechaHorarioServicio = Carbon::createFromFormat('Y-m-d H:i:s', $horarioServicio->created_at);
                $diferenciaDias = $auxf->diffInDays($fechaHorarioServicio);
            
                if ($diferenciaDias >= 6) {

                    if($contadorServicio == 5){

                        $arregloServicio[] = array(
                            'lunes' => 1,
                            'martes' => 1,
                            'miercoles' => 1,
                            'jueves' => 1,
                            'viernes' => 1,
                            'sabado' => 1,
                            'domingo' => 5 
                        );
                        
                        $arregloServicio[] = array(
                            'lunes' => 2,
                            'martes' => 2,
                            'miercoles' => 2,
                            'jueves' => 2,
                            'viernes' => 2,
                            'sabado' => 3,
                            'domingo' => 5 
                        );
            
                        $arregloServicio[] = array(
                            'lunes' => 1,
                            'martes' => 1,
                            'miercoles' => 1,
                            'jueves' => 2,
                            'viernes' => 2,
                            'sabado' => 1,
                            'domingo' => 5 
                        );
            
                        $arregloServicio[] = array(
                            'lunes' => 1,
                            'martes' => 1,
                            'miercoles' => 1,
                            'jueves' => 1,
                            'viernes' => 0,
                            'sabado' => 0,
                            'domingo' => 1 
                        );
            
                    }elseif($contadorServicio == 6){
            
                        $arregloServicio[] = array(
                            'lunes' => 2,
                            'martes' => 1,
                            'miercoles' => 2,
                            'jueves' => 2,
                            'viernes' => 2,
                            'sabado' => 2,
                            'domingo' => 6 
                        );
                        
                        $arregloServicio[] = array(
                            'lunes' => 1,
                            'martes' => 2,
                            'miercoles' => 2,
                            'jueves' => 2,
                            'viernes' => 2,
                            'sabado' => 3,
                            'domingo' => 6 
                        );
            
                        $arregloServicio[] = array(
                            'lunes' => 2,
                            'martes' => 1,
                            'miercoles' => 1,
                            'jueves' => 2,
                            'viernes' => 2,
                            'sabado' => 1,
                            'domingo' => 6 
                        );
            
                        $arregloServicio[] = array(
                            'lunes' => 1,
                            'martes' => 2,
                            'miercoles' => 1,
                            'jueves' => 1,
                            'viernes' => 0,
                            'sabado' => 0,
                            'domingo' => 1 
                        );
            
                    }elseif($contadorServicio == 7){
            
                        $arregloServicio[] = array(
                            'lunes' => 3,
                            'martes' => 2,
                            'miercoles' => 2,
                            'jueves' => 3,
                            'viernes' => 3,
                            'sabado' => 2,
                            'domingo' => 6 
                        );
                        
                        $arregloServicio[] = array(
                            'lunes' => 0,
                            'martes' => 1,
                            'miercoles' => 1,
                            'jueves' => 0,
                            'viernes' => 1,
                            'sabado' => 2,
                            'domingo' => 6 
                        );
            
                        $arregloServicio[] = array(
                            'lunes' => 3,
                            'martes' => 2,
                            'miercoles' => 2,
                            'jueves' => 3,
                            'viernes' => 3,
                            'sabado' => 2,
                            'domingo' => 6 
                        );
            
                        $arregloServicio[] = array(
                            'lunes' => 1,
                            'martes' => 2,
                            'miercoles' => 2,
                            'jueves' => 1,
                            'viernes' => 0,
                            'sabado' => 0,
                            'domingo' => 1 
                        );
            
                    }elseif($contadorServicio == 8){
            
                        $arregloServicio[] = array(
                            'lunes' => 3,
                            'martes' => 3,
                            'miercoles' => 3,
                            'jueves' => 3,
                            'viernes' => 4,
                            'sabado' => 4,
                            'domingo' => 7 
                        );
                        
                        $arregloServicio[] = array(
                            'lunes' => 0,
                            'martes' => 0,
                            'miercoles' => 0,
                            'jueves' => 0,
                            'viernes' => 0,
                            'sabado' => 1,
                            'domingo' => 7
                        );
            
                        $arregloServicio[] = array(
                            'lunes' => 3,
                            'martes' => 3,
                            'miercoles' => 3,
                            'jueves' => 4,
                            'viernes' => 4,
                            'sabado' => 3,
                            'domingo' => 7 
                        );
            
                        $arregloServicio[] = array(
                            'lunes' => 2,
                            'martes' => 2,
                            'miercoles' => 2,
                            'jueves' => 1,
                            'viernes' => 0,
                            'sabado' => 0,
                            'domingo' => 1 
                        );

                    }elseif($contadorServicio >= 9){
            
                        $arregloServicio[] = array(
                            'lunes' => 3,
                            'martes' => 3,
                            'miercoles' => 3,
                            'jueves' => 4,
                            'viernes' => 4,
                            'sabado' => 4,
                            'domingo' =>8 
                        );
                        
                        $arregloServicio[] = array(
                            'lunes' => 1,
                            'martes' => 1,
                            'miercoles' => 1,
                            'jueves' => 1,
                            'viernes' => 1,
                            'sabado' => 1,
                            'domingo' => 8
                        );
            
                        $arregloServicio[] = array(
                            'lunes' => 3,
                            'martes' => 3,
                            'miercoles' => 3,
                            'jueves' => 3,
                            'viernes' => 4,
                            'sabado' => 3,
                            'domingo' => 8 
                        );
            
                        $arregloServicio[] = array(
                            'lunes' => 2,
                            'martes' => 2,
                            'miercoles' => 2,
                            'jueves' => 2,
                            'viernes' => 0,
                            'sabado' => 0,
                            'domingo' => 1 
                        );
            
                    }else{
            
                        $arregloServicio[] = array(
                            'lunes' => 3,
                            'martes' => 3,
                            'miercoles' => 3,
                            'jueves' => 4,
                            'viernes' => 4,
                            'sabado' => 4,
                            'domingo' =>8 
                        );
                        
                        $arregloServicio[] = array(
                            'lunes' => 1,
                            'martes' => 1,
                            'miercoles' => 1,
                            'jueves' => 1,
                            'viernes' => 1,
                            'sabado' => 1,
                            'domingo' => 8
                        );
            
                        $arregloServicio[] = array(
                            'lunes' => 3,
                            'martes' => 3,
                            'miercoles' => 3,
                            'jueves' => 3,
                            'viernes' => 4,
                            'sabado' => 3,
                            'domingo' => 8 
                        );
            
                        $arregloServicio[] = array(
                            'lunes' => 2,
                            'martes' => 2,
                            'miercoles' => 2,
                            'jueves' => 2,
                            'viernes' => 0,
                            'sabado' => 0,
                            'domingo' => 1 
                        );
            
                    }

                    return view('horarios.crearRegistroHorarioServicio',[
                        'nombres_ser' => $nombres_ser,
                        'arregloServicio' => $arregloServicio,
                        'area' => 'Servicio'
                    ]);

                }else{

                    $fecha = $horarioServicio->created_at->format('d/m/Y');
                    return view('horarios.crearRegistroHorarioServicio',[
                        'nombres_ser' => $fecha,
                        'arregloServicio' => $arregloServicio,
                        'area' => ''
                    ]);
                }
            }else{
                if($contadorServicio == 5){
                    $arregloServicio[] = array(
                        'lunes' => 1,
                        'martes' => 1,
                        'miercoles' => 1,
                        'jueves' => 1,
                        'viernes' => 1,
                        'sabado' => 1,
                        'domingo' => 5 
                    );
                    
                    $arregloServicio[] = array(
                        'lunes' => 2,
                        'martes' => 2,
                        'miercoles' => 2,
                        'jueves' => 2,
                        'viernes' => 2,
                        'sabado' => 3,
                        'domingo' => 5 
                    );

                    $arregloServicio[] = array(
                        'lunes' => 1,
                        'martes' => 1,
                        'miercoles' => 1,
                        'jueves' => 2,
                        'viernes' => 2,
                        'sabado' => 1,
                        'domingo' => 5 
                    );

                    $arregloServicio[] = array(
                        'lunes' => 1,
                        'martes' => 1,
                        'miercoles' => 1,
                        'jueves' => 1,
                        'viernes' => 0,
                        'sabado' => 0,
                        'domingo' => 1 
                    );

                }elseif($contadorServicio == 6){

                    $arregloServicio[] = array(
                        'lunes' => 2,
                        'martes' => 1,
                        'miercoles' => 2,
                        'jueves' => 2,
                        'viernes' => 2,
                        'sabado' => 2,
                        'domingo' => 6 
                    );
                    
                    $arregloServicio[] = array(
                        'lunes' => 1,
                        'martes' => 2,
                        'miercoles' => 2,
                        'jueves' => 2,
                        'viernes' => 2,
                        'sabado' => 3,
                        'domingo' => 6 
                    );

                    $arregloServicio[] = array(
                        'lunes' => 2,
                        'martes' => 1,
                        'miercoles' => 1,
                        'jueves' => 2,
                        'viernes' => 2,
                        'sabado' => 1,
                        'domingo' => 6 
                    );

                    $arregloServicio[] = array(
                        'lunes' => 1,
                        'martes' => 2,
                        'miercoles' => 1,
                        'jueves' => 1,
                        'viernes' => 0,
                        'sabado' => 0,
                        'domingo' => 1 
                    );

                }elseif($contadorServicio == 7){

                    $arregloServicio[] = array(
                        'lunes' => 3,
                        'martes' => 2,
                        'miercoles' => 2,
                        'jueves' => 3,
                        'viernes' => 3,
                        'sabado' => 2,
                        'domingo' => 6 
                    );
                    
                    $arregloServicio[] = array(
                        'lunes' => 0,
                        'martes' => 1,
                        'miercoles' => 1,
                        'jueves' => 0,
                        'viernes' => 1,
                        'sabado' => 2,
                        'domingo' => 6 
                    );

                    $arregloServicio[] = array(
                        'lunes' => 3,
                        'martes' => 2,
                        'miercoles' => 2,
                        'jueves' => 3,
                        'viernes' => 3,
                        'sabado' => 2,
                        'domingo' => 6 
                    );

                    $arregloServicio[] = array(
                        'lunes' => 1,
                        'martes' => 2,
                        'miercoles' => 2,
                        'jueves' => 1,
                        'viernes' => 0,
                        'sabado' => 0,
                        'domingo' => 1 
                    );

                }elseif($contadorServicio == 8){

                    $arregloServicio[] = array(
                        'lunes' => 3,
                        'martes' => 3,
                        'miercoles' => 3,
                        'jueves' => 3,
                        'viernes' => 4,
                        'sabado' => 4,
                        'domingo' => 7 
                    );
                    
                    $arregloServicio[] = array(
                        'lunes' => 0,
                        'martes' => 0,
                        'miercoles' => 0,
                        'jueves' => 0,
                        'viernes' => 0,
                        'sabado' => 1,
                        'domingo' => 7
                    );

                    $arregloServicio[] = array(
                        'lunes' => 3,
                        'martes' => 3,
                        'miercoles' => 3,
                        'jueves' => 4,
                        'viernes' => 4,
                        'sabado' => 3,
                        'domingo' => 7 
                    );

                    $arregloServicio[] = array(
                        'lunes' => 2,
                        'martes' => 2,
                        'miercoles' => 2,
                        'jueves' => 1,
                        'viernes' => 0,
                        'sabado' => 0,
                        'domingo' => 1 
                    );

                }elseif($contadorServicio >= 9){

                    $arregloServicio[] = array(
                        'lunes' => 3,
                        'martes' => 3,
                        'miercoles' => 3,
                        'jueves' => 4,
                        'viernes' => 4,
                        'sabado' => 4,
                        'domingo' =>8 
                    );
                    
                    $arregloServicio[] = array(
                        'lunes' => 1,
                        'martes' => 1,
                        'miercoles' => 1,
                        'jueves' => 1,
                        'viernes' => 1,
                        'sabado' => 1,
                        'domingo' => 8
                    );
        
                    $arregloServicio[] = array(
                        'lunes' => 3,
                        'martes' => 3,
                        'miercoles' => 3,
                        'jueves' => 3,
                        'viernes' => 4,
                        'sabado' => 3,
                        'domingo' => 8 
                    );
        
                    $arregloServicio[] = array(
                        'lunes' => 2,
                        'martes' => 2,
                        'miercoles' => 2,
                        'jueves' => 2,
                        'viernes' => 0,
                        'sabado' => 0,
                        'domingo' => 1 
                    );

                }else{

                    $arregloServicio[] = array(
                        'lunes' => 3,
                        'martes' => 3,
                        'miercoles' => 3,
                        'jueves' => 4,
                        'viernes' => 4,
                        'sabado' => 4,
                        'domingo' =>8 
                    );
                    
                    $arregloServicio[] = array(
                        'lunes' => 1,
                        'martes' => 1,
                        'miercoles' => 1,
                        'jueves' => 1,
                        'viernes' => 1,
                        'sabado' => 1,
                        'domingo' => 8
                    );
        
                    $arregloServicio[] = array(
                        'lunes' => 3,
                        'martes' => 3,
                        'miercoles' => 3,
                        'jueves' => 3,
                        'viernes' => 4,
                        'sabado' => 3,
                        'domingo' => 8 
                    );
        
                    $arregloServicio[] = array(
                        'lunes' => 2,
                        'martes' => 2,
                        'miercoles' => 2,
                        'jueves' => 2,
                        'viernes' => 0,
                        'sabado' => 0,
                        'domingo' => 1 
                    );

                }

                return view('horarios.crearRegistroHorarioServicio',[
                    'nombres_ser' => $nombres_ser,
                    'arregloServicio' => $arregloServicio,
                    'area' => 'Servicio'
                ]);
            }
        }
    }

    public function store(Request $request, $area)
    {
        for($k = 1;$k < 22;$k++){
            ${'datos' . $k} = '';
        }

        if($area == 'Cocina'){

            for($i = 0;$i<4;$i++){

                $valor1 = $request->input("cocinerolunes" . $i);
                foreach ($valor1 as $nombre) {
                    if (!empty($datos1)) {
                        $datos1 .= '_';
                    }
                    $datos1 .= $nombre;
                }
                $datos1 .= '*';
    
                $valor2 = $request->input("cocineromartes" . $i);
                foreach ($valor2 as $nombre) {
                    if (!empty($datos2)) {
                        $datos2 .= '_';
                    }
                    $datos2 .= $nombre;
                }
                $datos2 .= '*';
    
                $valor3 = $request->input("cocineromiercoles" . $i);
                foreach ($valor3 as $nombre) {
                    if (!empty($datos3)) {
                        $datos3 .= '_';
                    }
                    $datos3 .= $nombre;
                }
                $datos3 .= '*';
    
                $valor4 = $request->input("cocinerojueves" . $i);
                foreach ($valor4 as $nombre) {
                    if (!empty($datos4)) {
                        $datos4 .= '_';
                    }
                    $datos4 .= $nombre;
                }
                $datos4 .= '*';
    
                if($request->input("cocineroviernes" . $i)){
                    $valor5 = $request->input("cocineroviernes" . $i);
                    foreach ($valor5 as $nombre) {
                        if (!empty($datos5)) {
                            $datos5 .= '_';
                        }
                        $datos5 .= $nombre;
                    }
                    $datos5 .= '*';
                }else{
                    $datos5 .= ",*";
                }

                if($request->input("cocineroviernes" . $i)){
                    $valor6 = $request->input("cocinerosabado" . $i);
                    foreach ($valor6 as $nombre) {
                        if (!empty($datos6)) {
                            $datos6 .= '_';
                        }
                        $datos6 .= $nombre;
                    }
                    $datos6 .= '*';
                }else{
                    $datos6 .= ",*";
                }
    
                $valor7 = $request->input("cocinerodomingo" . $i);
                foreach ($valor7 as $nombre) {
                    if (!empty($datos7)) {
                        $datos7 .= '_';
                    }
                    $datos7 .= $nombre;
                }
                $datos7 .= '*';
            };

            Horarios::create([
                'cocinero_lunes' => $datos1,
                'cocinero_martes' => $datos2,
                'cocinero_miercoles' => $datos3,
                'cocinero_jueves' => $datos4,
                'cocinero_viernes' => $datos5,
                'cocinero_sabado' => $datos6,
                'cocinero_domingo' => $datos7
            ]);

            $id = Horarios::max('id');

            return redirect()->route('horarios.correo', ['tipo' => 'Horarios', 'id' => $id, 'aux' => 'Cocina']);
            
        }else{

            for($i = 0;$i<4;$i++){
                $valor1 = $request->input("serviciolunes" . $i);
                foreach ($valor1 as $nombre) {
                    if (!empty($datos8)) {
                        $datos8 .= '_';
                    }
                    $datos8 .= $nombre;
                }
                $datos8 .= '*';
    
                $valor2 = $request->input("serviciomartes" . $i);
                foreach ($valor2 as $nombre) {
                    if (!empty($datos9)) {
                        $datos9 .= '_';
                    }
                    $datos9 .= $nombre;
                }
                $datos9 .= '*';
    
                $valor3 = $request->input("serviciomiercoles" . $i);
                foreach ($valor3 as $nombre) {
                    if (!empty($datos10)) {
                        $datos10 .= '_';
                    }
                    $datos10 .= $nombre;
                }
                $datos10 .= '*';
    
                $valor4 = $request->input("serviciojueves" . $i);
                foreach ($valor4 as $nombre) {
                    if (!empty($datos11)) {
                        $datos11 .= '_';
                    }
                    $datos11 .= $nombre;
                }
                $datos11 .= '*';
    
                if($request->input("servicioviernes" . $i)){
                    $valor5 = $request->input("servicioviernes" . $i);
                    foreach ($valor5 as $nombre) {
                        if (!empty($datos12)) {
                            $datos12 .= '_';
                        }
                        $datos12 .= $nombre;
                    }
                    $datos12 .= '*';
                }else{
                    $datos12 .= ",*";
                }

                if($request->input("serviciosabado" . $i)){
                    $valor6 = $request->input("serviciosabado" . $i);
                    foreach ($valor6 as $nombre) {
                        if (!empty($datos13)) {
                            $datos13 .= '_';
                        }
                        $datos13 .= $nombre;
                    }
                    $datos13 .= '*';
                }else{
                    $datos13 .= ",*";
                }
    
                $valor7 = $request->input("serviciodomingo" . $i);
                foreach ($valor7 as $nombre) {
                    if (!empty($datos14)) {
                        $datos14 .= '_';
                    }
                    $datos14 .= $nombre;
                }
                $datos14 .= '*';
            }    

            $datos15 = 'HANNAH YAEL MALAGON TONCHE*Luis Javier Vera Hernandez*,*,*';
            $datos16 = 'HANNAH YAEL MALAGON TONCHE*Luis Javier Vera Hernandez*,*,*';
            $datos17 = 'HANNAH YAEL MALAGON TONCHE*Luis Javier Vera Hernandez*,*,*';
            $datos18 = 'HANNAH YAEL MALAGON TONCHE*Luis Javier Vera Hernandez*,*,*';
            $datos19 = 'HANNAH YAEL MALAGON TONCHE*Luis Javier Vera Hernandez*,*,*';
            $datos20 = 'HANNAH YAEL MALAGON TONCHE*Luis Javier Vera Hernandez*,*,*';
            $datos21 = 'HANNAH YAEL MALAGON TONCHE*Luis Javier Vera Hernandez*,*,*';

            HorariosServicio::create([
                'servicio_lunes' => $datos8,
                'servicio_martes' => $datos9,
                'servicio_miercoles' => $datos10,
                'servicio_jueves' => $datos11,
                'servicio_viernes' => $datos12,
                'servicio_sabado' => $datos13,
                'servicio_domingo' => $datos14,
                'barra_lunes' => $datos15,
                'barra_martes' => $datos16,
                'barra_miercoles' => $datos17,
                'barra_jueves' => $datos18,
                'barra_viernes' => $datos19,
                'barra_sabado' => $datos20,
                'barra_domingo' => $datos21,
            ]);

            $id = HorariosServicio::max('id');

            return redirect()->route('horarios.correo', ['tipo' => 'Horarios', 'id' => $id, 'aux' => 'Servicio']);
        };
    }

    public function filtro(Request $request)
    {
        
        $horario = Horarios::orderBy('created_at', 'desc')->first();
        $horarioServicio = HorariosServicio::orderBy('created_at', 'desc')->first();

        if($request->area == 'COCINA'){

            if($horario){

                $nombres = $horario->cocinero_lunes;
                $clunes = explode('*', str_replace('_', ', ', $nombres));
                // Eliminar la coma al final de cada nombre
                for ($i = 0; $i < count($clunes); $i++) {
                    $clunes[$i] = ltrim($clunes[$i], ',');
                }
        
                $horario->lunes = $clunes;
        
                $nombres = $horario->cocinero_martes;
                $cmartes = explode('*', str_replace('_', ', ', $nombres));
                // Eliminar la coma al final de cada nombre
                for ($i = 0; $i < count($cmartes); $i++) {
                    $cmartes[$i] = ltrim($cmartes[$i], ',');
                }
        
                $horario->martes = $cmartes;
        
                $nombres = $horario->cocinero_miercoles;
                $cmiercoles = explode('*', str_replace('_', ', ', $nombres));
                // Eliminar la coma al final de cada nombre
                for ($i = 0; $i < count($cmiercoles); $i++) {
                    $cmiercoles[$i] = ltrim($cmiercoles[$i], ',');
                }
        
                $horario->miercoles = $cmiercoles;
        
                $nombres = $horario->cocinero_jueves;
                $cjueves = explode('*', str_replace('_', ', ', $nombres));
                // Eliminar la coma al final de cada nombre
                for ($i = 0; $i < count($cjueves); $i++) {
                    $cjueves[$i] = ltrim($cjueves[$i], ',');
                }
        
                $horario->jueves = $cjueves;
        
                $nombres = $horario->cocinero_viernes;
                $cviernes = explode('*', str_replace('_', ', ', $nombres));
                // Eliminar la coma al final de cada nombre
                for ($i = 0; $i < count($cviernes); $i++) {
                    $cviernes[$i] = ltrim($cviernes[$i], ',');
                }
        
                $horario->viernes = $cviernes;
        
                $nombres = $horario->cocinero_sabado;
                $csabado = explode('*', str_replace('_', ', ', $nombres));
                // Eliminar la coma al final de cada nombre
                for ($i = 0; $i < count($csabado); $i++) {
                    $csabado[$i] = ltrim($csabado[$i], ',');
                }
        
                $horario->sabado = $csabado;
        
                $nombres = $horario->cocinero_domingo;
                $cdomingo = explode('*', str_replace('_', ', ', $nombres));
                // Eliminar la coma al final de cada nombre
                for ($i = 0; $i < count($cdomingo); $i++) {
                    $cdomingo[$i] = ltrim($cdomingo[$i], ',');
                }
        
                $horario->domingo = $cdomingo;

                $horario->turno = ['12-00 AM a 18-00 PM','15-00 PM a 23-00 PM','18-00 PM a 00-00 AM','Descansos'];

                return response()->json([
                    'horario' => $horario,
                    'success' => true,
                ]);
    
            }else{

                return response()->json([
                    'success' => false,
                ]);

            }

        }elseif($request->area == 'SERVICIO'){

            if($horarioServicio){

                $nombres = $horarioServicio->servicio_lunes;
                $slunes = explode('*', str_replace('_', ', ', $nombres));
                // Eliminar la coma al final de cada nombre
                for ($i = 0; $i < count($slunes); $i++) {
                    $slunes[$i] = ltrim($slunes[$i], ',');
                }
        
                $horarioServicio->lunes = $slunes;
        
                $nombres = $horarioServicio->servicio_martes;
                $smartes = explode('*', str_replace('_', ', ', $nombres));
                // Eliminar la coma al final de cada nombre
                for ($i = 0; $i < count($smartes); $i++) {
                    $smartes[$i] = ltrim($smartes[$i], ',');
                }
        
                $horarioServicio->martes = $smartes;
        
                $nombres = $horarioServicio->servicio_miercoles;
                $smiercoles = explode('*', str_replace('_', ', ', $nombres));
                // Eliminar la coma al final de cada nombre
                for ($i = 0; $i < count($smiercoles); $i++) {
                    $smiercoles[$i] = ltrim($smiercoles[$i], ',');
                }
        
                $horarioServicio->miercoles = $smiercoles;
        
                $nombres = $horarioServicio->servicio_jueves;
                $sjueves = explode('*', str_replace('_', ', ', $nombres));
                // Eliminar la coma al final de cada nombre
                for ($i = 0; $i < count($sjueves); $i++) {
                    $sjueves[$i] = ltrim($sjueves[$i], ',');
                }
        
                $horarioServicio->jueves = $sjueves;
        
                $nombres = $horarioServicio->servicio_viernes;
                $sviernes = explode('*', str_replace('_', ', ', $nombres));
                // Eliminar la coma al final de cada nombre
                for ($i = 0; $i < count($sviernes); $i++) {
                    $sviernes[$i] = ltrim($sviernes[$i], ',');
                }
        
                $horarioServicio->viernes = $sviernes;
        
                $nombres = $horarioServicio->servicio_sabado;
                $ssabado = explode('*', str_replace('_', ', ', $nombres));
                // Eliminar la coma al final de cada nombre
                for ($i = 0; $i < count($ssabado); $i++) {
                    $ssabado[$i] = ltrim($ssabado[$i], ',');
                }
        
                $horarioServicio->sabado = $ssabado;
        
                $nombres = $horarioServicio->servicio_domingo;
                $sdomingo = explode('*', str_replace('_', ', ', $nombres));
                // Eliminar la coma al final de cada nombre
                for ($i = 0; $i < count($sdomingo); $i++) {
                    $sdomingo[$i] = ltrim($sdomingo[$i], ',');
                }
        
                $horarioServicio->domingo = $sdomingo;

                $horarioServicio->turno = ['12-00 AM a 18-00 PM','15-00 PM a 23-00 PM','18-00 PM a 00-00 AM','Descansos'];
   
                return response()->json([
                    'horario' => $horarioServicio,
                    'success' => true,
                ]);
                
            }else{                
                return response()->json([
                    'success' => false,
                ]);
            }

        }else{

            if($horarioServicio){

                $nombres = $horarioServicio->barra_lunes;
                $blunes = explode('*', str_replace('_', ', ', $nombres));
                // Eliminar la coma al final de cada nombre
                for ($i = 0; $i < count($blunes); $i++) {
                    $blunes[$i] = ltrim($blunes[$i], ',');
                }
        
                $horarioServicio->lunes = $blunes;
        
                $nombres = $horarioServicio->barra_martes;
                $bmartes = explode('*', str_replace('_', ', ', $nombres));
                // Eliminar la coma al final de cada nombre
                for ($i = 0; $i < count($bmartes); $i++) {
                    $bmartes[$i] = ltrim($bmartes[$i], ',');
                }
        
                $horarioServicio->martes = $bmartes;
        
                $nombres = $horarioServicio->barra_miercoles;
                $bmiercoles = explode('*', str_replace('_', ', ', $nombres));
                // Eliminar la coma al final de cada nombre
                for ($i = 0; $i < count($bmiercoles); $i++) {
                    $bmiercoles[$i] = ltrim($bmiercoles[$i], ',');
                }
        
                $horarioServicio->miercoles = $bmiercoles;
        
                $nombres = $horarioServicio->barra_jueves;
                $bjueves = explode('*', str_replace('_', ', ', $nombres));
                // Eliminar la coma al final de cada nombre
                for ($i = 0; $i < count($bjueves); $i++) {
                    $bjueves[$i] = ltrim($bjueves[$i], ',');
                }
        
                $horarioServicio->jueves = $bjueves;
        
                $nombres = $horarioServicio->barra_viernes;
                $bviernes = explode('*', str_replace('_', ', ', $nombres));
                // Eliminar la coma al final de cada nombre
                for ($i = 0; $i < count($bviernes); $i++) {
                    $bviernes[$i] = ltrim($bviernes[$i], ',');
                }
        
                $horarioServicio->viernes = $bviernes;
        
                $nombres = $horarioServicio->barra_sabado;
                $bsabado = explode('*', str_replace('_', ', ', $nombres));
                // Eliminar la coma al final de cada nombre
                for ($i = 0; $i < count($bsabado); $i++) {
                    $bsabado[$i] = ltrim($bsabado[$i], ',');
                }
        
                $horarioServicio->sabado = $bsabado;
        
                $nombres = $horarioServicio->barra_domingo;
                $bdomingo = explode('*', str_replace('_', ', ', $nombres));
                // Eliminar la coma al final de cada nombre
                for ($i = 0; $i < count($bdomingo); $i++) {
                    $bdomingo[$i] = ltrim($bdomingo[$i], ',');
                }
        
                $horarioServicio->domingo = $bdomingo;
                $horarioServicio->turno = ['10-00 AM a 18-00 PM','18-00 PM a 00-00 AM','','',''];
    
                return response()->json([
                    'horario' => $horarioServicio,
                    'success' => true,
                ]);

            }else{

                return response()->json([
                    'success' => false,
                ]);

            }
        }
    }

    public function correo($tipo,$id,$aux){

        Mail::to('antuanealex49@gmail.com')->send(new TokyoCorreos($tipo,$id,$aux));
        return redirect()->route('horario.mostrar');

    }
}
