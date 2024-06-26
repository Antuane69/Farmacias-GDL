<x-app-layout>
    @section('title', 'Soporte')
    <x-slot name="header">
        <div class="flex items-center text-center">
            <div class="text-left">
                <a href="{{ route('soporte.mostrar') }}"
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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-6 mt-2">
                {{ __("Levantar Ticket de Soporte") }}
            </h2>
        </div>
    </x-slot>

    @section('css')
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    @endsection
    
    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl md:rounded-lg">
                <form id="formulario" action={{ route('soporte.guardar',$ticket->id) }} method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class='flex items-center justify-center  md:gap-8 gap-4 pt-3 pb-2 font-bold text-3xl text-slate-700 rounded-t-xl mx-10 mt-5' style="background-color: #FFFF7B">
                        <p>
                            Levantar Ticket de Soporte
                        </p>
                    </div>
                    <div class="mb-5 mx-10 px-10 py-5 text-center rounded-b-xl bg-gray-100">
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-5 md:gap-8 mx-7">                    
                            <div  class='grid grid-cols-1'>
                                <label for="fecha_solicitud" class="mb-1 block uppercase text-gray-800 font-bold">* Fecha del Ticket</label>
                                <p>
                                    <input id="fecha" name="fecha_solicitud" class="w-5/6 bg-gray-200 mb-1 p-2 px-3 rounded-lg border-2  mt-1 focus:outline-none focus:ring-2 focus:ring-green-700 focus:border-transparent" type="date" readonly/>
                                </p>
                            </div> 
                            <div class='grid grid-cols-1'>
                                <label for="titulo" class="mb-1 bloack uppercase text-gray-800 font-bold">
                                    * Titulo
                                </label>
                                <p>
                                    <input type="text" name="titulo" class="w-5/6 focus:outline-none focus:ring-2 mb-1 focus:border-transparent p-2 px-3 border-2 mt-1 ml-3 rounded-lg" required placeholder="Ingrese el titulo del ticket"
                                    value="{{$ticket->titulo}}">
                                </p>
                            </div>
                            <div class='grid grid-cols-1'>
                                <label for="descripcion" class="mb-1 bloack uppercase text-gray-800 font-bold">
                                    * Descripción
                                </label>
                                <p>
                                    <textarea name="descripcion" 
                                    class="focus:outline-none focus:ring-2 mb-1 focus:border-transparent p-2 px-3 border-2 mt-1 rounded-lg w-5/6 @error('descripcion') border-red-800 bg-red-100 @enderror" 
                                    required 
                                    placeholder="Escriba el problema">{{ old('descripcion', $ticket->descripcion) }}</textarea>
                            
                                    @error('descripcion')
                                        <p class="bg-red-600 text-white font-medium my-2 rounded-lg text-sm p-2 text-center">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </p>
                            </div>
                            <div class='grid grid-cols-1'>
                                <label for="tipo" class="mb-1 bloack uppercase text-gray-800 font-bold">
                                    * Tipo de Ticket
                                </label>
                                <p>
                                    <select name="tipo" class='w-5/6 mb-1 p-2 px-3 rounded-lg border-2 mt-1 focus:outline-none focus:ring-2 focus:border-transparent' required>             
                                        @if ($ticket->tipo == '')
                                            <option value="" disabled selected>Seleccione una Opción</option>
                                        @endif
                                        @foreach($tipos as $tipo)
                                            @if ($ticket->tipo == $tipo)
                                                <option value="{{$tipo}}" selected>{{$tipo}}</option>
                                            @else
                                                <option value="{{$tipo}}">{{$tipo}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </p>
                            </div>
                            <div class='grid grid-cols-1'>
                                <label for="importancia" class="mb-1 bloack uppercase text-gray-800 font-bold">
                                    * Nivel de Importancia
                                </label>
                                <p>
                                    <select name="urgencia" class='w-5/6 mb-1 p-2 px-3 rounded-lg border-2 mt-1 focus:outline-none focus:ring-2 focus:border-transparent' required>             
                                        @if ($ticket->urgencia == '')
                                            <option value="" disabled selected>Seleccione una Opción</option>
                                        @endif
                                        @foreach($importancias as $importancia)
                                            @if ($ticket->importancia == $importancia)
                                                <option value="{{$importancia}}" selected>{{$importancia}}</option>
                                            @else
                                                <option value="{{$importancia}}">{{$importancia}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </p>
                            </div>

                            <div class='grid grid-cols-1'>
                                <label for="evidencia" class="mb-1 bloack uppercase text-gray-800 font-bold">
                                    Adjuntar Archivo
                                </label>
                                <p>
                                    <input type="file" name="evidencia" class='focus:outline-none w-5/6 focus:ring-2 mb-1 focus:border-transparent p-2 px-3 border-2 mt-1 ml-3 rounded-lg bg-white' accept=".jpg, .jpeg, .png, .pdf" style="border-color:#858585;background-color:#FFFFFF">
                                </p>
                            </div>
                        </div>
                    </div>

                        <div class='flex items-center justify-center  md:gap-8 gap-4 pt-1 pb-5'>
                            <a href="{{ route('dashboard') }}"
                                class='w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Cancelar</a>
                            <button type="submit"
                                class='w-auto bg-yellow-400 hover:bg-yellow-500 rounded-lg shadow-xl font-bold text-black px-4 py-2'
                                >Enviar Ticket</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- Agrega este script al final del body o en la sección de scripts de tu vista Blade -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var date = new Date();

        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();

        if (month < 10) month = "0" + month;
        if (day < 10) day = "0" + day;

        var today = year + "-" + month + "-" + day;
        $("#fecha").attr("value", today);

    });
</script>
