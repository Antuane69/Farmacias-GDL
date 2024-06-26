<x-app-layout>
    @section('title', 'Soporte')
    <x-slot name="header">
        <div class="flex items-center text-center">
            <div class="text-left">
                <a href="{{ route('login') }}"
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
                {{ __("Registro de usuario") }}
            </h2>
        </div>
    </x-slot>

    @section('css')
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    @endsection
    
    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl md:rounded-lg">
                <form id="formulario" action={{ route('register.guardar') }} method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class='flex items-center justify-center  md:gap-8 gap-4 pt-3 pb-2 font-bold text-3xl text-slate-700 rounded-t-xl mx-10 mt-5' style="background-color: #FFFF7B">
                        <p>
                            Registrarte
                        </p>
                    </div>
                    <div class="mb-5 mx-10 px-10 py-5 text-center rounded-b-xl bg-gray-100">
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-5 md:gap-8 mx-7">                    
                            <div class='grid grid-cols-1'>
                                <label for="titulo" class="mb-1 bloack uppercase text-gray-800 font-bold">
                                    * Username
                                </label>
                                <p>
                                    <input type="text" name="username" class="w-5/6 focus:outline-none focus:ring-2 mb-1 focus:border-transparent p-2 px-3 border-2 mt-1 ml-3 rounded-lg" required placeholder="Write your username">
                                </p>
                            </div>
                            <div class='grid grid-cols-1'>
                                <label for="titulo" class="mb-1 bloack uppercase text-gray-800 font-bold">
                                    * Password
                                </label>
                                <p>
                                    <input type="password" name="password" class="w-5/6 focus:outline-none focus:ring-2 mb-1 focus:border-transparent p-2 px-3 border-2 mt-1 ml-3 rounded-lg" required placeholder="Write your password">
                                </p>
                            </div>
                            <div class='grid grid-cols-1'>
                                <label for="titulo" class="mb-1 bloack uppercase text-gray-800 font-bold">
                                    * Password Validation
                                </label>
                                <p>
                                    <input type="password" name="password_val_confirmation" class="w-5/6 focus:outline-none focus:ring-2 mb-1 focus:border-transparent p-2 px-3 border-2 mt-1 ml-3 rounded-lg" required placeholder="Write your password">
                                </p>
                            </div>

                            <div class='grid grid-cols-1'>
                                <label for="titulo" class="mb-1 bloack uppercase text-gray-800 font-bold">
                                    * Email
                                </label>
                                <p>
                                    <input type="text" name="email" class="w-5/6 focus:outline-none focus:ring-2 mb-1 focus:border-transparent p-2 px-3 border-2 mt-1 ml-3 rounded-lg" required placeholder="Write your email">
                                </p>
                            </div>

                            <div class='grid grid-cols-1'>
                                <label for="tipo" class="mb-1 bloack uppercase text-gray-800 font-bold">
                                    * Role
                                </label>
                                <p>
                                    <select name="role" id="role-id" class='w-5/6 mb-1 p-2 px-3 rounded-lg border-2 mt-1 focus:outline-none focus:ring-2 focus:border-transparent' required onchange="RoleChange()">             
                                        <option value="" disabled selected>Select an Option</option>
                                        @foreach($roles as $role)
                                            <option value="{{$role}}">{{$role}}</option>
                                        @endforeach
                                    </select>
                                </p>
                            </div>
                            <div class='grid grid-cols-1' hidden id="role-div">
                                <label for="titulo" class="mb-1 bloack uppercase text-gray-800 font-bold">
                                    * Role Code
                                </label>
                                <p>
                                    <input type="text" name="role_val" required id="role-code" class="w-5/6 focus:outline-none focus:ring-2 mb-1 focus:border-transparent p-2 px-3 border-2 mt-1 ml-3 rounded-lg" placeholder="Write your code">
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class='flex items-center justify-center  md:gap-8 gap-4 pt-1 pb-5'>
                        <a href="{{ route('login') }}"
                            class='w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Cancelar</a>
                        <button type="submit"
                            class='w-auto bg-green-600 hover:bg-green-700 rounded-lg shadow-xl font-bold text-white px-4 py-2'
                            >Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    function RoleChange(){
        let eleccion = document.getElementById('role-id').value;
        if(eleccion == 'Administrator'){
            document.getElementById('role-div').hidden = false;
            document.getElementById('role-code').required = true;
        }else{
            document.getElementById('role-div').hidden = true;
            document.getElementById('role-code').required = false;
        }
    }
</script>    

