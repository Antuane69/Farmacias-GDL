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
                                    <select name="nombresreg[]" class='form-control js-example-basic-multiple js-states' multiple="multiple">             
                                        @foreach($nombres as $nombre)
                                            <option value="{{$nombre}}">{{$nombre}}</option>
                                        @endforeach
                                    </select>
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
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Agrega este script al final del body o en la sección de scripts de tu vista Blade -->

<script>

    $(document).ready(function() {
        $('.js-example-basic-multiple').select2({
            placeholder: 'Selecciona los que cubrirán tu descanso',
            theme: "classic"
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

        var fechaActual = new Date();
        var diasT = document.getElementById('dias-input').value;

        // Obtener la fecha límite permitida
        var fechalimite = new Date();
        fechalimite.setDate(fechaInput.getDate() + (parseInt(diasT) + 1));

        // Verificar si la fecha elegida está dentro del rango permitido
        if (fechaRegreso > fechalimite) {
            alert("La fecha debe ser la actual o en adelante, hasta tus días de descanso restantes. Se seleccionará la fecha actual.");
            var formattedDate = fechaActual.toISOString().split('T')[0];
            document.getElementById("fechaB").value = formattedDate;
            document.getElementById('dias').value = "";            
        }else{
            var diasTomados = Math.ceil((fechaRegreso - fechaInput) / (1000 * 60 * 60 * 24));
            document.getElementById('dias').value = diasTomados;
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

