<x-app-layout>
    @section('title', 'Create SubTasks')
    <x-slot name="header">
        <div class="flex items-center text-center">
            <div class="text-left">
                <a href="{{ route('show.subtask') }}"
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
                {{ __("Create SubTasks") }}
            </h2>
        </div>
    </x-slot>

    @section('css')
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    @endsection
    
    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl md:rounded-lg">
                <form id="formulario" action={{ route('save.subtask',$subtask->id) }} method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class='flex items-center justify-center  md:gap-8 gap-4 pt-3 pb-2 font-bold text-3xl text-slate-700 rounded-t-xl mx-10 mt-5' style="background-color: #FFFF7B">
                        <p>
                            SubTask Form
                        </p>
                    </div>
                    <div class="mb-5 mx-10 px-10 py-5 text-center rounded-b-xl bg-gray-100">
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-5 md:gap-8 mx-7">                    
                            <div class='grid grid-cols-1'>
                                <label for="title" class="mb-1 bloack uppercase text-gray-800 font-bold">
                                    * Title
                                </label>
                                <p>
                                    <input type="text" id="title" name="title" class="w-5/6 focus:outline-none focus:ring-2 mb-1 focus:border-transparent p-2 px-3 border-2 mt-1 ml-3 rounded-lg" required placeholder="Write the title of the task"
                                    value="{{$subtask->title}}">
                                </p>
                            </div>
                            <div class='grid grid-cols-1'>
                                <label for="taskid" class="mb-1 bloack uppercase text-gray-800 font-bold">
                                    * Tasks
                                </label>
                                <p>
                                    <select name="task" id="taskid" class='w-5/6 mb-1 p-2 px-3 rounded-lg border-2 mt-1 focus:outline-none focus:ring-2 focus:border-transparent' required>             
                                        @if ($subtask->task_id == '')
                                            <option value="" disabled selected>Select an Option</option>
                                        @endif
                                        @foreach($tasks as $task)
                                            @if ($subtask->task_id == $task->id)
                                                <option value="{{$task->id}}" selected>{{$task->title}}</option>
                                            @else
                                                <option value="{{$task->id}}">{{$task->title}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </p>
                            </div>
                            <div class='grid grid-cols-1'>
                                <div class='flex items-center justify-center md:gap-8 gap-4 mt-2'>
                                    <a href="{{ route('show.subtask') }}"
                                        class='w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Cancelar</a>
                                    <button type="submit"
                                        class='w-auto bg-green-600 hover:bg-green-700 rounded-lg shadow-xl font-bold text-white px-4 py-2'
                                        >Save</button>
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

