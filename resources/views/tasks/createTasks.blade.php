<x-app-layout>
    @section('title', 'Create Tasks')
    <x-slot name="header">
        <div class="flex items-center text-center">
            <div class="text-left">
                <a href="{{ route('show.task') }}"
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
                {{ __("Create Tasks") }}
            </h2>
        </div>
    </x-slot>

    @section('css')
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    @endsection
    
    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl md:rounded-lg">
                <form id="formulario" action={{ route('save.task',$task->id) }} method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class='flex items-center justify-center  md:gap-8 gap-4 pt-3 pb-2 font-bold text-3xl text-slate-700 rounded-t-xl mx-10 mt-5' style="background-color: #FFFF7B">
                        <p>
                            Task Form
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
                                    value="{{$task->title}}">
                                </p>
                            </div>
                            <div class='grid grid-cols-1'>
                                <label for="description" class="mb-1 bloack uppercase text-gray-800 font-bold">
                                    * Description
                                </label>
                                <p>
                                    <textarea name="description" 
                                    class="focus:outline-none focus:ring-2 mb-1 focus:border-transparent p-2 px-3 border-2 mt-1 rounded-lg w-5/6 @error('description') border-red-800 bg-red-100 @enderror" 
                                    required placeholder="Write the description of the task">{{ old('description', $task->description) }}</textarea>
                                </p>
                            </div>
                            <div  class='grid grid-cols-1'>
                                <label for="fecha_solicitud" class="mb-1 block uppercase text-gray-800 font-bold">* Due Date</label>
                                <p>
                                    <input id="date" type="date" name="due_date" class="w-5/6 bg-gray-200 mb-1 p-2 px-3 rounded-lg border-2  mt-1 focus:outline-none focus:ring-2 focus:ring-green-700 focus:border-transparent" type="date" required
                                    value="{{$task->dueDate}}"/>
                                </p>
                            </div> 

                            <div class='grid grid-cols-1'>
                                <label for="userid" class="mb-1 bloack uppercase text-gray-800 font-bold">
                                    * User
                                </label>
                                <p>
                                    <select name="user" id="userid" class='w-5/6 mb-1 p-2 px-3 rounded-lg border-2 mt-1 focus:outline-none focus:ring-2 focus:border-transparent' required>             
                                        @if ($task->user_id == '')
                                            <option value="" disabled selected>Select an Option</option>
                                        @endif
                                        @foreach($users as $user)
                                            @if ($task->user_id == $user->id)
                                                <option value="{{$user->id}}" selected>{{$user->username}}</option>
                                            @else
                                                <option value="{{$user->id}}">{{$user->username}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </p>
                            </div>
                            <div class='grid grid-cols-1'>
                                <label for="priority-id" class="mb-1 bloack uppercase text-gray-800 font-bold">
                                    * Priority
                                </label>
                                <p>
                                    <select name="priority" id="priority-id" class='w-5/6 mb-1 p-2 px-3 rounded-lg border-2 mt-1 focus:outline-none focus:ring-2 focus:border-transparent' required>             
                                        @if ($task->priority == '')
                                            <option value="" disabled selected>Select an Option</option>
                                        @endif
                                        @foreach($priorities as $priority)
                                            @if ($task->priority == $priority)
                                                <option value="{{$priority}}" selected>{{$priority}}</option>
                                            @else
                                                <option value="{{$priority}}">{{$priority}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </p>
                            </div>
                            <div class='grid grid-cols-1'>
                                <label for="tag-id" class="mb-1 bloack uppercase text-gray-800 font-bold">
                                    * Tag
                                </label>
                                <p>
                                    <select name="tag" id="tag-id" class='w-5/6 mb-1 p-2 px-3 rounded-lg border-2 mt-1 focus:outline-none focus:ring-2 focus:border-transparent' required>             
                                        @if ($task->tags == '')
                                            <option value="" disabled selected>Select an Option</option>
                                        @endif
                                        @foreach($tags as $tag)
                                            @if ($task->tags == $tag)
                                                <option value="{{$tag}}" selected>{{$tag}}</option>
                                            @else
                                                <option value="{{$tag}}">{{$tag}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class='flex items-center justify-center  md:gap-8 gap-4 pt-1 pb-5'>
                        <a href="{{ route('login') }}"
                            class='w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Cancelar</a>
                        <button type="submit"
                            class='w-auto bg-green-600 hover:bg-green-700 rounded-lg shadow-xl font-bold text-white px-4 py-2'
                            >Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
   document.addEventListener("DOMContentLoaded", function() {
        var date = new Date();

        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();

        if (month < 10) month = "0" + month;
        if (day < 10) day = "0" + day;

        var today = year + "-" + month + "-" + day;
        $("#date").attr("value", today);

    });
</script>    

