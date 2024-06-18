<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Audit;
use App\Models\Nomina;
use App\Models\Empleados;
use App\Models\Uniformes;
use App\Models\NumTrabajo;
use App\Models\PivoteNomina;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Validator;

class NominaController extends Controller
{

    public function historico(){
        $nominas = Nomina::with('empleado')->get();

        foreach($nominas as $nomina){
            if($nomina->empleado){
                $empleado_ob = Empleados::where('nombre', 'LIKE' , $nomina->empleado->nombre . '%')->first();
                if($empleado_ob){
                    $nomina->nombre_real = $empleado_ob->nombre;
                }else{
                    $nomina->nombre_real = $nomina->empleado->nombre;
                }
            }else{
                $nomina->nombre_real = 'No existe en base de datos';
            }
        }
        // Suma todos los valores de la columna 'total'
        $total = Nomina::where('horas','!=','0')->sum('total');
    
        return view('nomina.historicoNomina',[
            'nominas' => $nominas,
            'total' => $total
        ]);

    }

    public function show(){
        $nominas = Nomina::with('empleado')->get();

        foreach($nominas as $nomina){
            if($nomina->empleado){
                $empleado_ob = Empleados::where('nombre', 'LIKE' , $nomina->empleado->nombre . '%')->first();
                if($empleado_ob){
                    $nomina->nombre_real = $empleado_ob->nombre;
                }else{
                    $nomina->nombre_real = $nomina->empleado->nombre;
                }
            }else{
                $nomina->nombre_real = 'No existe en base de datos';
            }
        }

        $k = 0;

        return view('nomina.mostrarNomina',[
            'nominas' => $nominas,
            'k' => $k,
        ]);

    }

    public function store(Request $request){
        $nominas = Nomina::all();
        $k = 0;
        
        
        foreach($nominas as $nomina){
            $zonaHoraria = 'America/Mexico_City';
            // Obtén la fecha actual en la zona horaria especificada
            Carbon::setLocale('es');
            $fecha_final = Carbon::createFromFormat('Y-m-d H:i:s', $nomina->created_at);
            $fecha_actual = $fecha_final->copy()->subDays(15);

            if (isset($nomina->empleado)) {
                $empleado_ob = Empleados::where('nombre', 'LIKE' , $nomina->empleado->nombre . '%')->first();
            } else {
                $empleado_ob = false;
            }

            if($empleado_ob){
                $fecha_inicio_format = $fecha_actual->toDateTimeString();
                $fecha_final_format = $fecha_final->toDateTimeString();

                $uniformes = Uniformes::where('curp', $empleado_ob->curp)
                ->whereBetween('created_at', [$fecha_inicio_format, $fecha_final_format])->get();

                $uniformes_total = Uniformes::where('curp', $empleado_ob->curp)->where('exportado','!=',true)
                ->whereBetween('created_at', [$fecha_inicio_format, $fecha_final_format])->sum('total');
                $uniformes_nomina = round(($uniformes_total/3),2);

                $aux = false;
                foreach($uniformes as $item){
                    if($item->exportado == false){
                        if($aux != true){
                            for($i=0;$i<3;$i++){
                                PivoteNomina::create([
                                    'id_nomina' => $nomina->curp,
                                    'curp' => $item->curp,
                                    'uniforme' => $uniformes_nomina,
                                ]);
                            }
                            $aux = true;
                        }
                        $item->exportado = true;
                        $item->save();
                    }
                }
                $pivote = PivoteNomina::where('id_nomina',$nomina->curp)->first();
                if($pivote){
                    if($pivote->exportado != true){
                        $uniforme = $pivote->uniforme;
                        $pivote->exportado = true;                    
                        $pivote->save();
                    }
                }else{
                    $uniforme = 0;
                }
                if($empleado_ob->salario_dia == 0){
                    $sueldo_hora = 260 / 6;
                }else{
                    $sueldo_hora = $empleado_ob->salario_dia / 6;
                }
            }else{
                $sueldo_hora = 260 / 6;
            }

            $nomina->imss = 59.81;
            $nomina->prima_v = $request->input("prima_vacacional" . $k);
            $nomina->festivos = $request->input("festivos" . $k);
            $nomina->descuentos = $request->input("descuentos" . $k);
            $nomina->comida = $request->input("comida" . $k);
            $nomina->prima_d = $request->input("prima" . $k); 
            $nomina->bonos = $request->input("bonos" . $k); 
            $nomina->host = $request->input("host" . $k); 
            $nomina->gasolina = $request->input("gasolina" . $k); 

            $nomina_f = (($nomina->minutos/60) * $sueldo_hora) + ($nomina->horas * $sueldo_hora) + $nomina->bonos + $nomina->host + $nomina->gasolina
            + $nomina->prima_v + $nomina->festivos + $uniforme + $nomina->prima_d - ($nomina->imss + $nomina->comida + 75.46 + $nomina->descuentos);
            $nomina_total = round($nomina_f, 2); // Redondea a 2 decimales sin formatear

            // Guarda el valor redondeado directamente
            $nomina->total = $nomina_total;
            $nomina->save();
            $k++;
        }

        return redirect()->route('nomina.historico')->with('success', 'Datos guardados correctamente.');
    }

    public function csv(){
        return view('nomina.subircsv');
    }

    public function store_csv(Request $request)
    {
        // Validar que el archivo sea un CSV o XLS/XLSX
        $validator = Validator::make($request->all(), [
            'csv_file' => 'required|file|mimes:xls,xlsx',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Obtener el archivo subido
        $file = $request->file('csv_file');
        $data = $this->readExcel($file,'registro de pasar la tarjeta');

        $array = [];
        $arrHoras = [];
        $arrMinutos = [];
        $pruebas = [];

        $cont = 0;
        $cont2 = 0;
        $numero_trabajo = 0;
        $aux = false;

        $nominas = Nomina::all();
        foreach($nominas as $nomina){
            $pivotes = PivoteNomina::where('id_nomina',$nomina->curp)->get();
            foreach($pivotes as $pivote){
                $pivote->delete();
                break;
            }
        }

        Nomina::truncate();

        foreach($data as $datos){
            $cont++;
            if($cont%2 == 1){
                foreach($datos as $d){
                    $cont2++;
                    if($cont2 == 5){
                        $numero_trabajo = $d;
                        $cont2 = 0;
                        break;
                    }
                }
            }else{
                foreach($datos as $d){
                    $longitud = strlen($d);

                    for ($i=0; $i < $longitud/5; $i++) {
                        $valor = substr($d,0,5);
                        $array[] = $valor;
                        $d = substr($d, 5);
                    }
                }
                if(empty($array) == false){
                    //dd($array);
                    for($i=0;$i<(count($array)*2);$i+=2){

                        if(!array_key_exists($i, $array) || !array_key_exists($i+1, $array)){
                            break;
                        }

                        $if_val = substr($array[$i], 0, 2);
                        $if_val2 = substr($array[$i+1], 0, 2);

                        if(array_key_exists($i+2, $array)){
                            $if_val3 = substr($array[$i+2], 0, 2);
                            if($if_val2 == $if_val3){
                                $aux = true;
                            }
                        }

                        if($if_val == '00'){
                            $valor = $array[$i];
                            $resto = substr($valor,2);
                            $array[$i] = '24' . $resto;
                        }
                        
                        if($if_val2 == '00'){
                            if($aux){
                                $valor2 = $array[$i+2];
                                $aux = false;
                            }else{
                                $valor2 = $array[$i+1];
                            }
                            $resto = substr($valor2,2);
                            $array[$i+1] = '24' . $resto;
                        }

                        $datetime1 = \DateTime::createFromFormat('H:i', $array[$i]);
                        $datetime2 = \DateTime::createFromFormat('H:i', $array[$i+1]);

                        // Calcular la diferencia
                        $diferencia = $datetime1->diff($datetime2);

                        // Formatear la diferencia
                        $horas = $diferencia->h;
                        $minutos = $diferencia->i;

                        if($horas == 0 && (!array_key_exists($i, $array)) && (!array_key_exists($i+1, $array))){
                            $k = 0;
                            while($k == 0){
                                $i++;
                                $if_val = substr($array[$i], 0, 2);
                                $if_val2 = substr($array[$i+1], 0, 2);
            
                                if(array_key_exists($i+2, $array)){
                                    $if_val3 = substr($array[$i+2], 0, 2);
                                    if($if_val2 == $if_val3){
                                        $aux = true;
                                    }
                                }

                                if($if_val == '00'){
                                    $valor = $array[$i];
                                    $resto = substr($valor,2);
                                    $array[$i] = '24' . $resto;
                                }
                                
                                if($if_val2 == '00'){
                                    if($aux){
                                        $valor2 = $array[$i+2];
                                        $aux = false;
                                    }else{
                                        $valor2 = $array[$i+1];
                                    }
                                    $resto = substr($valor2,2);
                                    $array[$i+1] = '24' . $resto;
                                }
            
                                $datetime1 = \DateTime::createFromFormat('H:i', $array[$i]);
                                $datetime2 = \DateTime::createFromFormat('H:i', $array[$i+1]);
            
                                // Calcular la diferencia
                                $diferencia = $datetime1->diff($datetime2);
            
                                // Formatear la diferencia
                                $horas = $diferencia->h;
                                $minutos = $diferencia->i;

                                if($horas != 0){
                                    $k = 1;
                                }
                            }
                        }

                        $pruebas[] = $array[$i];
                        $pruebas[] = $array[$i+1];

                        $arrHoras[] = $horas;
                        $arrMinutos[] = $minutos;

                    }
                    $total_Horas = array_sum($arrHoras);
                    $total_Minutos = array_sum($arrMinutos);

                    if($total_Horas != 0){
                        Nomina::create([
                            'curp' => $numero_trabajo,
                            'horas' => $total_Horas,
                            'minutos' => $total_Minutos
                        ]);
                    }
                    $arrHoras = [];
                    $arrMinutos = [];
                }

            }
            $array = [];
        }
        
        return redirect()->route('nomina.mostrar')->with('success', 'Archivo procesado correctamente.');
    }

    public function datos_pdf($id){
        $zonaHoraria = 'America/Mexico_City';
        $nomina = Nomina::with('empleado','pivote')->find($id);
        // Obtén la fecha actual en la zona horaria especificada
        Carbon::setLocale('es');
        $fecha_final = Carbon::createFromFormat('Y-m-d H:i:s', $nomina->created_at);
        $fecha_actual = $fecha_final->copy()->subDays(15);

        $fechaFormateada1 = $fecha_actual->isoFormat('D [de] MMMM [del] YYYY');
        $fechaFormateada2 = $fecha_final->isoFormat('D [de] MMMM [del] YYYY');

        $uniformes_nomina = "";

        if($nomina->empleado){
            $empleado_ob = Empleados::where('nombre', 'LIKE' , $nomina->empleado->nombre . '%')->first();
            if($empleado_ob){
                $nomina->nombre_real = $empleado_ob->nombre;
                $salario = $empleado_ob->salario_dia;
            }else{
                $nomina->nombre_real = $nomina->empleado->nombre;
                $salario = 260;
            }
        }else{
            $nomina->nombre_real = 'No existe en base de datos';
        }
        $salario_h = round(($salario/6),2);

        $pdf = Pdf::loadView('PDF.crearNominaPDF',[
            'nomina' => $nomina,
            'fecha' => $fecha_actual,
            'fecha_actual' => $fechaFormateada1,
            'fecha_final' => $fechaFormateada2,
            'salario_d' => $salario,
            'salario_h' => $salario_h,
            ])->setPaper('letter', 'landscape');

        // Nombre del archivo PDF
        $nombreArchivo = 'Nomina_' . $nomina->nombre_real . '.pdf';

        // Devolver la respuesta con el archivo adjunto
        return $pdf->stream($nombreArchivo); 
    }

    private function readExcel($file, $sheetName)
    {
        $spreadsheet = IOFactory::load($file->getPathname());
        $worksheet = $spreadsheet->getSheetByName($sheetName);

        if (!$worksheet) {
            return redirect()->back()->withErrors(['csv_file' => 'No se pudo encontrar la hoja especificada.']);
        }

        $rows = $worksheet->toArray();
        $data = [];

        // Asumimos que la fila 6 contiene los encabezados y los datos comienzan desde la fila 7
        $header = null;
        foreach ($rows as $index => $row) {
            if ($index < 3) {
                continue;
            }
            if ($index == 3) {
                $header = $row;
                continue;
            }
            if ($header) {
                $data[] = array_combine($header, $row);
            }
        }

        return $data;
    }

    public function edit_show($id)
    {
        $nomina = Nomina::with('empleado')->find($id);
        if($nomina->empleado){
            $empleado_ob = Empleados::where('nombre', 'LIKE' , $nomina->empleado->nombre . '%')->first();
            if($empleado_ob){
                $nomina->nombre_real = $empleado_ob->nombre;
            }else{
                $nomina->nombre_real = $nomina->empleado->nombre;
            }
        }else{
            $nomina->nombre_real = 'No existe en base de datos';
        }

        return view('gestion.editNomina',[
            'nomina' => $nomina
        ]);
    }

    public function edit_store(Request $request, $id)
    {
        $nomina = Nomina::find($id);
        $originalValues = $nomina->getOriginal();

        $nomina->horas = $request->horas;
        $nomina->minutos = $request->minutos;
        $nomina->prima_v = $request->prima_v;
        $nomina->festivos = $request->festivos;
        $nomina->descuentos = $request->descuentos;
        $nomina->comida = $request->comida;
        $nomina->prima_d = $request->prima_d;
        $nomina->bonos = $request->bonos;
        $nomina->host = $request->host;
        $nomina->gasolina = $request->gasolina;

        $sueldo_hora = 260 / 6;
        $nomina_f = (($nomina->minutos/60) * $sueldo_hora) + ($nomina->horas * $sueldo_hora) + $nomina->bonos + $nomina->host + $nomina->gasolina
        + $nomina->prima_v + $nomina->festivos + $nomina->prima_d - ($nomina->imss + $nomina->comida + 75.46 + $nomina->descuentos);
        $nomina_total = round($nomina_f, 2); // Redondea a 2 decimales sin formatear
        $nomina->total = $nomina_total;

        $nomina->save();

        // Registrar los cambios en la tabla de auditoría
        $changes = $nomina->getChanges();
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
            'tipo' => 'Nomina',
        ]);

        return redirect()->route('nomina.historico')->with('success', 'Datos editados correctamente.');
    }  

    public function search_total(Request $request){

        $horas = $request->horas;
        $minutos = $request->minutos;
        $primav = $request->primav;
        $festivos = $request->festivos;
        $descuentos = $request->descuentos;
        $comida = $request->comida;
        $primad = $request->primad;
        $bonos = $request->bonos;
        $host = $request->host;
        $gasolina = $request->gasolina;

        $sueldo_hora = 260 / 6;
        $nomina_f = (($minutos/60) * $sueldo_hora) + ($horas * $sueldo_hora) + $bonos + $host + $gasolina
        + $primav + $festivos + $primad - (59.81 + $comida + 75.46 + $descuentos);
        $total = round($nomina_f, 2); // Redondea a 2 decimales sin formatear

        return response()->json([
            'success' => true,
            'total' => $total
        ]);
    }

    public function show_numtrab()
    {
        $trabajadores = NumTrabajo::all();

        return view('gestion.mostrarNumeroTrabajadores',[
            'trabajadores' => $trabajadores
        ]);
    }

    public function store_numtrab(Request $request){
        $this->validate($request, [
        // ... tus reglas de validación ...
            'numero' => 'required',
            'nombre' => 'required',
        ]);

        NumTrabajo::create([
            'numero' => $request->numero,
            'nombre' => $request->nombre,
        ]);

        return redirect()->back()->with('success', 'Registro Guardado');
    }

    public function editshow_numtrab(Request $request, $id){
        $this->validate($request, [
        // ... tus reglas de validación ...
            'numero' => 'required',
            'nombre' => 'required',
        ]);

        $trabajador = NumTrabajo::find($id);
        $trabajador->numero = $request->numero;
        $trabajador->nombre = $request->nombre;
        $trabajador->save();

        return redirect()->back()->with('success', 'Registro Editado con Exito');
    }

    public function search_numtrab(Request $request){
        $numeros = NumTrabajo::all();
        $existe = false;

        $numero = $request->input('numero');
        $nombre = $request->input('nombre');
    
        foreach($numeros as $num){

            // Verificamos si se envió el número
            if ($request->has('numero')) {
                if($num->numero == $numero){
                    $existe = true;
                    break;
                }
            }

            // Verificamos si se envió el número
            if ($request->has('nombre')) {
                if($num->nombre == $nombre){
                    $existe = true;
                    break;
                }
            }      
        }

        return response()->json([
            'success' => true,
            'existe' => $existe
        ]);
    }

    public function delete_numtrab($id){
        NumTrabajo::find($id)->delete();

        return redirect()->back()->with('success', 'Registro Eliminado');
    }
}
