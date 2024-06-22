<x-app-layout>
    @section('title', 'Little-Tokyo Administración')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Crear Registro de Vacación") }}
        </h2>
    </x-slot>

    @section('css')
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/dataTables/css/jquery.dataTables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/dataTables/css/responsive.dataTables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/customDataTables.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endsection
    
    <div class="py-12">
        <div class="mb-10 py-3 ml-16 leading-normal rounded-lg" role="alert">
            <div class="text-left">
                <a href="{{ route('empleadosInicio.show') }}"
                class='w-auto rounded-lg shadow-xl font-medium text-black px-4 py-2'
                style="background:#FFFF7B;text-decoration: none;" onmouseover="this.style.backgroundColor='#FFFF3E'" onmouseout="this.style.backgroundColor='#FFFF7B'">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-flex" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z"
                        clip-rule="evenodd" />
                </svg>
                Regresar
                </a>
            </div>
        </div>
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl md:rounded-lg">
                <form id="formulario" action={{ route('crearVacacion.store') }} method="POST">
                    @csrf
                    <div class='flex items-center justify-center  md:gap-8 gap-4 pt-3 pb-2 font-bold text-3xl text-slate-700 rounded-t-xl mx-10 mt-5' style="background-color: #FFFF7B">
                        <p>
                            Registro de Vacacaciones
                        </p>
                    </div>
                    
                    <div class="mb-5 mx-10 px-10 py-5 text-center rounded-b-xl bg-gray-100">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mx-7">                    
                            <div class='grid grid-cols-1'>
                                <label for="nombre" class="mb-1 bloack uppercase text-gray-800 font-bold">
                                    * Nombre
                                </label>
                                @if (auth()->user()->hasRole('admin')||auth()->user()->hasRole('coordinador'))                                    
                                    <p>
                                        <input type="text" id="nombre_input" placeholder="Ingresa el nombre del empleado"
                                        class=' focus:outline-none focus:ring-2 mb-1 focus:border-transparent p-2 px-3 border-2 mt-1 rounded-lg w-5/6'
                                        required>
                                    </p>
                                @else
                                    <p>
                                        <input type="text" id="nombre_input" placeholder="Ingresa el nombre del empleado"
                                        class='bg-gray-200 focus:outline-none focus:ring-2 mb-1 focus:border-transparent p-2 px-3 border-2 mt-1 rounded-lg w-5/6'
                                        required readonly value="{{auth()->user()->nombre}}">
                                    </p>
                                @endif
                            </div>
                            <div class='grid grid-cols-1'>
                                <label for="curp" class="mb-1 bloack uppercase text-gray-800 font-bold">
                                    * Curp
                                </label>
                                <p>
                                    <input type="text" name="curp" id="curp-input" placeholder="No se ha encontrado al empleado"
                                    class=' focus:outline-none focus:ring-2 mb-1  focus:border-transparent p-2 px-3 border-2 mt-1 bg-gray-200 rounded-lg w-5/6 @error('curp') border-red-800 bg-red-100 @enderror'
                                    readonly required>
                                    
                                    @error('curp')
                                        <p class="bg-red-600 text-white font-medium my-2 rounded-lg text-sm p-2 text-center">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </p>
                            </div>
                            <div  class='grid grid-cols-1'>
                                <label for="fecha_ingreso" class="mb-1 bloack uppercase text-gray-800 font-bold">* Fecha de Ingreso</label>
                                <p>
                                    <input id="fechaingreso-input" name="fecha_ingreso" placeholder="No se ha encontrado al empleado"
                                    class="w-5/6 mb-1 p-2 px-3 rounded-lg border-2 mt-1 focus:outline-none focus:ring-2 focus:border-transparent bg-gray-200" type="text" readonly/>
                                </p>
                            </div> 
                            <div  class='grid grid-cols-1'>
                                <label for="dias_vacaciones" class="mb-1 bloack uppercase text-gray-800 font-bold">* Dias de Vacaciones</label>
                                <p>
                                    <input id="dias-input" name="dias_vacaciones" placeholder="No se ha encontrado al empleado"
                                    class="w-5/6 mb-1 p-2 px-3 rounded-lg border-2 mt-1 focus:outline-none focus:ring-2 focus:border-transparent bg-gray-200" type="text" readonly/>
                                </p>
                            </div> 
                            <div  class='grid grid-cols-1'>
                                <label for="fecha_solicitud" class="mb-1 bloack uppercase text-gray-800 font-bold">* Fecha de la Solicitud</label>
                                <p>
                                    <input id="fecha" name="fecha_solicitud" class="w-5/6 mb-1 p-2 px-3 rounded-lg border-2  mt-1 focus:outline-none focus:ring-2 focus:ring-green-700 focus:border-transparent" type="date" />
                                </p>
                            </div> 
                            <div  class='grid grid-cols-1'>
                                <label for="fecha_inicioVac" class="mb-1 bloack uppercase text-gray-800 font-bold">* Fecha de inicio de las vacaciones</label>
                                <p>
                                    <input id="fechaA" name="fecha_inicioVac" class="w-5/6 mb-1 p-2 px-3 rounded-lg border-2  mt-1 focus:outline-none focus:ring-2 focus:ring-green-700 focus:border-transparent" type="date" onchange="validarDias()"/>
                                </p>
                            </div> 
                            <div  class='grid grid-cols-1'>
                                <label for="fecha_regresoVac" class="mb-1 bloack uppercase text-gray-800 font-bold">* Fecha fin de las vacaciones</label>
                                <p>
                                    <input id="fechaB" name="fecha_regresoVac" class="w-5/6 mb-1 p-2 px-3 rounded-lg border-2  mt-1 focus:outline-none focus:ring-2 focus:ring-green-700 focus:border-transparent" type="date" onchange="validarFecha()"/>
                                </p>
                            </div> 
                            <div  class='grid grid-cols-1'>
                                <label for="diasTomados" class="mb-1 bloack uppercase text-gray-800 font-bold">* Dias a Usar</label>
                                <p>
                                    <input id="dias" name="diasTomados" placeholder="La fecha no es correcta"
                                    class="w-5/6 mb-1 p-2 px-3 rounded-lg border-2 mt-1 focus:outline-none focus:ring-2 focus:border-transparent bg-gray-200" type="text" readonly/>
                                </p>
                            </div> 
                            <div class='grid grid-cols-1'>
                                <label for="nombre" class="mb-1 bloack uppercase text-gray-800 font-bold">
                                    * Cubriran el descanso
                                </label>
                                <p>
                                    <button type="button" class='w-auto bg-green-700 hover:bg-green-800 rounded-lg shadow-xl font-bold text-white px-4 py-2 mt-2' id="opcionesButton" data-bs-toggle="modal" data-bs-target="#exampleModal">Registrar Suplentes</button>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class='flex items-center justify-center  md:gap-8 gap-4 pt-1 pb-5'>
                        <a href="{{ route('empleadosInicio.show') }}"
                            class='w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Cancelar</a>
                        <button type="submit" id="enviar-button"
                            hidden class='w-auto bg-yellow-400 hover:bg-yellow-500 rounded-lg shadow-xl font-bold text-black px-4 py-2'
                            >Registrar Vacaciones</button>
                        <p id="message-id" class="text-red-800 font-bold mt-1" hidden>
                            Dias asignados a otro trabajador de su área, intente otra fecha.
                        </p>   
                    </div>
                </form>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content" style="width: 1800px; min-height: 850px;">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Registrar Horario Cocina</h5>
                                <button type="button" class="rounded bg-yellow-500 hover:bg-yellow-700 text-white font-bold px-1 p-1" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                            <div class="modal-body">
                                <form id="formulario_horario" method="POST" enctype="multipart/form-data">
                                @csrf
                                    <div class="text-center">
                                        <table id="data-table" class="stripe hover translate-table data-table pb-3 mb-4"
                                            style="width:100%; padding-top: 1em;  padding-bottom: 2em;">
                                            <thead>
                                                <tr>
                                                    <th class='text-center'></th>
                                                    <th class='text-center'>Lunes</th>
                                                    <th class='text-center'>Martes</th>
                                                    <th class='text-center'>Miércoles</th>
                                                    <th class='text-center'>Jueves</th>
                                                    <th class='text-center'>Viernes</th>
                                                    <th class='text-center'>Sábado</th>
                                                    <th class='text-center'>Domingo</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <p class="hidden">{{$aux = 1}}</p>
                                                @for ($k = 0;$k<4;$k++)
                                                <tr>    
                                                    @if ($k == 0)
                                                        <td align="center" class="font-bold">
                                                            10-00 AM a 18-00 PM
                                                        </td>
                                                    @elseif ($k == 1)
                                                        <td align="center" class="font-bold">
                                                            14-00 PM a 00-00 AM
                                                        </td>
                                                    @elseif ($k == 2)
                                                        <td align="center" class="font-bold">
                                                            18-00 PM a 00-00 AM
                                                        </td>
                                                    @else
                                                        <td align="center" class="font-bold">
                                                            Descansos
                                                        </td>
                                                    @endif
                                                    <td align="center" class="font-bold">
                                                        <select name="cocinerolunes{{$k}}[]" class='form-control js-example-basic-multiple js-states' multiple="multiple"
                                                            data-minimum-selection-length="{{$arregloCocina[$k]['lunes']}}">             
                                                            @foreach($nombres as $nombre)
                                                                <option value="{{$nombre}}">{{$nombre}}</option>
                                                            @endforeach
                                                        </select>
                                                        <p class="mt-2 text-sm font-semibold text-center content-center justify-center">Mínimo: {{$arregloCocina[$k]['lunes']}}</p>
                                                    </td>
                                                    <td align="center" class="font-bold">
                                                        <select name="cocineromartes{{$k}}[]" class='form-control js-example-basic-multiple js-states' multiple="multiple"
                                                            data-minimum-selection-length="{{$arregloCocina[$k]['martes']}}">             
                                                            @foreach($nombres as $nombre2)
                                                                <option value="{{$nombre2}}">{{$nombre2}}</option>
                                                            @endforeach
                                                        </select>
                                                        <p class="mt-2 text-sm font-semibold text-center content-center justify-center">Mínimo: {{$arregloCocina[$k]['martes']}}</p>
                                                    </td>
                                                    <td align="center" class="font-bold">
                                                        <select name="cocineromiercoles{{$k}}[]" class='form-control js-example-basic-multiple js-states' multiple="multiple"
                                                            data-minimum-selection-length="{{$arregloCocina[$k]['miercoles']}}">             
                                                            @foreach($nombres as $nombre3)
                                                                <option value="{{$nombre3}}">{{$nombre3}}</option>
                                                            @endforeach
                                                        </select>
                                                        <p class="mt-2 text-sm font-semibold text-center content-center justify-center">Mínimo: {{$arregloCocina[$k]['miercoles']}}</p>
                                                    </td>
                                                    <td align="center" class="font-bold">
                                                        <select name="cocinerojueves{{$k}}[]" class='form-control js-example-basic-multiple js-states' multiple="multiple"
                                                            data-minimum-selection-length="{{$arregloCocina[$k]['jueves']}}">             
                                                            @foreach($nombres as $nombre4)
                                                                <option value="{{$nombre4}}">{{$nombre4}}</option>
                                                            @endforeach
                                                        </select>
                                                        <p class="mt-2 text-sm font-semibold text-center content-center justify-center">Mínimo: {{$arregloCocina[$k]['jueves']}}</p>
                                                    </td>
                                                    <td align="center" class="font-bold">
                                                        <select name="cocineroviernes{{$k}}[]" class='form-control js-example-basic-multiple js-states' multiple="multiple"
                                                            data-minimum-selection-length="{{$arregloCocina[$k]['viernes']}}">             
                                                            @foreach($nombres as $nombre5)
                                                                <option value="{{$nombre5}}">{{$nombre5}}</option>
                                                            @endforeach
                                                        </select>
                                                        <p class="mt-2 text-sm font-semibold text-center content-center justify-center">Mínimo: {{$arregloCocina[$k]['viernes']}}</p>
                                                    </td>
                                                    <td align="center" class="font-bold">
                                                        <select name="cocinerosabado{{$k}}[]" class='form-control js-example-basic-multiple js-states' multiple="multiple"
                                                            data-minimum-selection-length="{{$arregloCocina[$k]['sabado']}}">             
                                                            @foreach($nombres as $nombre6)
                                                                <option value="{{$nombre6}}">{{$nombre6}}</option>
                                                            @endforeach
                                                        </select>
                                                        <p class="mt-2 text-sm font-semibold text-center content-center justify-center">Mínimo: {{$arregloCocina[$k]['sabado']}}</p>
                                                    </td>
                                                    @if ($aux == 1)                                    
                                                        <td align="center" class="font-bold" rowspan="3">
                                                            <select name="cocinerodomingo{{$k}}[]" class='form-control js-example-basic-multiple js-states' multiple="multiple"
                                                                data-minimum-selection-length="{{$arregloCocina[0]['domingo']}}">             
                                                                @foreach($nombres as $nombre7)
                                                                    <option value="{{$nombre7}}">{{$nombre7}}</option>
                                                                @endforeach
                                                            </select>
                                                            <p class="mt-2 text-sm font-semibold text-center content-center justify-center">Mínimo: {{$arregloCocina[0]['domingo']}}</p>
                                                        </td>
                                                        <p class="hidden">{{$aux = 0}}</p>
                                                    @elseif ($k == 3)
                                                        <td align="center" class="font-bold">
                                                            <select name="cocinerodomingo3[]" class='form-control js-example-basic-multiple js-states' multiple="multiple"
                                                                data-minimum-selection-length="{{$arregloCocina[3]['domingo']}}">             
                                                                @foreach($nombres as $nombre8)
                                                                    <option value="{{$nombre8}}">{{$nombre8}}</option>
                                                                @endforeach
                                                            </select>
                                                            <p class="mt-2 text-sm font-semibold text-center content-center justify-center">Mínimo: {{$arregloCocina[3]['domingo']}}</p>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <div class="hidden">
                                                                <select name="cocinerodomingo{{$k}}[]" class='form-control js-example-basic-multiple js-states' multiple="multiple">             
                                                                    <option value="" selected></option>
                                                                    @foreach($nombres as $nombre8)
                                                                        <option value="{{$nombre8}}">{{$nombre8}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </td>
                                                    @endif
                                                </tr> 
                                                @endfor
                                            </tbody>
                                        </table>
                                        <div class='flex items-center justify-center  md:gap-8 gap-4 pt-1 pb-5'>
                                            <button type="button" id="enviarFormulario"
                                                class='w-auto bg-yellow-400 hover:bg-yellow-500 rounded-lg shadow-xl font-bold text-black px-4 py-2'
                                                >Crear Plantilla de Cocina</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</x-app-layout>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="{{ asset('plugins/jquery/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('plugins/dataTables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/dataTables/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('js/customDataTables.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/plug-ins/1.12.1/filtering/type-based/accent-neutralise.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>

    $(document).ready(function() {
        $('#data-table').dataTable();

        $('.js-example-basic-multiple').select2({
            placeholder: 'Selecciona los Encargados',
            theme: "classic",
            minimumResultsForSearch: 1
        });
    
        $('#submitButton').click(function(event) {
            var valid = true;
            $('.js-example-basic-multiple').each(function() {
                if ($(this).val().length < $(this).data('minimum-selection-length')) {
                    valid = false;
                }
            });
    
            if (!valid) {
                alert('Por favor, selecciona al menos el número mínimo de trabajadores por turno.');
                event.preventDefault(); // Evitar el envío del formulario si la validación falla
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
        var SITEURL = "{{ url('/') }}";

        var nombreInput = document.getElementById('nombre_input');
        var curpInput = document.getElementById('curp-input');
        var fechaIngresoInput = document.getElementById('fechaingreso-input');
        var diasInput = document.getElementById('dias-input');

        function busquedaRPE() {
            var inputValue = nombreInput.value;
            buscarRPE(inputValue);
        }

        nombreInput.addEventListener("input", busquedaRPE);

        buscarRPE(nombreInput.value);

        function buscarRPE(nombre) {
            if (nombre.length > 1) {
                fetch(`${SITEURL}/gestion/registrarVacaciones/buscar?nombre=${nombre}`, { method: 'get' })
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById("curp-input").value = data.empleado.curp;
                        document.getElementById("fechaingreso-input").value = data.empleado.fecha_ingreso;
                        document.getElementById("dias-input").value = data.empleado.dias_vacaciones;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        curpInput.value = "";
                        fechaIngresoInput.value = "";
                        diasInput.value = "";
                    });
            } else {
                // Si el nombre está vacío, borrar la información de curp y fecha de ingreso
                curpInput.value = "";
                fechaIngresoInput.value = "";
                diasInput.value = "";
            }
        }
    });

    //Obtener el día actual. 
    $(document).ready(function() {
        var date = new Date();

        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();

        if (month < 10) month = "0" + month;
        if (day < 10) day = "0" + day;

        var today = year + "-" + month + "-" + day;
        $("#fecha").attr("value", today);
        $("#fechaA").attr("value", today);
        $("#fechaB").attr("value", today);
        $("#fecha").attr("max", today);
    });

    $("#fecha").datepicker({
        dateFormat: 'dd-mm-yy'
    });
    $("#fechaA").datepicker({
        dateFormat: 'dd-mm-yy'
    });

    function validarFecha() {
        var fechaInput = new Date(document.getElementById("fechaA").value);
        var fechaRegreso = new Date(document.getElementById("fechaB").value);
        
        // Restablecer las horas para evitar errores de comparación
        fechaInput.setHours(0, 0, 0, 0);
        fechaRegreso.setHours(0, 0, 0, 0);

        var fechaActual = new Date();
        fechaActual.setHours(0, 0, 0, 0);
        var diasT = parseInt(document.getElementById('dias-input').value);

        // Obtener la fecha límite permitida
        var fechalimite = new Date(fechaInput);
        fechalimite.setDate(fechaInput.getDate() + diasT);

        var diferenteMes = (fechaInput.getMonth() !== fechaRegreso.getMonth() || fechaInput.getFullYear() !== fechaRegreso.getFullYear());
        console.log(diferenteMes);

        var diasTomados = Math.ceil((fechaRegreso - fechaInput) / (1000 * 60 * 60 * 24));
        document.getElementById('dias').value = diasTomados;
        if(diferenteMes == false && diasTomados <= 0){
            alert("La fecha debe ser la actual o en adelante, hasta tus días de descanso restantes. Se seleccionará la fecha actual.");
            var formattedDate = fechaActual.toISOString().split('T')[0];
            document.getElementById("fechaB").value = formattedDate;
            document.getElementById('dias').value = "";
            document.getElementById('enviar-button').hidden = false;
            document.getElementById('message-id').hidden = true;
        }else{
            vacacionesCheck();
        }
    }

    function validarDias(){
        var fechaInput = new Date(document.getElementById("fechaA").value);
        var fechaRegreso = new Date(document.getElementById("fechaB").value);

        var diasTomados = Math.ceil((fechaRegreso - fechaInput) / (1000 * 60 * 60 * 24));
        document.getElementById('dias').value = diasTomados;

        vacacionesCheck();
    }

    function vacacionesCheck(){
        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
        var SITEURL = "{{ url('/') }}";

        var curp = document.getElementById('curp-input').value;
        var inicio = document.getElementById('fechaA').value;
        var regreso = document.getElementById('fechaB').value;

        fetch(SITEURL+ `/gestion/vacacionesCheck?curp=${curp}&inicio=${inicio}&regreso=${regreso}`, { method: 'get' })
            .then(response => response.json())
            .then(data => {
                if(data.enviar == true){
                    document.getElementById('enviar-button').hidden = false;
                    document.getElementById('message-id').hidden = true;
                }else{
                    document.getElementById('enviar-button').hidden = true;
                    document.getElementById('message-id').hidden = false;
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Obtener referencia al botón de enviar formulario
        const enviarBtn = document.getElementById('enviarFormulario');

        // Escuchar el evento click en el botón
        enviarBtn.addEventListener('click', function() {
            // Obtener referencia al formulario
            const formulario = document.getElementById('formulario_horario');

            // Obtener los datos del formulario
            const formData = new FormData(formulario);

            // Obtener el área del usuario actual
            const area = '{{ auth()->user()->puesto }}'; // Asegúrate de usar el campo correcto según tu modelo de usuario
 
            // Construir la URL con el parámetro area
            var url = `{{ route("horario.vacacionStore", [':area']) }}`;
            url = url.replace(':area', area);

            // Configurar opciones para la solicitud fetch
            const opcionesFetch = {
                method: 'POST', // Método HTTP
                body: formData, // Datos del formulario
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Token CSRF para Laravel
                }
            };

            // Realizar la solicitud fetch
            fetch(url, opcionesFetch)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Hubo un problema al enviar el formulario.');
                    }
                    return response.json(); // Convertir respuesta a JSON
                })
                .then(data => {
                    alert('Horario Registrado con Éxito. De click al boton de cerrar modal para continuar.');
                })
                .catch(error => {
                    alert('Ocurrió un error al enviar el formulario. Intente nuevamente.');
                });
        });
    });
</script>

