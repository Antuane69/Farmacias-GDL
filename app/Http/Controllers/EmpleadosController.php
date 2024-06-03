<?php

namespace App\Http\Controllers;

use validate;
use Carbon\Carbon;
use App\Models\Audit;
use App\Models\Bajas;
use App\Models\Empleados;
use App\Mail\TokyoCorreos;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpParser\Node\Stmt\ElseIf_;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class EmpleadosController extends Controller
{
    public function dashboard(){
            $activos = Empleados::query()->count();
            $inactivos = Bajas::query()->count();

        return view('gestion.inicioGestion',[
            'activos' => $activos,
            'inactivos' => $inactivos,
        ]);
    }

    public function show(){

        $empleados = Empleados::all();

        foreach($empleados as $empleado){
            $auxf = new Carbon($empleado->fecha_ingreso);
            $empleado->fecha = $auxf->format('d/m/Y');
        }
        
        return view('gestion.mostrarEmpleado',[
            'empleados' => $empleados
        ]);
    }

    public function create()
    {
        $puestos = ['SERVICIO','BARISTA','PRODUCCION','COCINERO','SERVICIO MIXTO','WASH'];

        return view('gestion.crearEmpleado',[
            'puestos' => $puestos
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
           // ... tus reglas de validación ...
            'nombre' => 'required|max:60',
            'curp' => 'required|min:18',
            'puesto' => 'required',
            'fecha_ingreso' => 'required|date',
            'fecha_nacimiento' => 'required|date',
            'telefono' => 'max:12',
            'salario_dia' => 'required|numeric|min:0',

            'imagen_perfil' => 'mimes:jpg,jpeg,png|max:10240',
            'ine_trasera' => 'mimes:jpg,jpeg,png|max:10240',
            'ine_delantera' => 'mimes:jpg,jpeg,png|max:10240',

            'antecedentes' => 'file|mimes:pdf|max:10240',
            'recomendacion' => 'file|mimes:pdf|max:10240',
            'estudios' => 'file|mimes:pdf|max:10240',
            'nacimiento' => 'file|mimes:pdf|max:10240',
            'domicilio' => 'file|mimes:pdf|max:10240',
        ]);

        $ine_trasera = '';
        $ine_delantera = '';
        $nombreImagen = '';
        $antecedentes = '';
        $recomendacion = '';
        $estudios = '';
        $nacimiento = '';
        $domicilio = '';
        $nomina = '';

        $ruta = public_path() . '/img/gestion/Empleados';

        if ($request->hasFile('imagen_perfil')) {
            $perfil = $request->file('imagen_perfil');
            $nombreImagen =  "PP_" . $request->nombre  . "." . $perfil->getClientOriginalExtension();
            $perfil->move($ruta,$nombreImagen);
        }

        if ($request->hasFile('antecedentes')) {
            $archivopdf = $request->file('antecedentes')->store('public/Documentación/' . $request->curp);
            $antecedentes = 'antecedentes_' . $request->nombre . ".pdf";
            $ruta = 'public/Documentación/' . $request->curp . '/' . $antecedentes;
    
            Storage::move($archivopdf,$ruta);
        }

        if ($request->hasFile('recomendacion')) {
            $archivopdf = $request->file('recomendacion')->store('public/Documentación/' . $request->curp);
            $recomendacion = 'recomendacion_' . $request->nombre . ".pdf";
            $ruta = 'public/Documentación/' . $request->curp . '/' . $recomendacion;
    
            Storage::move($archivopdf,$ruta);
        }

        if ($request->hasFile('estudios')) {
            $archivopdf = $request->file('estudios')->store('public/Documentación/' . $request->curp);
            $estudios = 'estudios_' . $request->nombre . ".pdf";
            $ruta = 'public/Documentación/' . $request->curp . '/' . $estudios;
    
            Storage::move($archivopdf,$ruta);
        }

        if ($request->hasFile('nacimiento')) {
            $archivopdf = $request->file('nacimiento')->store('public/Documentación/' . $request->curp);
            $nacimiento = 'nacimiento_' . $request->nombre . ".pdf";
            $ruta = 'public/Documentación/' . $request->curp . '/' . $nacimiento;
    
            Storage::move($archivopdf,$ruta);
        }

        if ($request->hasFile('domicilio')) {
            $archivopdf = $request->file('domicilio')->store('public/Documentación/' . $request->curp);
            $domicilio = 'domicilio_' . $request->nombre . ".pdf";
            $ruta = 'public/Documentación/' . $request->curp . '/' . $domicilio;
    
            Storage::move($archivopdf,$ruta);
        }

        $ruta = public_path() . '/img/gestion/Empleados';

        if ($request->hasFile('ine_trasera')) {
            $archivo = $request->file('ine_trasera');
            $ine_trasera = 'ine_trasera_' . $request->nombre . "." . $archivo->getClientOriginalExtension();
            $archivo->move($ruta,$ine_trasera);
        }

        if ($request->hasFile('ine_delantera')) {
            $archivo = $request->file('ine_delantera');
            $ine_delantera = 'ine_delantera_' . $request->nombre . "." . $archivo->getClientOriginalExtension();
            $archivo->move($ruta,$ine_delantera);
        }

        if ($request->hasFile('nomina')) {
            $archivo = $request->file('nomina');
            $nomina = 'numero_tarjeta_' . $request->nombre . "." . $archivo->getClientOriginalExtension();
            $archivo->move($ruta,$nomina);
        } 

        $segundo = \DateTime::createFromFormat('d/m/Y', $request->fecha_2doContrato);
        $tercero = \DateTime::createFromFormat('d/m/Y', $request->fecha_3erContrato);
        $indefinido = \DateTime::createFromFormat('d/m/Y', $request->fecha_indefinido);

        Empleados::create([
            'nombre' => $request->nombre,
            'curp' => $request->curp,
            'rfc' => $request->rfc,
            'nss' => $request->nss,
            'puesto' => $request->puesto,
            'fecha_ingreso' => $request->fecha_ingreso,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'fecha_2doContrato' => $segundo,
            'fecha_3erContrato' => $tercero,
            'fecha_indefinido' => $indefinido,
            'dias_vacaciones' => $request->vacaciones,
            'telefono' => $request->telefono,
            'num_clinicaSS' => $request->num_clinicaSS,
            'salario_dia' => $request->salario_dia,
            'imagen_perfil' => $nombreImagen,

            'antecedentes' => $antecedentes,
            'recomendacion' => $recomendacion,
            'estudios' => $estudios,
            'nacimiento' => $nacimiento,
            'domicilio' => $domicilio,
            'ine' => $request->ine,
            'nomina' => $nomina,
            'ine_trasera' => $ine_trasera,
            'ine_delantera' => $ine_delantera
        ]);

        return redirect()->route('mostrarEmpleado.show');
    }

    public function detalles($id){

        $empleado = Empleados::query()->find($id);

        $auxf = new Carbon($empleado->fecha_ingreso);
        $empleado->fecha = $auxf->format('d/m/Y');

        $auxna = new Carbon($empleado->fecha_nacimiento);
        $empleado->fechaNac = $auxna->format('d/m/Y');

        $auxf2 = new Carbon($empleado->fecha_2doContrato);
        $empleado->fecha2Contrato = $auxf2->format('d/m/Y');

        $auxf3 = new Carbon($empleado->fecha_3erContrato);
        $empleado->fecha3Contrato = $auxf3->format('d/m/Y');

        $auxf4 = new Carbon($empleado->fecha_indefinido);
        $empleado->fecha4Contrato = $auxf4->format('d/m/Y');

        return view('gestion.detallesEmpleado',[
            'empleado' => $empleado,
        ]);
    }

    public function detalles_navigation($curp){

        $empleado = Empleados::where('curp',$curp)->first();

        $auxf = new Carbon($empleado->fecha_ingreso);
        $empleado->fecha = $auxf->format('d/m/Y');

        $auxna = new Carbon($empleado->fecha_nacimiento);
        $empleado->fechaNac = $auxna->format('d/m/Y');

        $auxf2 = new Carbon($empleado->fecha_2doContrato);
        $empleado->fecha2Contrato = $auxf2->format('d/m/Y');

        $auxf3 = new Carbon($empleado->fecha_3erContrato);
        $empleado->fecha3Contrato = $auxf3->format('d/m/Y');

        $auxf4 = new Carbon($empleado->fecha_indefinido);
        $empleado->fecha4Contrato = $auxf4->format('d/m/Y');

        return view('gestion.detallesEmpleado',[
            'empleado' => $empleado,
        ]);
    }

    public function edit_show($id)
    {
        $empleado = Empleados::find($id);
        $puestos = ['SERVICIO','BARISTA','PRODUCCION','COCINERO','SERVICIO MIXTO','WASH'];

        $aux = new Carbon($empleado->fecha_2doContrato);
        $empleado->contrato_2 = $aux->format('d/m/Y');

        $aux = new Carbon($empleado->fecha_3erContrato);
        $empleado->contrato_3 = $aux->format('d/m/Y');

        $aux = new Carbon($empleado->fecha_indefinido);
        $empleado->indefinido = $aux->format('d/m/Y');

        return view('gestion.editEmpleado',[
            'empleado' => $empleado,
            'puestos' => $puestos,
        ]);
    }

    public function edit_store(Request $request, $id)
    {
        $this->validate($request, [
            'imagen_perfil' => 'mimes:jpg,jpeg,png|max:10240',
            'nomina' => 'mimes:jpg,jpeg,png|max:10240',
            'ine_trasera' => 'mimes:jpg,jpeg,png|max:10240',
            'ine_delantera' => 'mimes:jpg,jpeg,png|max:10240',
            'antecedentes' => 'file|mimes:pdf|max:10240',
            'recomendacion' => 'file|mimes:pdf|max:10240',
            'estudios' => 'file|mimes:pdf|max:10240',
            'nacimiento' => 'file|mimes:pdf|max:10240',
            'domicilio' => 'file|mimes:pdf|max:10240',
        ]);
 
        $ruta = public_path() . '/img/gestion/Empleados';

        $empleado = Empleados::find($id);
        $originalValues = $empleado->getOriginal();

        $empleado->nombre = $request->nombre;
        $empleado->curp = $request->curp;
        $empleado->rfc = $request->rfc;
        $empleado->nss = $request->nss;
        $empleado->puesto = $request->puesto;
        $empleado->fecha_ingreso = $request->fecha_ingreso;
        $empleado->fecha_nacimiento = $request->fecha_nacimiento;

        $fecha = Carbon::createFromFormat('d/m/Y', $request->fecha_2doContrato);
        $empleado->fecha_2doContrato = $fecha;

        // Convertir el texto a un objeto de tipo Carbon (fecha)
        $fecha = Carbon::createFromFormat('d/m/Y', $request->fecha_3erContrato);
        $empleado->fecha_3erContrato = $fecha;

        // Convertir el texto a un objeto de tipo Carbon (fecha)
        $fecha = Carbon::createFromFormat('d/m/Y', $request->fecha_indefinido);
        $empleado->fecha_indefinido = $fecha;

        $empleado->telefono = $request->telefono;
        $empleado->dias_vacaciones = $request->vacaciones;
        $empleado->num_clinicaSS = $request->num_clinicaSS;
        $empleado->salario_dia = $request->salario_dia;
        $empleado->ine = $request->ine;  
        $empleado->nomina = $request->nomina;  

        if ($request->hasFile('imagen_perfil')) {
            $perfil = $request->file('imagen_perfil');
            $nombreImagen =  "PP_" . $request->nombre  . "." . $perfil->getClientOriginalExtension();
            $perfil->move($ruta,$nombreImagen);
            $empleado->imagen_perfil = $nombreImagen;
        }

        if ($request->hasFile('antecedentes')) {
            $archivopdf = $request->file('antecedentes')->store('public/Documentación/' . $request->curp);
            $antecedentes = 'antecedentes_' . $request->nombre . ".pdf";
            $ruta = 'public/Documentación/' . $request->curp . '/' . $antecedentes;
            $empleado->antecedentes = $antecedentes;
            Storage::move($archivopdf,$ruta);
        }

        if ($request->hasFile('recomendacion')) {
            $archivopdf = $request->file('recomendacion')->store('public/Documentación/' . $request->curp);
            $recomendacion = 'recomendacion_' . $request->nombre . ".pdf";
            $ruta = 'public/Documentación/' . $request->curp . '/' . $recomendacion;
            $empleado->recomendacion = $recomendacion;  
            Storage::move($archivopdf,$ruta);
        }

        if ($request->hasFile('estudios')) {
            $archivopdf = $request->file('estudios')->store('public/Documentación/' . $request->curp);
            $estudios = 'estudios_' . $request->nombre . ".pdf";
            $ruta = 'public/Documentación/' . $request->curp . '/' . $estudios;
            $empleado->estudios = $estudios;  
            Storage::move($archivopdf,$ruta);
        }

        if ($request->hasFile('nacimiento')) {
            $archivopdf = $request->file('nacimiento')->store('public/Documentación/' . $request->curp);
            $nacimiento = 'nacimiento_' . $request->nombre . ".pdf";
            $ruta = 'public/Documentación/' . $request->curp . '/' . $nacimiento;
            $empleado->nacimiento = $nacimiento;  
            Storage::move($archivopdf,$ruta);
        }

        if ($request->hasFile('domicilio')) {
            $archivopdf = $request->file('domicilio')->store('public/Documentación/' . $request->curp);
            $domicilio = 'domicilio_' . $request->nombre . ".pdf";
            $ruta = 'public/Documentación/' . $request->curp . '/' . $domicilio;
            $empleado->domicilio = $domicilio;  
            Storage::move($archivopdf,$ruta);
        }

        $ruta = public_path() . '/img/gestion/Empleados';

        if ($request->hasFile('ine_trasera')) {
            $archivo = $request->file('ine_trasera');
            $ine_trasera = 'ine_trasera_' . $request->nombre . "." . $archivo->getClientOriginalExtension();
            $archivo->move($ruta,$ine_trasera);
            $empleado->ine_trasera = $ine_trasera;  
        }

        if ($request->hasFile('ine_delantera')) {
            $archivo = $request->file('ine_delantera');
            $ine_delantera = 'ine_delantera_' . $request->nombre . "." . $archivo->getClientOriginalExtension();
            $archivo->move($ruta,$ine_delantera);
            $empleado->ine_delantera = $ine_delantera; 
        } 

        if ($request->hasFile('nomina')) {
            $archivo = $request->file('nomina');
            $nomina = 'numero_tarjeta_' . $request->nombre . "." . $archivo->getClientOriginalExtension();
            $archivo->move($ruta,$nomina);
            $empleado->nomina = $nomina; 
        } 

        $empleado->save();

        // Registrar los cambios en la tabla de auditoría
        $changes = $empleado->getChanges();
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
            'tipo' => 'Empleado',
        ]);

        return redirect()->route('mostrarEmpleado.show');
    }  

    public function eliminar($id)
    {
        $empleado = Empleados::find($id);

        return view('gestion.crearBaja',[
            'empleado' => $empleado,
        ]);
    }

    public function ver_pdf($id,$tipo)
    {
        $empleado =  Empleados::find($tipo);

        if($id == 'antecedentes'){
            $filename = $empleado->antecedentes; 
        }
        elseif($id == 'recomendacion'){
            $filename = $empleado->recomendacion; 
        }
        elseif($id == 'estudios'){
            $filename = $empleado->estudios; 
        }
        elseif($id == 'nacimiento'){
            $filename = $empleado->nacimiento; 
        }
        elseif($id == 'domicilio'){
            $filename = $empleado->domicilio; 
        }elseif($id == 'documentacion'){
            $filename = $empleado->documentacion; 
        };

        $path = storage_path('app/public/Documentación/' . $empleado->curp . '/' . $filename);
        
        if (file_exists($path)) {
            // Configurar el id de respuesta como PDF
            $headers = ['Content-Type' => 'application/pdf'];
    
            // Descargar el archivo
            return response()->file($path, $headers);
        };
    }   

    public function crear_datosPDF($id){

        $empleado = Empleados::find($id);
        $opciones = ['Contrato Indefinido','Contrato de 30 Dias'];
        $opciones2 = ['Casado(a)','Soltero(a)', 'Unión libre', 'Divorciado(a)','Otro'];
        $opciones3 = ['Masculino','Femenino','Otro'];
        $opciones4 = ['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo'];

        // Especifica la zona horaria
        $zonaHoraria = 'America/Mexico_City';

        // Obtén la fecha actual en la zona horaria especificada
        $fechaInicio = Carbon::now($zonaHoraria);
        $fechaTermino = new Carbon($fechaInicio);

        // Sumar 30 días a la fecha original
        $fechaTermino = $fechaTermino->addDays(30);

        return view('gestion.crearContrato',[
            'empleado' => $empleado,
            'opciones' => $opciones,
            'opciones2' => $opciones2,
            'opciones3' => $opciones3,
            'opciones4' => $opciones4,
            'fechaInicio' => $fechaInicio->format('d-m-Y'),
            'fechaTermino' => $fechaTermino->format('d-m-Y'),
        ]);
    }

    public function datos_pdf(Request $request, $id){
        $empleado = Empleados::find($id);
        // Especifica la zona horaria
        $zonaHoraria = 'America/Mexico_City';

        // Obtén la fecha actual en la zona horaria especificada
        $fecha_actual = Carbon::now($zonaHoraria);
        $fecha_actual2 = Carbon::setLocale('es');

        // Formatea la fecha en el formato deseado
        $fechaFormateada2 = $fecha_actual->isoFormat('dddd D [de] MMMM [del] YYYY');

        $fechaNacimiento = Carbon::parse($empleado->fecha_nacimiento);
        // Calcula la diferencia en años
        $edad = $fechaNacimiento->diffInYears($fecha_actual);

        $empleado->nacionalidad = 'Mexicana';
        $empleado->estado_civil = $request->estadocivil;
        $empleado->sexo = $request->sexo;
        $empleado->domicilio = $request->domicilio;

        $titulo = $request->tipo;

        $fecha_inicio = new Carbon($request->fecha_inicio);
        $fecha_indefinida = new Carbon($request->fecha_indefinida);
        $fecha_fin = $request->fecha_fin;

        $empleado->edad = $edad;
        $empleado->quincena = $request->quincena;
        $empleado->descanso = $request->descanso;
        
        $pdf = Pdf::loadView('PDF.crearContratoPDF',[
            'empleado' => $empleado,
            'fecha' => $fecha_actual,
            'fecha_inicio' => $fecha_inicio->format('d/m/Y'),
            'fecha_indefinida' => $fecha_indefinida->format('d/m/Y'),
            'fecha_fin' => $fecha_fin,
            'fechaActual' => $fechaFormateada2,
            'titulo' => $titulo
            ])->setPaper('letter', 'portrait');

        // Nombre del archivo PDF
        $nombreArchivo = $titulo . '_' . $empleado->nombre . '.pdf';

        // Devolver la respuesta con el archivo adjunto
        return $pdf->stream($nombreArchivo); 
    }

    public function subir_pdf(Request $request,$id)
    {

        $this->validate($request, [
            'DocumentacionPDF' => 'required|file|mimes:pdf|max:10240',
        ]);

        $empleado = Empleados::find($id);

        if($empleado->documentacion != ""){
            // Obtener la ruta del archivo en storage
            $ruta2 = 'public/Documentación/' . $empleado->curp . '/' . $empleado->documentacion;
            // Eliminar el archivo en storage
            Storage::delete($ruta2);
        }
        
        $archivopdf = $request->file('DocumentacionPDF')->store('public/Documentación/' . $empleado->curp);
        $nombreOriginal = $id . '_Documentacion_' . $empleado->curp . '.pdf';

        $ruta = 'public/Documentación/' . $empleado->curp . '/' . $nombreOriginal;

        $empleado->documentacion = $nombreOriginal;

        Storage::move($archivopdf,$ruta);
        $empleado->save();

        return redirect()->back();
    }   

    public function roles()
    {
        $curps = ['REFJ970121HJCYRZ00','RATZ000308MJCMMRA8','GARA000919HJCRYNA4','CULY941014MCLLNL04','TOCH981103MSRVRN00'];

        $users = Empleados::whereIn('curp',$curps)->get(); // Obtener el usuario por su ID
        $useraux = Empleados::where('nombre','Diego Isaid Perez Garcia')->first(); // Obtener el usuario por su ID
        
        $role = DB::table('roles')->where('name', 'coordinador')->first(); // Obtener el rol por su nombre

        foreach($users as $user){
            $user->roles()->attach($role->id);
        }
        $useraux->roles()->attach($role->id);

        $user->save();
        $useraux->save();

        return redirect()->back();
    }

}
