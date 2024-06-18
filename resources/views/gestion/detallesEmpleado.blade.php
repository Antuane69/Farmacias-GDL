<style>
    .inf{
        font-weight: 600;
        font-size: 1.25rem/* 20px */;
        line-height: 1.75rem/* 28px */;
        --tw-text-opacity: 1;
        color: rgb(31 41 55 / var(--tw-text-opacity));
        line-height: 1.25;
    }
    .lbl
    {
        text-transform: uppercase;
        font-size: 0.75rem/* 12px */;
        line-height: 1rem/* 16px */;
        --tw-text-opacity: 1;
        color: rgb(107 114 128 / var(--tw-text-opacity));
        font-weight: 600;
    }
</style>

<x-app-layout>
    @section('title', 'Little-Tokyo Administración')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Información del Empleado') }}
        </h2>
    </x-slot>
    <div class="mt-4 px-4 py-3 ml-11 leading-normal text-green-500 rounded-lg" role="alert">
        <div class="text-left">
            @if (auth()->user()->hasRole('admin'))                
                <a href="{{ route('mostrarEmpleado.show') }}"
                class='w-auto rounded-lg shadow-xl font-medium text-black px-4 py-2'
                style="background:#FFFF7B;text-decoration: none;" onmouseover="this.style.backgroundColor='#FFFF3E'" onmouseout="this.style.backgroundColor='#FFFF7B'">
            @else
                <a href='{{ route('dashboard') }}'
                class='w-auto rounded-lg shadow-xl font-medium text-black px-4 py-2'
                style="background:#FFFF7B;text-decoration: none;" onmouseover="this.style.backgroundColor='#FFFF3E'" onmouseout="this.style.backgroundColor='#FFFF7B'">
            @endif
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
    <div class="pt-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <!--Seccion de información de usuario -->
                    <div class="grid grid-cols-1 col-span-2 bg-gray-600 rounded-t-xl mx-10 mt-5">
                        <h2 class="font-semibold text-xl text-white justify-self-center mt-2 mb-2">Información del Empleado</h2>
                    </div>
                    <div class="grid grid-cols-2 md:flex md:flex-col gap-5 md:gap-8 mb-5 mx-10 px-10 py-10 rounded-b-xl bg-gray-100">
                        <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-5">
                            @if ($empleado->imagen_perfil)                            
                                <div class="w-2/5 mb-5 md:mb-0 ml-20 mt-7" style="width: 220px; height: 280px;">
                                    <label class="lbl md:text-sm">Foto del Empleado:</label>
                                    <img class='md:w-full mt-6' style="width: 200px; height: 260px;border-radius:120px" src="{{ asset('img/gestion/Empleados/' . $empleado->imagen_perfil) }}" alt="Imagen del empleado">
                                </div>
                            @else
                                <div class="w-2/5 mb-5 md:mb-0 ml-20 mt-7" style="width: 260px; height: 280px;">
                                    <label class="lbl md:text-sm">Foto del Empleado:</label>
                                    <img class='rounded-md md:w-full mt-4' style="width: 240px; height: 260px;" src="{{ asset('img/gestion/Empleados/noImage.jpg') }}" alt="Imagen del empleado">
                                </div>
                            @endif
                            <div>
                                <label class="lbl md:text-sm">Nombre:</label>
                                <h2 class="mb-2 inf">{{$empleado->nombre}}</h2>
                                <label class="lbl md:text-sm">Fecha de Nacimiento:</label>
                                <h2 class="mb-2 inf">{{$empleado->fechaNac}}</h2>
                                <label class="lbl md:text-sm">CURP:</label>
                                <h2 class="mb-2 inf">{{$empleado->curp}}</h2>
                                <label class="lbl md:text-sm">RFC:</label>
                                <h2 class="mb-2 inf">{{$empleado->rfc}}</h2>
                                <label class="lbl md:text-sm">NSS:</label>
                                <h2 class="mb-2 inf">{{$empleado->nss}}</h2>
                                <label class="lbl md:text-sm">Número de Clínica del IMSS:</label>
                                <h2 class="mb-2 inf">{{$empleado->num_clinicaSS}}</h2>
                                <label class="lbl md:text-sm">Teléfono:</label>
                                <h2 class="mb-2 inf">{{$empleado->telefono}}</h2>
                            </div>
                        </div>
                    </div>                    
                <!--Información de la Vacante -->
                <div class="grid grid-cols-1 col-span-2 bg-gray-600 rounded-t-xl mx-10">
                    <h2 class="font-semibold text-xl text-white justify-self-center mt-2 mb-2">Información de la Vacante</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mx-10 px-10 py-10 rounded-b-xl bg-gray-100 mb-5">
                    <div class="grid cols-1 ml-20">
                        <label class="lbl md:text-sm">Puesto:</label>
                         <h2 class="inf">{{$empleado->puesto}}</h2>
                    </div>
                    <div class="grid cols-1">
                        <label class="lbl md:text-sm">Salario por Día:</label>
                         <h2 class="inf">{{$empleado->salario_dia}}</h2>
                    </div>
                    <div class="grid cols-1 ml-20">
                        <label class="lbl md:text-sm">Fecha de Ingreso:</label>
                         <h2 class="inf">{{$empleado->fecha}}</h2>
                    </div>
                    <div class="grid cols-1">
                        <label class="lbl md:text-sm">Fecha del Segundo Contrato:</label>
                         <h2 class="inf">{{$empleado->fecha2Contrato}}</h2>
                    </div>
                    <div class="grid cols-1 ml-20">
                        <label class="lbl md:text-sm">Fecha del Tercer Contrato:</label>
                         <h2 class="inf">{{$empleado->fecha3Contrato}}</h2>
                    </div>
                    <div class="grid cols-1">
                        <label class="lbl md:text-sm">Fecha del Contrato Indefinido:</label>
                         <h2 class="inf">{{$empleado->fecha4Contrato}}</h2>
                    </div>
                    <div class="grid cols-1 ml-20">
                        <label class="lbl md:text-sm">Dias de Vacaciones Restantes:</label>
                         <h2 class="inf">{{$empleado->dias_vacaciones}}</h2>
                    </div>
                </div>
                <!-- Documentación -->
                <div class="grid grid-cols-1 col-span-2 bg-gray-600 rounded-t-xl mx-10">
                    <h2 class="font-semibold text-xl text-white justify-self-center mt-2 mb-2">Documentación</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mx-10 px-10 py-10 rounded-b-xl bg-gray-100 mb-5">
                    <div class="grid cols-1 ml-20">
                        <label class="lbl md:text-sm">Carta de No Antecedentes Penales:</label>
                        @if ($empleado->antecedentes != "")
                            <a class="inf text-blue-600 hover:text-blue-800 underline" href="{{ route('empleados.verpdf',['antecedentes', $empleado->id]) }}" target="_blank">{{ $empleado->antecedentes }}</a>
                        @else
                            <p class="text-red-700 hover:text-red-900 underline mt-2">No Hay Archivo Asignado</p>
                        @endif
                    </div>
                    <div class="grid cols-1">
                        <label class="lbl md:text-sm">Carta de Recomendación:</label>
                        @if ($empleado->recomendacion != "")
                            <a class="inf text-blue-600 hover:text-blue-800 underline" href="{{ route('empleados.verpdf',['recomendacion', $empleado->id]) }}" target="_blank">{{ $empleado->recomendacion }}</a>
                        @else
                            <p class="text-red-700 hover:text-red-900 underline mt-2">No Hay Archivo Asignado</p>
                        @endif
                    </div>
                    <div class="grid cols-1 ml-20">
                        <label class="lbl md:text-sm">Comprobante de Estudios:</label>
                        @if ($empleado->estudios != "")
                            <a class="inf text-blue-600 hover:text-blue-800 underline" href="{{ route('empleados.verpdf',['estudios', $empleado->id]) }}" target="_blank">{{ $empleado->estudios }}</a>
                        @else
                            <p class="text-red-700 hover:text-red-900 underline mt-2">No Hay Archivo Asignado</p>
                        @endif
                    </div>
                    <div class="grid cols-1">
                        <label class="lbl md:text-sm">Acta de Nacimiento:</label>
                        @if ($empleado->nacimiento != "")
                            <a class="inf text-blue-600 hover:text-blue-800 underline" href="{{ route('empleados.verpdf',['nacimiento', $empleado->id]) }}" target="_blank">{{ $empleado->nacimiento }}</a>
                        @else
                            <p class="text-red-700 hover:text-red-900 underline mt-2">No Hay Archivo Asignado</p>
                        @endif
                    </div>
                    <div class="grid cols-1 ml-20">
                        <label class="lbl md:text-sm">Comprobante de Domicilio:</label>
                        @if ($empleado->domicilio != "")
                            <a class="inf text-blue-600 hover:text-blue-800 underline" href="{{ route('empleados.verpdf',['domicilio', $empleado->id]) }}" target="_blank">{{ $empleado->domicilio }}</a>
                        @else
                            <p class="text-red-700 hover:text-red-900 underline mt-2">No Hay Archivo Asignado</p>
                        @endif
                    </div>
                    @if (auth()->user()->hasRole('admin'))
                        <div class="grid cols-1">
                            <label class="lbl md:text-sm">Número de INE:</label>
                                <h2 class="inf">{{$empleado->ine}}</h2>
                        </div>
                    @endif
                </div>
                @if (auth()->user()->hasRole('admin'))                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mx-10 px-10 py-10 rounded-b-xl bg-gray-100 mb-5">
                        @if ($empleado->ine_delantera != '')                            
                            <div style="width: 320px; height: 200px;" class='grid cols-1 ml-20'>
                                <label class="lbl md:text-sm">INE Delantera:</label>
                                <a href="{{ asset('img/gestion/Empleados/' . $empleado->ine_delantera) }}" download>
                                    <img class='rounded-md md:w-full mt-4' style="width: 300px; height: 180px;" src="{{ asset('img/gestion/Empleados/' . $empleado->ine_delantera) }}" alt="ine_delantera">
                                </a>
                            </div>
                        @else
                            <div class="grid cols-1 ml-20" style="width: 320px; height: 260px;">
                                <label class="lbl md:text-sm">INE Delantera:</label>
                                <img class='rounded-md md:w-full mt-4' style="width: 300px; height: 240px;" src="{{ asset('img/gestion/Empleados/noImage.jpg') }}" alt="Imagen del empleado">
                            </div>
                        @endif
                        @if ($empleado->ine_trasera != "")                            
                            <div style="width: 320px; height: 200px;" class='grid cols-1 ml-20'>
                                <label class="lbl md:text-sm">INE Trasera:</label>
                                <a href="{{ asset('img/gestion/Empleados/' . $empleado->ine_trasera) }}" download>
                                    <img class='rounded-md md:w-full mt-4' style="width: 300px; height: 180px;" src="{{ asset('img/gestion/Empleados/' . $empleado->ine_trasera) }}" alt="ine_trasera">
                                </a>
                            </div>
                        @else
                            <div class="grid cols-1 ml-20" style="width: 320px; height: 260px;">
                                <label class="lbl md:text-sm">INE Trasera:</label>
                                <img class='rounded-md md:w-full mt-4' style="width: 300px; height: 240px;" src="{{ asset('img/gestion/Empleados/noImage.jpg') }}" alt="Imagen del empleado">
                            </div>
                        @endif
                        @if ($empleado->nomina != "")                            
                            <div style="width: 320px; height: 200px;" class='grid cols-1 ml-20 mt-3'>
                                <label class="lbl md:text-sm">Número de Tarjeta:</label>
                                <a href="{{ asset('img/gestion/Empleados/' . $empleado->nomina) }}" download>
                                    <img class='rounded-md md:w-full mt-4' style="width: 300px; height: 180px;" src="{{ asset('img/gestion/Empleados/' . $empleado->nomina) }}" alt="nomina">
                                </a>
                            </div>
                        @else
                            <div class="grid cols-1 ml-20 mt-3" style="width: 320px; height: 260px;">
                                <label class="lbl md:text-sm">Número de Tarjeta:</label>
                                <img class='rounded-md md:w-full mt-4' style="width: 300px; height: 240px;" src="{{ asset('img/gestion/Empleados/noImage.jpg') }}" alt="Imagen del empleado">
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>