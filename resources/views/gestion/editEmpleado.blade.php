<style>
    .input-container {
        position: relative;
        display: inline-block;
    }
    .input-container input {
        padding-left: 100px; /* Ajusta según sea necesario */
        box-sizing: border-box;
    }
    .input-container::before {
        content: '$';
        position: absolute;
        left: 42px; /* Ajusta según sea necesario */
        top: 50%;
        transform: translateY(-50%);
        color: black; /* Ajusta el color según sea necesario */
    }
</style>
<x-app-layout>
    @section('title', 'Little-Tokyo Administración')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Registro de Empleado (Modo de Edición)") }}
        </h2>
    </x-slot>

    @section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/dataTables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/dataTables/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/customDataTables.css') }}">
    @endsection
    
    <div class="py-12">
        <div class="mb-10 py-3 ml-16 leading-normal rounded-lg" role="alert">
            <div class="text-left">
                <a href="{{ route("mostrarEmpleado.show") }}"
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
                <form id="formulario" action={{ route("editarEmpleado.store",$empleado->id) }} method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class='flex items-center justify-center  md:gap-8 gap-4 pt-3 pb-2 font-bold text-3xl text-slate-700 rounded-t-xl mx-10 mt-5' style="background-color: #FFFF7B">
                            <p>
                                Datos del Empleado (Modo de Edición)
                            </p>
                        </div>
                        
                        <div class="mb-5 mx-10 px-10 py-5 text-center rounded-b-xl bg-gray-100">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mx-7">                    
                                <div class='grid grid-cols-1'>
                                    <label for="nombre" class="mb-1 block uppercase text-gray-800 font-bold">
                                        * Nombre
                                    </label>
                                    <p>
                                        <input type="text" name="nombre" id="nombre" placeholder="Ingresa el nombre del empleado"
                                        class=' focus:outline-none focus:ring-2 mb-1 focus:border-transparent p-2 px-3 border-2 mt-1 rounded-lg w-5/6 @error('nombre') border-red-800 bg-red-100 @enderror'
                                        required value="{{$empleado->nombre}}">
                                        
                                        @error('nombre')
                                            <p class="bg-red-600 text-white font-medium my-2 rounded-lg text-sm p-2 text-center">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </p>
                                </div>
                                <div  class='grid grid-cols-1'>
                                    <label for="fecha_nacimiento" class="mb-1 block uppercase text-gray-800 font-bold">* Fecha de Nacimiento</label>
                                    <p>
                                        <input id="fecha_nacimiento" name="fecha_nacimiento" class="w-5/6 mb-1 p-2 px-3 rounded-lg border-2 mt-1 focus:outline-none focus:ring-2 focus:border-transparent" type="date" required
                                        value="{{$empleado->fecha_nacimiento}}"/>
                                    </p>
                                </div> 
                                <div class='grid grid-cols-1'>
                                    <label for="curp" class="mb-1 block uppercase text-gray-800 font-bold">
                                        * Curp
                                    </label>
                                    <p>
                                        <input type="text" name="curp" id="curp" placeholder="Ingresa el CURP del empleado"
                                        class=' focus:outline-none focus:ring-2 mb-1  focus:border-transparent p-2 px-3 border-2 mt-1 rounded-lg w-5/6 @error('curp') border-red-800 bg-red-100 @enderror'
                                        required value="{{$empleado->curp}}">
                                        
                                        @error('curp')
                                            <p class="bg-red-600 text-white font-medium my-2 rounded-lg text-sm p-2 text-center">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </p>
                                </div>
                                <div class='grid grid-cols-1'>
                                    <label for="rfc" class="mb-1 block uppercase text-gray-800 font-bold">
                                        RFC
                                    </label>
                                    <p>
                                        <input type="text" name="rfc" id="rfc" placeholder="Ingresa el RFC del empleado"
                                        class=' focus:outline-none focus:ring-2 mb-1  focus:border-transparent p-2 px-3 border-2 mt-1 rounded-lg w-5/6 @error('rfc') border-red-800 bg-red-100 @enderror'
                                        value="{{$empleado->rfc}}">
                                        
                                        @error('rfc')
                                            <p class="bg-red-600 text-white font-medium my-2 rounded-lg text-sm p-2 text-center">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </p>
                                </div>
                                <div class='grid grid-cols-1'>
                                    <label for="nss" class="mb-1 block uppercase text-gray-800 font-bold">
                                        NSS 
                                    </label>
                                    <p>
                                        <input type="text" name="nss" id="nss" placeholder="Ingresa el NSS del empleado"
                                        class=' focus:outline-none focus:ring-2 mb-1  focus:border-transparent p-2 px-3 border-2 mt-1 rounded-lg w-5/6 @error('nss') border-red-800 bg-red-100 @enderror'
                                        value="{{$empleado->nss}}">
                                        
                                        @error('nss')
                                            <p class="bg-red-600 text-white font-medium my-2 rounded-lg text-sm p-2 text-center">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </p>
                                </div>
                                <div class='grid grid-cols-1'>
                                    <label for="num_clinicaSS" class="mb-1 block uppercase text-gray-800 font-bold">
                                        Numero de Clinica del IMSS (si aplicase)
                                    </label>
                                    <p>
                                        <input type="number" name="num_clinicaSS" id="num_clinicaSS" placeholder="Ingresa el número de la clinica del IMSS del empleado"
                                        class=' focus:outline-none focus:ring-2 mb-1  focus:border-transparent p-2 px-3 border-2 mt-1 rounded-lg w-5/6 @error('num_clinicaSS') border-red-800 bg-red-100 @enderror'
                                        value="{{$empleado->num_clinicaSS}}">
                                        
                                        @error('num_clinicaSS')
                                            <p class="bg-red-600 text-white font-medium my-2 rounded-lg text-sm p-2 text-center">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </p>
                                </div>
                                <div class='grid grid-cols-1'>
                                    <label for="telefono" class="mb-1 block uppercase text-gray-800 font-bold">
                                        Telefono
                                    </label>
                                    <p>
                                        <input type="text" name="telefono" id="telefono" placeholder="Ingresa el número de telefono del empleado"
                                        class=' focus:outline-none focus:ring-2 mb-1  focus:border-transparent p-2 px-3 border-2 mt-1 rounded-lg w-5/6 @error('telefono') border-red-800 bg-red-100 @enderror'
                                        value="{{$empleado->telefono}}">
                                        
                                        @error('telefono')
                                            <p class="bg-red-600 text-white font-medium my-2 rounded-lg text-sm p-2 text-center">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class='flex items-center justify-center  md:gap-8 gap-4 pt-3 pb-2 font-bold text-3xl text-slate-700 rounded-t-xl mx-10 mt-5' style="background-color: #FFFF7B">
                            <p>
                                Datos de la Vacante (Modo de Edición)
                            </p>
                        </div>
                        
                        <div class="mb-5 mx-10 px-10 py-5 text-center rounded-b-xl bg-gray-100">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mx-7">  
                                <div class='grid grid-cols-1'>
                                    <label for="puesto" class="mb-1 block uppercase text-gray-800 font-bold">
                                        * Puesto
                                    </label>
                                    <p>
                                        <input type="text" name="puesto" id="puesto" placeholder="Ingresa el puesto de trabajo del empleado"
                                        class=' focus:outline-none focus:ring-2 mb-1  focus:border-transparent p-2 px-3 border-2 mt-1 rounded-lg w-5/6 @error('puesto') border-red-800 bg-red-100 @enderror'
                                        required value="{{$empleado->puesto}}">
                                        
                                        @error('puesto')
                                            <p class="bg-red-600 text-white font-medium my-2 rounded-lg text-sm p-2 text-center">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </p>
                                </div>
                                <div class='grid grid-cols-1'>
                                    <label for="salario_dia" class="mb-1 block uppercase text-gray-800 font-bold">
                                        * Salario Diario
                                    </label>
                                    <p>
                                        <div class="input-container">
                                            <input type="number" name="salario_dia" id="salario_dia" placeholder="Ingresa el salario diario del empleado"
                                            class='focus:outline-none focus:ring-2 mb-1  focus:border-transparent p-2 px-3 border-2 mt-1 rounded-lg w-5/6 @error('salario_dia') border-red-800 bg-red-100 @enderror'
                                            value="{{$empleado->salario_dia}}">
                                        </div>
                                        
                                        @error('salario_dia')
                                            <p class="bg-red-600 text-white font-medium my-2 rounded-lg text-sm p-2 text-center">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </p>
                                </div>
                                <div  class='grid grid-cols-1'>
                                    <label for="fecha_ingreso" class="mb-1 block uppercase text-gray-800 font-bold">* Fecha de Ingreso al Empleo </label>
                                    <p>
                                        <input id="fecha" name="fecha_ingreso" class="w-5/6 mb-1 p-2 px-3 rounded-lg border-2  mt-1 focus:outline-none focus:ring-2 focus:ring-green-700 focus:border-transparent" type="date" required
                                        value="{{$empleado->fecha_ingreso}}" onchange="CambiarFecha()"/>
                                    </p>
                                </div> 
                                <div  class='grid grid-cols-1'>
                                    <label for="fecha_2doContrato" class="mb-1 block uppercase text-gray-800 font-bold">* Fecha del 2do. Contrato</label>
                                    <p>
                                        <input id="fechaA" name="fecha_2doContrato" class="w-5/6 bg-gray-200 mb-1 p-2 px-3 rounded-lg border-2  mt-1 focus:outline-none focus:ring-2 focus:ring-green-700 focus:border-transparent" type="text" 
                                        value="{{$empleado->contrato_2}}" readonly/>
                                    </p>
                                </div> 
                                <div  class='grid grid-cols-1'>
                                    <label for="fecha_3erContrato" class="mb-1 block uppercase text-gray-800 font-bold">* Fecha del 3er. Contrato</label>
                                    <p>
                                        <input id="fechaB" name="fecha_3erContrato" class="w-5/6 bg-gray-200 mb-1 p-2 px-3 rounded-lg border-2  mt-1 focus:outline-none focus:ring-2 focus:ring-green-700 focus:border-transparent" type="text" 
                                        value="{{$empleado->contrato_3}}" readonly/>
                                    </p>
                                </div> 
                                <div  class='grid grid-cols-1'>
                                    <label for="fecha_indefinido" class="mb-1 block uppercase text-gray-800 font-bold">* Fecha del Contrato Indefinido</label>
                                    <p>
                                        <input id="fechaC" name="fecha_indefinido" class="bg-gray-200 w-5/6 mb-1 p-2 px-3 rounded-lg border-2  mt-1 focus:outline-none focus:ring-2 focus:ring-green-700 focus:border-transparent" type="text" 
                                        value="{{$empleado->indefinido}}" readonly/>
                                    </p>
                                </div> 
                                <div class='grid grid-cols-1'>
                                    <label for="vacaciones" class="mb-1 bloack uppercase text-gray-800 font-bold">
                                        * Dias de Vacaciones
                                    </label>
                                    <p>
                                        <input type="number" name="vacaciones" id="vacaciones" placeholder="Ingresa los dias de vacaciones del empleado"
                                        class=' focus:outline-none focus:ring-2 mb-1  focus:border-transparent p-2 px-3 border-2 mt-1 rounded-lg w-5/6 @error('vacaciones') border-red-800 bg-red-100 @enderror'
                                        value="{{$empleado->dias_vacaciones}}" required>
                                        
                                        @error('vacaciones')
                                            <p class="bg-red-600 text-white font-medium my-2 rounded-lg text-sm p-2 text-center">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </p>
                                </div>
                            </div>     
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-3 mx-7"> 
                                <div class='grid grid-cols-1' onclick="openInput()" id="imageContainer1">
                                    <label for="imagen_perfil" class="mb-1 block uppercase text-gray-800 font-bold">
                                        Imagen del Empleado
                                    </label>
                                    @if ($empleado->imagen_perfil != '')                            
                                        <div style="width: 200px; height: 260px;" class='bg-white mt-2 text-center border-yellow-200 overflow-hidden mx-auto focus:outline-none focus:ring-2  focus:border-transparent p-2 w-5/6 rounded-lg border-2'>
                                            <img id="imgPreview1" src="{{ asset('/img/gestion/Empleados/' . $empleado->imagen_perfil) }}" style="width: 180px; height: 240px;">
                                        </div>
                                    @else
                                        <div style="width: 240px; height: 260px;" class='bg-white mt-2 text-center border-yellow-200 overflow-hidden mx-auto focus:outline-none focus:ring-2  focus:border-transparent p-2 w-5/6 rounded-lg border-2'>
                                            <img id="imgPreview1" src="{{ asset('img/gestion/Empleados/noImage.jpg') }}" style="width: 220px; height: 240px;">
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mx-7"> 
                                <div class="input-container">
                                    <input type="file" name="imagen_perfil" id="inputContainer1" class='bg-white  mt-4 border-black p-2 w-5/6 rounded-lg border-2' accept=".jpg, .jpeg, .png, .svg" onchange="previewImage(event, '#imgPreview1')">
                                </div>
                            </div>
                        </div>
                        <div class='flex items-center justify-center md:gap-8 gap-4 pt-3 pb-2 font-bold text-3xl text-slate-700 rounded-t-xl mx-10 mt-5' style="background-color: #FFFF7B">
                            <p>
                                Documentación
                            </p>
                        </div>
                        <div class="mb-5 mx-10 px-10 py-5 text-center rounded-b-xl bg-gray-100">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mx-7">                   
                                <div class='grid grid-cols-1'>
                                    <label for="fecha_indefinido" class="mb-1 block uppercase text-gray-800 font-bold">Carta de No Antecedentes penales (PDF)</label>
                                    <input class="w-5/6 mb-1 p-2 px-3 rounded-lg border-2  mt-1 focus:outline-none focus:ring-2 focus:ring-green-700 focus:border-transparent border-black" 
                                    name="antecedentes" type='file' accept=".pdf" style="margin-left: 40px;border-color:#858585;background-color:#FFFFFF"/>
                                    <label class="mt-3 block uppercase text-gray-800 font-bold">Archivo Actual:</label>
                                    @if ($empleado->antecedentes != "")
                                        <a class="text-blue-600 hover:text-blue-800 underline mt-2" href="{{ route('empleados.verpdf',['antecedentes', $empleado->id]) }}" target="_blank">{{ $empleado->antecedentes }}</a>
                                    @else
                                        <p class="text-red-700 hover:text-red-900 underline mt-2">No Hay Archivo Asignado</p>
                                    @endif
                                </div>
                                <div class='grid grid-cols-1'>
                                    <label for="fecha_indefinido" class="mb-1 block uppercase text-gray-800 font-bold">carta de recomendación (PDF)</label>
                                    <input class="w-5/6 mb-1 p-2 px-3 rounded-lg border-2  mt-1 focus:outline-none focus:ring-2 focus:ring-green-700 focus:border-transparent border-black" 
                                    name="recomendacion" type='file' accept=".pdf" style="margin-left: 40px;border-color:#858585;background-color:#FFFFFF"/>
                                    <label class="mt-3 block uppercase text-gray-800 font-bold">Archivo Actual:</label>
                                    @if ($empleado->recomendacion != "")
                                        <a class="text-blue-600 hover:text-blue-800 underline mt-2" href="{{ route('empleados.verpdf',['recomendacion', $empleado->id]) }}" target="_blank">{{ $empleado->recomendacion }}</a>
                                    @else
                                        <p class="text-red-700 hover:text-red-900 underline mt-2">No Hay Archivo Asignado</p>
                                    @endif
                                </div>
                                <div class='grid grid-cols-1'>
                                    <label for="fecha_indefinido" class="mb-1 block uppercase text-gray-800 font-bold">comprobante de estudios (PDF)</label>
                                    <input class="w-5/6 mb-1 p-2 px-3 rounded-lg border-2  mt-1 focus:outline-none focus:ring-2 focus:ring-green-700 focus:border-transparent border-black" 
                                    name="estudios" type='file' accept=".pdf" style="margin-left: 40px;border-color:#858585;background-color:#FFFFFF"/>
                                    <label class="mt-3 block uppercase text-gray-800 font-bold">Archivo Actual:</label>
                                    @if ($empleado->estudios != "")
                                        <a class="text-blue-600 hover:text-blue-800 underline mt-2" href="{{ route('empleados.verpdf',['estudios', $empleado->id]) }}" target="_blank">{{ $empleado->estudios }}</a>
                                    @else
                                        <p class="text-red-700 hover:text-red-900 underline mt-2">No Hay Archivo Asignado</p>
                                    @endif
                                </div>
                                <div class='grid grid-cols-1'>
                                    <label for="fecha_indefinido" class="mb-1 block uppercase text-gray-800 font-bold">acta de nacimiento (PDF)</label>
                                    <input class="w-5/6 mb-1 p-2 px-3 rounded-lg border-2  mt-1 focus:outline-none focus:ring-2 focus:ring-green-700 focus:border-transparent border-black" 
                                    name="nacimiento" type='file' accept=".pdf" style="margin-left: 40px;border-color:#858585;background-color:#FFFFFF"/>
                                    <label class="mt-3 block uppercase text-gray-800 font-bold">Archivo Actual:</label>
                                    @if ($empleado->nacimiento != "")
                                        <a class="text-blue-600 hover:text-blue-800 underline mt-2" href="{{ route('empleados.verpdf',['nacimiento', $empleado->id]) }}" target="_blank">{{ $empleado->nacimiento }}</a>
                                    @else
                                        <p class="text-red-700 hover:text-red-900 underline mt-2">No Hay Archivo Asignado</p>
                                    @endif
                                </div>
                                <div class='grid grid-cols-1'>
                                    <label for="fecha_indefinido" class="mb-1 block uppercase text-gray-800 font-bold">comprobante de domicilio (PDF)</label>
                                    <input class="w-5/6 mb-1 p-2 px-3 rounded-lg border-2  mt-1 focus:outline-none focus:ring-2 focus:ring-green-700 focus:border-transparent border-black" 
                                    name="domicilio" type='file' accept=".pdf" style="margin-left: 40px;border-color:#858585;background-color:#FFFFFF"/>
                                    <label class="mt-3 block uppercase text-gray-800 font-bold">Archivo Actual:</label>
                                    @if ($empleado->domicilio != "")
                                        <a class="text-blue-600 hover:text-blue-800 underline mt-2" href="{{ route('empleados.verpdf',['domicilio', $empleado->id]) }}" target="_blank">{{ $empleado->domicilio }}</a>
                                    @else
                                        <p class="text-red-700 hover:text-red-900 underline mt-2">No Hay Archivo Asignado</p>
                                    @endif
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7"> 
                                <div class='grid grid-cols-1 mt-4' onclick="openInput()" id="imageContainer4">
                                    <label for="nomina" class="mb-1 block uppercase text-gray-800 font-bold">
                                        Número de Tarjeta
                                    </label>
                                    @if ($empleado->nomina != '')                            
                                        <div style="width: 320px; height: 200px;" class='bg-white mt-2 text-center border-yellow-200 overflow-hidden mx-auto focus:outline-none focus:ring-2  focus:border-transparent p-2 w-5/6 rounded-lg border-2'>
                                            <img id="imgPreview4" src="{{ asset('/img/gestion/Empleados/' . $empleado->nomina) }}" style="width: 300px; height: 180px;">
                                        </div>
                                    @else
                                        <div style="width: 320px; height: 200px;" class='bg-white mt-2 text-center border-yellow-200 overflow-hidden mx-auto focus:outline-none focus:ring-2  focus:border-transparent p-2 w-5/6 rounded-lg border-2'>
                                            <img id="imgPreview4" src="{{ asset('img/gestion/Empleados/noImage.jpg') }}" style="width: 300px; height: 180px;">
                                        </div>
                                    @endif
                                </div>

                                <div class='grid grid-cols-1 mt-4' onclick="openInput()" id="imageContainer2">
                                    <label for="ine_delantera" class="mb-1 block uppercase text-gray-800 font-bold">
                                        Imagen de la INE (Frente)
                                    </label>
                                    @if ($empleado->ine_delantera != '')                            
                                        <div style="width: 320px; height: 200px;" class='bg-white mt-2 text-center border-yellow-200 overflow-hidden mx-auto focus:outline-none focus:ring-2  focus:border-transparent p-2 w-5/6 rounded-lg border-2'>
                                            <img id="imgPreview2" src="{{ asset('/img/gestion/Empleados/' . $empleado->ine_delantera) }}" style="width: 300px; height: 180px;">
                                        </div>
                                    @else
                                        <div style="width: 320px; height: 200px;" class='bg-white mt-2 text-center border-yellow-200 overflow-hidden mx-auto focus:outline-none focus:ring-2  focus:border-transparent p-2 w-5/6 rounded-lg border-2'>
                                            <img id="imgPreview2" src="{{ asset('img/gestion/Empleados/noImage.jpg') }}" style="width: 300px; height: 180px;">
                                        </div>
                                    @endif
                                </div>

                                <div class='grid grid-cols-1'>
                                    <div class="input-container2">
                                        <input type="file" name="ine_delantera" id="inputContainer2" class='bg-white mt-2 border-black p-2 w-5/6 rounded-lg border-2' accept=".jpg, .jpeg, .png, .svg" onchange="previewImage(event, '#imgPreview2')" style="40px;border-color:#858585;background-color:#FFFFFF">
                                    </div>
                                </div>    
                                
                                <div class='grid grid-cols-1'>
                                    <div class="input-container3">
                                        <input type="file" name="ine_trasera" id="inputContainer3" class='bg-white mt-2 border-black p-2 w-5/6 rounded-lg border-2' accept=".jpg, .jpeg, .png, .svg" onchange="previewImage(event, '#imgPreview3')" style="40px;border-color:#858585;background-color:#FFFFFF">
                                    </div>
                                </div>
                                <div class='grid grid-cols-1' onclick="openInput()" id="imageContainer3">
                                    <label for="ine_trasera" class="mb-1 block uppercase text-gray-800 font-bold">
                                        Imagen de la INE (Trasera)
                                    </label>
                                    @if ($empleado->ine_trasera != '')                            
                                        <div style="width: 320px; height: 200px;" class='bg-white mt-2 text-center border-yellow-200 overflow-hidden mx-auto focus:outline-none focus:ring-2  focus:border-transparent p-2 w-5/6 rounded-lg border-2'>
                                            <img id="imgPreview3" src="{{ asset('/img/gestion/Empleados/' . $empleado->ine_trasera) }}" style="width: 300px; height: 180px;">
                                        </div>
                                    @else
                                        <div style="width: 320px; height: 200px;" class='bg-white mt-2 text-center border-yellow-200 overflow-hidden mx-auto focus:outline-none focus:ring-2  focus:border-transparent p-2 w-5/6 rounded-lg border-2'>
                                            <img id="imgPreview3" src="{{ asset('img/gestion/Empleados/noImage.jpg') }}" style="width: 300px; height: 180px;">
                                        </div>
                                    @endif
                                </div>
                                <div class='grid grid-cols-1'>
                                </div>
                                <div class='grid grid-cols-1'>
                                    <div class="input-container4">
                                        <input type="file" name="nomina" id="inputContainer4" class='bg-white mt-2 border-black p-2 w-5/6 rounded-lg border-2' accept=".jpg, .jpeg, .png, .svg" onchange="previewImage(event, '#imgPreview4')" style="40px;border-color:#858585;background-color:#FFFFFF">
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7"> 
                                <div class='grid grid-cols-1 mt-4'>
                                    <label for="ine" class="mb-1 block uppercase text-gray-800 font-bold">
                                        Número de INE
                                    </label>
                                    <p>
                                        <input type="number" name="ine" id="ine" placeholder="Ingresa el número de INE del empleado"
                                        class=' focus:outline-none focus:ring-2 mb-1  focus:border-transparent p-2 px-3 border-2 mt-1 rounded-lg w-5/6 @error('nomina') border-red-800 bg-red-100 @enderror'
                                        value="{{$empleado->ine}}">
                                        
                                        @error('ine')
                                            <p class="bg-red-600 text-white font-medium my-2 rounded-lg text-sm p-2 text-center">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class='flex items-center justify-center  md:gap-8 gap-4 pt-1 pb-5'>
                            <a href="{{ route('mostrarEmpleado.show') }}"
                                class='w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Cancelar</a>
                            <button type="submit"
                                class='w-auto bg-green-600 hover:bg-green-700 rounded-lg shadow-xl font-bold text-white px-4 py-2'
                                >Guardar Cambios</button>
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
    document.addEventListener('DOMContentLoaded', function () {
        setupImageContainer('imageContainer1','inputContainer1');
        setupImageContainer('imageContainer2','inputContainer2');
        setupImageContainer('imageContainer3','inputContainer3');
        setupImageContainer('imageContainer4','inputContainer4');
        // Puedes agregar más llamadas a setupImageContainer para otros divs
    });

    function setupImageContainer(containerId,inputID) {
        var imageContainer = document.getElementById(containerId);
        var fileInput = document.getElementById(inputID);

        imageContainer.addEventListener('click', function () {
            fileInput.click(); // Simula un clic en el input de tipo file
        });
    }

    function previewImage(event, querySelector){

        //Recuperamos el input que desencadeno la acción
        const input = event.target;

        //Recuperamos la etiqueta img donde cargaremos la imagen
        $imgPreview = document.querySelector(querySelector);

        // Verificamos si existe una imagen seleccionada
        if(!input.files.length) return

        //Recuperamos el archivo subido
        file = input.files[0];

        //Creamos la url
        objectURL = URL.createObjectURL(file);

        //Modificamos el atributo src de la etiqueta img
        $imgPreview.src = objectURL;
                
    }

    // Función para sumar 30 días a una fecha
    function CambiarFecha() {
        var fechaInput = document.getElementById('fecha').value;
        var fechaInicial = new Date(fechaInput);

        var ndoContrato = fechaInicial.setDate(fechaInicial.getDate() + 31);
        var ndoContratoF = new Date(ndoContrato);
        var terContrato = ndoContratoF.setDate(ndoContratoF.getDate() + 31);
        var terContratoF = new Date(terContrato);
        var indefinido = terContratoF.setDate(terContratoF.getDate() + 31);

        var date = new Date(ndoContrato);
        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();

        if (month < 10) month = "0" + month;
        if (day < 10) day = "0" + day;
        var today = day + '/' + month + "/" + year;


        var date = new Date(terContrato);
        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();

        if (month < 10) month = "0" + month;
        if (day < 10) day = "0" + day;
        var today2 = day + '/' + month + "/" + year;


        var date = new Date(indefinido);
        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();

        if (month < 10) month = "0" + month;
        if (day < 10) day = "0" + day;
        var today3 = day + '/' + month + "/" + year;


        document.getElementById('fechaA').value = today;
        document.getElementById('fechaB').value = today2;
        document.getElementById('fechaC').value = today3;
    }

</script>
