<x-horarios>

    <style>
        /* Agrega bordes a la tabla */
        #data-table1 {
            border-collapse: collapse;
            width: 100%;
        }
        #data-table1 th, #data-table1 td {
            padding: 8px;
            text-align: center;
            border-left: 1px solid #dddddd;
            border-right: 1px solid #dddddd;
        }
        #data-table1 tr td {
            border-bottom: 1px solid #000000;
        }
    </style>
    
    @section('title', 'Little-Tokyo Administración')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-10">
            {{ __('Asignación de Horario (Cocina)') }}
        </h2>
    </x-slot>

    @section('css')
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/dataTables/css/jquery.dataTables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/dataTables/css/responsive.dataTables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/customDataTables.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endsection

    <div class="py-10">
        <div class="mb-10 py-3 ml-16 leading-normal text-green-500 rounded-lg" role="alert">
            <div class="text-left">
                <a href="{{ route('dashboard') }}"
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
        <div class="mx-auto sm:px-6 lg:px-8" style="width:100 rem;">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-6 mb-3" style="width:100%;">
                @if ($area != '')
                <form id="formulario" action={{ route('horario.store',$area) }} method="POST" enctype="multipart/form-data">
                    @csrf
                    <p class="ml-3 font-bold text-xl mt-6 text-center content-center justify-center mb-4">COCINA</p>
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
                        <button type="submit" id="submitButton"
                            class='w-auto bg-yellow-400 hover:bg-yellow-500 rounded-lg shadow-xl font-bold text-black px-4 py-2'
                            >Crear Plantilla de Cocina</button>
                    </div>
                </form>
                @else
                    <p class="ml-3 font-bold text-xl mt-6 text-center content-center justify-center mb-4">No Se Puede Registrar otro Horario</p>
                    <p class="ml-3 font-bold text-xl mt-6 text-center content-center justify-center mb-4 text-gray-800">Ya se elaboró uno el dia <span class="text-red-700 font-bold">{{$nombres}}</span> y el sistema no permite hacerlos con menos de 6 dias de diferencia.</p>
                @endif
            </div>
        </div>
    </div>
    @section('js')
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

                $('#data-table').dataTable();
            });

        </script>
    @endsection
</x-horarios>