<style>
    /* since nested groupes are not supported we have to use
    regular css for the nested dropdowns
    */
    .MENU li>ul {
        transform: translatex(100%) scale(0);
        z-index: 50;
    }

    .MENU li:hover>ul {
        transform: translatex(101%) scale(1);
        z-index: 50;
    }

    .MENU li>button svg {
        transform: rotate(-90deg);
        z-index: 50;
    }

    .MENU li:hover>button svg {
        transform: rotate(-270deg);
        z-index: 50;
    }

    /* Below styles fake what can be achieved with the tailwind config
    you need to add the group-hover variant to scale and define your custom
    min width style.
        See https://codesandbox.io/s/tailwindcss-multilevel-dropdown-y91j7?file=/index.html
        for implementation with config file
    */
    .MENU .group:hover .group-hover\:scale-100 {
        transform: scale(1);
        z-index: 50;
    }

    .MENU .group:hover .group-hover\:-rotate-180 {
        transform: rotate(180deg);
        z-index: 50;
    }

    .MENU .scale-0 {
        transform: scale(0);
        z-index: 50;
    }

    .MENU .min-w-32 {
        min-width: 8rem;
        z-index: 50;
    }

    .MENU a:link {
        text-decoration: none;
        color: black;
        background-color: #F9F904;
        z-index: 50;
    }

    .MENU a:visited {
        text-decoration: none;
        color: black;
        background-color: #F9F904;
        z-index: 50;
    }

    .MENU a:hover {
        text-decoration: none;
        color: black;
        background-color: #F9F904;
        z-index: 50;
    }

    .MENU a:active {
        text-decoration: none;
        color: black;
        background-color: #F9F904;;
        z-index: 50;
    }
</style>
<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    @auth
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <a href="{{ route('dashboard') }}">
                        <div class="shrink-0 flex items-center font-bold text-xl" style="margin-top:18px">
                            <p class="text-black">TASKS <span class="text-blue-800">APP</span></p>
                        </div>
                    </a>
                    <!-- Navigation Links -->
                    <div class="MENU">
                        <div class="hidden space-x-8 sm:flex sm:items-center sm:ml-1 justify-between h-16">
                            @if (auth()->user()->role == 'Administrator')
                            <div class="group inline-block items-center ml-3" align="left" width="30">
                                <button
                                    class="outline-none focus:outline-none px-1 py-1 bg-white rounded-sm flex items-center min-w-32">
                                    <span class="pr-1 font-semibold flex-1">Tasks</span>
                                    <span>
                                        <svg class="fill-current h-4 w-4 transform group-hover:-rotate-180
                                    transition duration-150 ease-in-out" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                        </svg>
                                    </span>
                                </button>
                                <ul class="bg-white border rounded-sm transform scale-0 group-hover:scale-100 absolute                                
                                    transition duration-150 ease-in-out origin-top min-w-32">
                                    <li class="rounded-sm relative px-3 py-1 hover:bg-gray-100">
                                        <button
                                            class="w-full text-left flex items-center outline-none focus:outline-none text-black">
                                            <span class="pr-1 flex-1">Tasks</span>
                                            <span class="mr-auto">
                                                <svg class="fill-current h-4 w-4
                                        transition duration-150 ease-in-out" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                                </svg>
                                            </span>
                                        </button>

                                        <ul class="bg-white border rounded-sm absolute top-0 right-0
                                        transition duration-150 ease-in-out origin-top-left
                                        min-w-32">
                                        <a href="{{ route('create.task') }}">
                                            <li class="px-3 py-1 hover:bg-gray-100">Create</li>
                                        </a>
                                        <a href="{{ route('show.task') }}">
                                            <li class="px-3 py-1 hover:bg-gray-100">View All</li>
                                        </a>
                                        </ul>
                                    </li>
                                    <li class="rounded-sm relative px-3 py-1 hover:bg-gray-100">
                                        <button
                                            class="w-full text-left flex items-center outline-none focus:outline-none text-black">
                                            <span class="pr-1 flex-1">SubTaks</span>
                                            <span class="mr-auto">
                                                <svg class="fill-current h-4 w-4
                                        transition duration-150 ease-in-out" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                                </svg>
                                            </span>
                                        </button>

                                        <ul class="bg-white border rounded-sm absolute top-0 right-0
                                        transition duration-150 ease-in-out origin-top-left
                                        min-w-32">
                                        <a href="{{ route('create.subtask') }}">
                                            <li class="px-3 py-1 hover:bg-gray-100">Create</li>
                                        </a>
                                        <a href="{{ route('show.subtask') }}">
                                            <li class="px-3 py-1 hover:bg-gray-100">View All</li>
                                        </a>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="group inline-block items-center ml-3" align="left" width="30">
                                <button
                                    class="outline-none focus:outline-none px-1 py-1 bg-white rounded-sm flex items-center min-w-32">
                                    <span class="pr-1 font-semibold flex-1">Graphs</span>
                                    <span>
                                        <svg class="fill-current h-4 w-4 transform group-hover:-rotate-180
                                    transition duration-150 ease-in-out" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                        </svg>
                                    </span>
                                </button>
                                <ul class="bg-white border rounded-sm transform scale-0 group-hover:scale-100 absolute                                
                                    transition duration-150 ease-in-out origin-top min-w-32">
                                    <a href="">
                                        <li class="px-3 py-1 hover:bg-gray-100">View Statistics</li>
                                    </a>
                                </ul>
                            </div>
                            @else
                            <div class="group inline-block items-center ml-3" align="left" width="30">
                                <button
                                    class="outline-none focus:outline-none px-1 py-1 bg-white rounded-sm flex items-center min-w-32">
                                    <span class="pr-1 font-semibold flex-1">Tasks</span>
                                    <span>
                                        <svg class="fill-current h-4 w-4 transform group-hover:-rotate-180
                                    transition duration-150 ease-in-out" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                        </svg>
                                    </span>
                                </button>
                                <ul class="bg-white border rounded-sm transform scale-0 group-hover:scale-100 absolute                                
                                    transition duration-150 ease-in-out origin-top min-w-32">
                                    <li class="rounded-sm relative px-3 py-1 hover:bg-gray-100">
                                        <button
                                            class="w-full text-left flex items-center outline-none focus:outline-none text-black">
                                            <span class="pr-1 flex-1">Tasks</span>
                                            <span class="mr-auto">
                                                <svg class="fill-current h-4 w-4
                                        transition duration-150 ease-in-out" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                                </svg>
                                            </span>
                                        </button>

                                        <ul class="bg-white border rounded-sm absolute top-0 right-0
                                        transition duration-150 ease-in-out origin-top-left
                                        min-w-32">
                                        <a href="{{ route('show.task') }}">
                                            <li class="px-3 py-1 hover:bg-gray-100">View All</li>
                                        </a>
                                        </ul>
                                    </li>
                                    <li class="rounded-sm relative px-3 py-1 hover:bg-gray-100">
                                        <button
                                            class="w-full text-left flex items-center outline-none focus:outline-none text-black">
                                            <span class="pr-1 flex-1">SubTaks</span>
                                            <span class="mr-auto">
                                                <svg class="fill-current h-4 w-4
                                        transition duration-150 ease-in-out" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                                </svg>
                                            </span>
                                        </button>

                                        <ul class="bg-white border rounded-sm absolute top-0 right-0
                                        transition duration-150 ease-in-out origin-top-left
                                        min-w-32">
                                        <a href="{{ route('show.subtask') }}">
                                            <li class="px-3 py-1 hover:bg-gray-100">View All</li>
                                        </a>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            @endif               
                        </div>
                    </div>
                </div>    
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <!-- Settings Dropdown -->
                    <div class="ml-3 relative">
                        <x-jet-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <button class="inline-flex items-center text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-150 transition">
                                        <img class="h-8 w-8 rounded-full object-cover mr-2"
                                            src="{{ asset('assets/perfil.jpg') }}" alt="Imagen del empleado"/>

                                        <span class="mr-2">{{ Auth::user()->username }}</span>
                                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                @endif
                            </x-slot>                            

                            <x-slot name="content">
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-sm text-gray-500 mb-1">
                                    {{ __('Opciones') }}
                                </div>

                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                        {{ __('API Tokens') }}
                                    </x-jet-dropdown-link>
                                @endif

                                <div class="border-t border-gray-100"></div>
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-jet-dropdown-link href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                        {{ __('Cerrar Sesión') }}
                                    </x-jet-dropdown-link>
                                </form>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>
                </div>

                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-jet-responsive-nav-link>
            </div>
        </div>
    @endauth
</nav>