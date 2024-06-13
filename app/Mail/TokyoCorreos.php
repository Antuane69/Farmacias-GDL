<?php

namespace App\Mail;

use Carbon\Carbon;
use App\Models\Horarios;
use App\Models\Permisos;
use App\Models\Empleados;
use App\Models\HorariosServicio;
use App\Models\Vacaciones;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TokyoCorreos extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    //public $solicitud;
    public $tipo;
    public $id;
    public $aux;

    public function __construct($tipo,$id,$aux)
    {
        $this->tipo = $tipo;
        $this->id = $id;
        $this->aux = $aux;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $fecha = Carbon::now()->format('d/m/Y');
        
        if($this->tipo == 'Horarios'){
            
            if($this->aux == 'Servicio'){
                $titulo = 'Horario de Servicio Creado';
                $solicitud = HorariosServicio::find($this->id);
            }elseif($this->aux == 'Cocina'){
                $solicitud = Horarios::find($this->id);
                $titulo = 'Horario de Cocina Creado';
            }

            $vista = 'correo.horarioCorreo';

        }elseif($this->tipo == 'Vacaciones'){
            $solicitud = Vacaciones::find($this->id);

            if($this->aux == 'Pedir'){
                $titulo = 'Solicitud de Vacaciones';
            }elseif($this->aux == 'Autorizada'){
                $titulo = 'Solicitud Autorizada de Vacaciones';
            }elseif($this->aux == 'Rechazada'){
                $titulo = 'Solicitud Rechazada de Vacaciones';
            }

            $auxf2 = new Carbon($solicitud->fecha_inicioVac);
            $auxf3 = new Carbon($solicitud->fecha_regresoVac);

            $solicitud->inicio = $auxf2->format('d/m/Y');
            $solicitud->regreso = $auxf3->format('d/m/Y');

            $nombres = $solicitud->empleados_cubren;
            $solicitud->nombre_real = substr(str_replace('_', ', ', $nombres),1);

            $vista = 'correo.vacacionesCorreo';

        }elseif($this->tipo == 'Permisos'){
            $solicitud = Permisos::find($this->id);

            if($this->aux == 'Pedir'){
                $titulo = 'Solicitud de Permiso Laboral';
            }elseif($this->aux == 'Autorizada'){
                $titulo = 'Solicitud Autorizada de Permiso Laboral';
            }elseif($this->aux == 'Rechazada'){
                $titulo = 'Solicitud Rechazada de Permiso Laboral';
            }

            $auxf2 = new Carbon($solicitud->fecha_inicio);
            $auxf3 = new Carbon($solicitud->fecha_regreso);

            $solicitud->inicio = $auxf2->format('d/m/Y');
            $solicitud->regreso = $auxf3->format('d/m/Y');

            $nombres = $solicitud->empleados_cubren;
            $solicitud->nombre_real = substr(str_replace('_', ', ', $nombres),1);

            $vista = 'correo.permisosCorreo';

        }elseif($this->tipo == 'Contrato'){
            $solicitud = Empleados::find($this->id);

            if($this->aux == 'Segundo Contrato'){
                $titulo = 'Segundo Contrato del Empleado Apunto de Vencer';
            }elseif($this->aux == 'Tercer Contrato'){
                $titulo = 'Tercer Contrato del Empleado Apunto de Vencer';
            }elseif($this->aux == 'Contrato Indefinido'){
                $titulo = 'Contrato Indefinido del Empleado Apunto de Vencer';
            }

            $auxf = new Carbon($solicitud->fecha_2doContrato);
            $auxf2 = new Carbon($solicitud->fecha_3erContrato);
            $auxf3 = new Carbon($solicitud->fecha_indefinido);
            $auxf4 = new Carbon($solicitud->fecha_ingreso);

            $solicitud->segundo = $auxf->format('d/m/Y');
            $solicitud->tercero = $auxf2->format('d/m/Y');
            $solicitud->indefinido = $auxf3->format('d/m/Y');
            $solicitud->ingreso = $auxf4->format('d/m/Y');

            $vista = 'correo.empleadosCorreo';

        }elseif($this->tipo == 'Evaluacion'){            
            $titulo = 'ACTITUDES BÁSICO';
            $solicitud = "";

            if($this->aux == 'Evaluacion 3'){
                $empleado = Empleados::find($this->id);
                $empleado->evaluacion_export = true;
                $empleado->evaluacion_fecha = Carbon::now();
                $empleado->save();
            }

            $vista = 'correo.evaluacionesCorreo';

        }else{
            return redirect()->back();
        }

        return $this->view($vista)->with(['titulo' => $titulo, 'solicitud' => $solicitud, 'fecha' => $fecha, 'aux' => $this->aux])
        ->subject($titulo)->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
    }
}
