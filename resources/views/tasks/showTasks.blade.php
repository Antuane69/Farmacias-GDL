<style>
    #data-table {
        border-collapse: collapse;
        width: 100%;
    }
    #data-table th, #data-table td {
        padding: 8px;
        text-align: center;
        border-left: 1px solid #dddddd;
        border-right: 1px solid #dddddd;
    }
    #data-table tr td {
        border-bottom: 1px solid #000000;
    }

    .boton_editar{
        align-items: center;
        justify-content: center;
        color: black;
        padding: 10px;
        border-radius: 10px; 
        text-decoration: none;
        font-weight: 600;
    }
    .boton_eliminar{
        align-items: center;
        justify-content: center;
        color: white;
        padding: 10px;
        border-radius: 10px; 
        text-decoration: none;
        font-weight: 600;
    }

    .ticket{
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #373737;
        color: white;
        padding: 5px;
        margin: 6px 3px 6px 3px;
        border-radius: 10px; 
        text-decoration: none;
        font-weight: 600;
        cursor: pointer;
    }
    .ticket:hover{
        color:white;
        text-decoration: none;
        background-color: #1f1e1e;
    }
    .boton-ticket{
        margin-right: 50px;
        font-weight: 700;
        color:white;
        background-color: green;
        border-radius: 12px;
        border: black 1px solid;
        text-align: center;
        align-items: center;
        display: flex;
        justify-content: center;
        font-size: 16px;
        padding: 10px;
        cursor: pointer;
    }

    .boton-ticket:hover{
        background-color: #209335;
    }
</style>
<x-app-layout>
    @section('title', 'Tasks')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    @section('css')
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/dataTables/css/jquery.dataTables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/dataTables/css/responsive.dataTables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/customDataTables.css') }}">
    @endsection

    <div class="py-10">
        <div class="mb-10 py-3 ml-16 leading-normal flex text-green-500 rounded-lg" role="alert">
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
            @if (auth()->user()->role == 'Administrator')
                <div style="margin-left: 900px">
                    <form action="{{ route('create.task') }}">
                        <button class='w-auto rounded-lg shadow-xl font-bold text-white px-4 py-2'
                        style="background:#227b22;text-decoration: none;" onmouseover="this.style.backgroundColor='#228e22'" onmouseout="this.style.backgroundColor='#227b22'"
                        type="submit">
                            Create Task
                        </button>
                    </form>
                </div>
            @endif
        </div>
        <div class="mx-auto sm:px-6 lg:px-8" style="width:80rem;">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-6" style="width:100%;">
                <table id="data-table" class="stripe hover translate-table"
                    style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th class='text-center font-bold'>Title</th>
                            <th class='text-center'>Description</th>
                            <th class='text-center'>Status</th>
                            <th class='text-center'>DueDate</th>
                            <th class='text-center'>User</th>
                            <th class='text-center'>Priority</th>
                            <th class='text-center'>Tags</th>
                            <th class='text-center font-bold'>SubTasks</th>
                            <th class='text-center font-bold'>Options</th>
                        </tr>
                    </thead>
                    {{--Muestra mensaje de operacion exitosa y desaparece después de 2 segundos--}}
                    @if (session()->has('success'))
                        <style>
                            .auto-fade {
                                animation: fadeOut 2s ease-in-out forwards;
                            }

                            @keyframes fadeOut {
                                0% {
                                    opacity: 1;
                                }
                                90% {
                                    opacity: 1;
                                }
                                100% {
                                    opacity: 0;
                                    display: none;
                                }
                            }
                        </style>
                        <div class="alert alert-success auto-fade px-2 inline-flex flex-row text-green-600">
                            {{ session()->get('success') }}
                        </div> 
                    @elseif (session()->has('error'))
                        <style>
                            .auto-fade {
                                animation: fadeOut 2s ease-in-out forwards;
                            }

                            @keyframes fadeOut {
                                0% {
                                    opacity: 1;
                                }
                                90% {
                                    opacity: 1;
                                }
                                100% {
                                    opacity: 0;
                                    display: none;
                                }
                            }
                        </style>
                        <div class="auto-fade inline-flex flex-row text-red-600 bg-red-100 border border-red-400 rounded py-2 px-4 my-2">
                            {{ session()->get('error') }}
                        </div>
                    @endif
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>                                    
                                <td align="center">{{ $task->title}}</td>
                                <td align="center" style="width: 200px">
                                    <textarea class="mb-1 p-2 px-3 text-justify content-center" 
                                    style="height: 100px;width:90%;word-wrap:break-word;">{{ $task->description}}</textarea>
                                </td>
                                <td align="center">@if($task->isCompleted) 'Completed' @else 'Pending' @endif</td>
                                <td align="center">
                                    {{$task->dueDate}}
                                </td>
                                <td align="center">
                                    {{$task->user->username}}
                                </td>
                                <td align="center">{{ $task->priority }}</td>
                                <td align="center">
                                    {{$task->tags}}
                                </td>
                                <td>
                                    <a href="">
                                        {{$task->subtags_id}}
                                    </a>
                                </td>
                                <td align="center">
                                    <div class="container justify-between inline-flex">
                                        @if ($task->isCompleted == false)                                            
                                            <div style="width: 50%">
                                                <form action="{{ route('complete.task',$task->id) }}" method="POST">
                                                    @csrf
                                                    <button class="boton_editar bg-green-700 hover:bg-green-800 text-white" type="submit">
                                                        Complete
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                        <div style="width: 50%">
                                            <form action="{{ route('edit.task',$task->id) }}">
                                                @csrf
                                                <button class="boton_editar bg-yellow-400 hover:bg-yellow-500" type="submit">
                                                    Edit
                                                </button>
                                            </form>
                                        </div>
                                        <div style="width: 50%">
                                            <form action="{{ route('delete.task',$task->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="boton_eliminar bg-red-600 hover:bg-red-800" type="submit">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr> 
                        @endforeach
                    </tbody>
                </table>
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
        <script type="text/javascript">
            $(document).ready(function() {
                $('#data-table').dataTable();
            });
        </script>
    @endsection
</x-app-layout>