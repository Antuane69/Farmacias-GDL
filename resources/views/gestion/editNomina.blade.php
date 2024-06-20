<x-app-layout>
    @section('title', 'Little-Tokyo Administración')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Registro de Nómina (Modo de Edición)") }}
        </h2>
    </x-slot>

    @section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/dataTables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/dataTables/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/customDataTables.css') }}">
    @endsection

    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    </head>
    
    <div class="py-12">
        <div class="mb-10 py-3 ml-16 leading-normal rounded-lg" role="alert">
            <div class="text-left">
                <a href="{{ route('nomina.historico') }}"
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
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl md:rounded-lg">
                <form id="formulario" action={{ route('editarNomina.store', $nomina->id) }} method="POST">
                    @csrf
                    <div class='flex items-center justify-center  md:gap-8 gap-4 pt-3 pb-2 font-bold text-3xl text-slate-700 rounded-t-xl mx-10 mt-5' style="background-color: #FFFF7B">
                        <p>
                            Registro de Nómina (Modo de Edición) 
                        </p>
                    </div>
                    
                    <div class="mb-5 mx-10 px-10 py-5 text-center rounded-b-xl bg-gray-100">
                        <div class="grid grid-cols-3 md:grid-cols-4 gap-5 md:gap-8 mx-7">                    
                            <div class='grid grid-cols-1'>
                                <label for="nombre" class="mb-1 bloack uppercase text-gray-800 font-bold">
                                    Nombre
                                </label>
                                <p>
                                    <input type="text" id="nombre_input" placeholder="Ingresa el nombre del empleado"
                                    class='bg-gray-200 focus:outline-none focus:ring-2 mb-1 focus:border-transparent p-2 px-3 border-2 mt-1 rounded-lg w-5/6'
                                    readonly value="{{$nomina->nombre_real}}">
                                </p>
                            </div>
                            <div class='grid grid-cols-1'>
                                <label for="horas" class="mb-1 bloack uppercase text-gray-800 font-bold">
                                    Horas Totales
                                </label>
                                <p>
                                    <input type="number" name="horas" id="horas_id" placeholder="Ingrese las horas totales trabajadas"
                                    class='focus:outline-none focus:ring-2 mb-1 focus:border-transparent p-2 px-3 border-2 mt-1 rounded-lg w-5/6 @error('horas') border-red-800 bg-red-100 @enderror'
                                    step="0.01" min="0" value="{{$nomina->horas}}" onchange="totalFunction()">
                                    
                                    @error('horas')
                                        <p class="bg-red-600 text-white font-medium my-2 rounded-lg text-sm p-2 text-center">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </p>
                            </div>
                            <div class='grid grid-cols-1'>
                                <label for="minutos" class="mb-1 bloack uppercase text-gray-800 font-bold">
                                    Minutos Totales
                                </label>
                                <p>
                                    <input type="number" name="minutos" id="minutos_id" placeholder="Ingrese los minutos totales trabajados"
                                    class='focus:outline-none focus:ring-2 mb-1 focus:border-transparent p-2 px-3 border-2 mt-1 rounded-lg w-5/6 @error('minutos') border-red-800 bg-red-100 @enderror'
                                    step="0.01" min="0" value="{{$nomina->minutos}}" onchange="totalFunction()">
                                    
                                    @error('minutos')
                                        <p class="bg-red-600 text-white font-medium my-2 rounded-lg text-sm p-2 text-center">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </p>
                            </div>
                            <div class='grid grid-cols-1'>
                                <label for="imss_id" class="mb-1 bloack uppercase text-gray-800 font-bold">
                                    IMSS
                                </label>
                                <p>
                                    <input type="number" name="imss" id="imss_id" placeholder="Ingrese el costo del IMSS"
                                    class='focus:outline-none focus:ring-2 mb-1 focus:border-transparent p-2 px-3 border-2 mt-1 rounded-lg w-5/6 @error('imss') border-red-800 bg-red-100 @enderror'
                                    step="0.01" min="0" value="{{$nomina->imss}}" onchange="totalFunction()">
                                    
                                    @error('imss')
                                        <p class="bg-red-600 text-white font-medium my-2 rounded-lg text-sm p-2 text-center">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </p>
                            </div>
                            <div class='grid grid-cols-1'>
                                <label for="isr_id" class="mb-1 bloack uppercase text-gray-800 font-bold">
                                    ISR
                                </label>
                                <p>
                                    <input type="number" name="isr" id="isr_id" placeholder="Ingrese el costo del ISR"
                                    class='focus:outline-none focus:ring-2 mb-1 focus:border-transparent p-2 px-3 border-2 mt-1 rounded-lg w-5/6 @error('isr') border-red-800 bg-red-100 @enderror'
                                    step="0.01" min="0" value="{{$nomina->isr}}" onchange="totalFunction()">
                                    
                                    @error('isr')
                                        <p class="bg-red-600 text-white font-medium my-2 rounded-lg text-sm p-2 text-center">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </p>
                            </div>
                            <div class='grid grid-cols-1'>
                                <label for="prima_v" class="mb-1 bloack uppercase text-gray-800 font-bold">
                                    Prima Vacacional
                                </label>
                                <p>
                                    <input type="number" name="prima_v" id="primav_id" placeholder="Ingrese la prima vacacional"
                                    class='focus:outline-none focus:ring-2 mb-1 focus:border-transparent p-2 px-3 border-2 mt-1 rounded-lg w-5/6 @error('prima_v') border-red-800 bg-red-100 @enderror'
                                    step="0.01" min="0" value="{{$nomina->prima_v}}" onchange="totalFunction()">
                                    
                                    @error('prima_v')
                                        <p class="bg-red-600 text-white font-medium my-2 rounded-lg text-sm p-2 text-center">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </p>
                            </div>
                            <div class='grid grid-cols-1'>
                                <label for="festivos" class="mb-1 bloack uppercase text-gray-800 font-bold">
                                    Días Festivos
                                </label>
                                <p>
                                    <input type="number" name="festivos" id="festivos_id" placeholder="Ingrese el pago por dias festivos"
                                    class='focus:outline-none focus:ring-2 mb-1 focus:border-transparent p-2 px-3 border-2 mt-1 rounded-lg w-5/6 @error('festivos') border-red-800 bg-red-100 @enderror'
                                    step="0.01" min="0" value="{{$nomina->festivos}}" onchange="totalFunction()">
                                    
                                    @error('festivos')
                                        <p class="bg-red-600 text-white font-medium my-2 rounded-lg text-sm p-2 text-center">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </p>
                            </div>
                            <div class='grid grid-cols-1'>
                                <label for="descuentos" class="mb-1 bloack uppercase text-gray-800 font-bold">
                                    Descuentos Diversos
                                </label>
                                <p>
                                    <input type="number" name="descuentos" id="descuentos_id" placeholder="Ingrese si hay algo que descontar"
                                    class='focus:outline-none focus:ring-2 mb-1 focus:border-transparent p-2 px-3 border-2 mt-1 rounded-lg w-5/6 @error('descuentos') border-red-800 bg-red-100 @enderror'
                                    step="0.01" min="0" value="{{$nomina->descuentos}}" onchange="totalFunction()">
                                    
                                    @error('descuentos')
                                        <p class="bg-red-600 text-white font-medium my-2 rounded-lg text-sm p-2 text-center">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </p>
                            </div>
                            <div class='grid grid-cols-1'>
                                <label for="comida" class="mb-1 bloack uppercase text-gray-800 font-bold">
                                    Comida del Trabajador
                                </label>
                                <p>
                                    <input type="number" name="comida" id="comida_id" placeholder="Ingrese el descuento por comida del trabajador"
                                    class='focus:outline-none focus:ring-2 mb-1 focus:border-transparent p-2 px-3 border-2 mt-1 rounded-lg w-5/6 @error('comida') border-red-800 bg-red-100 @enderror'
                                    step="0.01" min="0" value="{{$nomina->comida}}" onchange="totalFunction()">
                                    
                                    @error('comida')
                                        <p class="bg-red-600 text-white font-medium my-2 rounded-lg text-sm p-2 text-center">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </p>
                            </div>
                            <div class='grid grid-cols-1'>
                                <label for="prima_d" class="mb-1 bloack uppercase text-gray-800 font-bold">
                                    Prima Dominical
                                </label>
                                <p>
                                    <input type="number" name="prima_d" id="primad_id" placeholder="Ingrese la prima dominical"
                                    class='focus:outline-none focus:ring-2 mb-1 focus:border-transparent p-2 px-3 border-2 mt-1 rounded-lg w-5/6 @error('prima_d') border-red-800 bg-red-100 @enderror'
                                    step="0.01" min="0" value="{{$nomina->prima_d}}" onchange="totalFunction()">
                                    
                                    @error('prima_d')
                                        <p class="bg-red-600 text-white font-medium my-2 rounded-lg text-sm p-2 text-center">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </p>
                            </div>
                            <div class='grid grid-cols-1'>
                                <label for="bonos" class="mb-1 bloack uppercase text-gray-800 font-bold">
                                    Bonos Varios
                                </label>
                                <p>
                                    <input type="number" name="bonos" id="bonos_id" placeholder="Ingrese los diversos bonos"
                                    class='focus:outline-none focus:ring-2 mb-1 focus:border-transparent p-2 px-3 border-2 mt-1 rounded-lg w-5/6 @error('bonos') border-red-800 bg-red-100 @enderror'
                                    step="0.01" min="0" value="{{$nomina->bonos}}" onchange="totalFunction()">
                                    
                                    @error('bonos')
                                        <p class="bg-red-600 text-white font-medium my-2 rounded-lg text-sm p-2 text-center">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </p>
                            </div>
                            <div class='grid grid-cols-1'>
                                <label for="host" class="mb-1 bloack uppercase text-gray-800 font-bold">
                                    Dias de Host, etc...
                                </label>
                                <p>
                                    <input type="number" name="host" id="host_id" placeholder="Ingrese bonos por dias de host, etc..."
                                    class='focus:outline-none focus:ring-2 mb-1 focus:border-transparent p-2 px-3 border-2 mt-1 rounded-lg w-5/6 @error('host') border-red-800 bg-red-100 @enderror'
                                    step="0.01" min="0" value="{{$nomina->host}}" onchange="totalFunction()">
                                    
                                    @error('host')
                                        <p class="bg-red-600 text-white font-medium my-2 rounded-lg text-sm p-2 text-center">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </p>
                            </div>
                            <div class='grid grid-cols-1'>
                                <label for="gasolina" class="mb-1 bloack uppercase text-gray-800 font-bold">
                                    Apoyo en Gasolina
                                </label>
                                <p>
                                    <input type="number" name="gasolina" id="gasolina_id" placeholder="Ingrese el apoyo para la gasolina"
                                    class='focus:outline-none focus:ring-2 mb-1 focus:border-transparent p-2 px-3 border-2 mt-1 rounded-lg w-5/6 @error('gasolina') border-red-800 bg-red-100 @enderror'
                                    step="0.01" min="0" value="{{$nomina->gasolina}}" onchange="totalFunction()">
                                    
                                    @error('gasolina')
                                        <p class="bg-red-600 text-white font-medium my-2 rounded-lg text-sm p-2 text-center">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </p>
                            </div>
                            <div class='grid grid-cols-1'>
                                <label for="total" class="mb-1 bloack uppercase text-red-800 font-bold">
                                    Total a Pagar
                                </label>
                                <p>
                                    <input type="number" name="total" id="total_id" placeholder="Ingrese el total a pagar"
                                    class='focus:outline-none focus:ring-red-500 border-red-600 bg-red-100 focus:ring-2 mb-1 focus:border-transparent p-2 px-3 border-2 mt-1 font-bold rounded-lg w-5/6 @error('total') border-red-800 bg-red-100 @enderror'
                                    step="0.01" min="0" value="{{$nomina->total}}">
                                    
                                    @error('total')
                                        <p class="bg-red-600 text-white font-medium my-2 rounded-lg text-sm p-2 text-center">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </p>
                            </div>
                            <div class='grid grid-cols-1'>
                            </div>
                            <div class='grid grid-cols-1'>
                                <div class="flex justify-between">
                                    <button type="submit"
                                    style="height: 74%" class='mr-3 w-1/2 mt-3 bg-green-600 hover:bg-green-700 rounded-lg shadow-xl font-bold text-white px-4 py-2'
                                    >Guardar Cambios</button>
                                    <a href="{{ route('nomina.historico') }}"
                                    style="height: 74%" class='w-1/2 mt-3 content-center text-center justify-center font-bold bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl text-white px-4 py-2'>Cancelar</a>    
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    
    function totalFunction() {
        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
        var SITEURL = "{{ url('/') }}";

        var horas = document.getElementById('horas_id').value;
        var minutos = document.getElementById('minutos_id').value;
        var primav = document.getElementById('primav_id').value;
        var festivos = document.getElementById('festivos_id').value;
        var descuentos = document.getElementById('descuentos_id').value;
        var comida = document.getElementById('comida_id').value;
        var primad = document.getElementById('primad_id').value;
        var bonos = document.getElementById('bonos_id').value;
        var host = document.getElementById('host_id').value;
        var gasolina = document.getElementById('gasolina_id').value;
        var imss = document.getElementById('imss_id').value;
        var isr = document.getElementById('isr_id').value;
        var total = document.getElementById('total_id').value;

        fetch(SITEURL+ `/nomina/buscar/total?horas=${horas}&minutos=${minutos}&primav=${primav}&festivos=${festivos}&descuentos=${descuentos}&comida=${comida}&primad=${primad}&bonos=${bonos}&host=${host}&gasolina=${gasolina}&imss=${imss}&isr=${isr}`, { method: 'get' })
        .then(response => response.json())
        .then(data => {
                document.getElementById('total_id').value = data.total;
            })
            .catch(error => {
                console.error('Error:', error);
            });
    };
</script>

