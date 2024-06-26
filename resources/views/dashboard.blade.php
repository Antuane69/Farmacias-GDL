<style>
    .background-image {
        position: absolute; /* Posición absoluta para superponer la imagen de fondo */
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('/assets/sakura.jpg'); /* Ruta relativa a partir de la carpeta public */
        background-size: cover;
        background-position: center;
        filter: brightness(80%); 
        opacity: 0.7;
        z-index: -1; /* Colocar detrás del contenido */
    }

</style>
<x-app2>

    @section('title', 'Little-Tokyo Administración')
    @section('css')
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0-beta3/css/bootstrap.min.css" rel="stylesheet">
    @endsection

    <body>
        <!-- ======= Hero Section ======= -->
        <section id="hero" class="d-flex align-items-center" style="position: relative">
            <div class="background-image"></div>
            <div class="container" data-aos="zoom-out" data-aos-delay="100">
                <h1>Welcome to the<span style="color: #851B1B"> Tasks App.</span></h1>
                <h2 class="uppercase font-bold text-black">The best tasks administrator tool.</h2>
                <div class="d-flex">
                    <a href="#featured-services" class="btn-get-started scrollto" style="color: #000000; background:#FFFF7B"><b>Options</b></a>
                </div>
            </div>
        </section>
        <!-- End Hero -->

        <main id="main">
            <!-- ======= Featured Services Section ======= -->
            <section id="featured-services" class="featured-services" href="#services">
                <div class="container" data-aos="fade-up">
                    @php
                        $delay = 0;
                        $espacio = 100;
                        $max = 400;
                    @endphp
                    @if (session()->has('success'))
                        <style>
                            .auto-fade {
                                animation: fadeOut 3s ease-in-out forwards;
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
                        <div class="auto-fade inline-flex flex-row text-green-600 bg-green-100 border border-green-400 rounded py-2 px-4 my-2 w-full mb-3">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    <div class="row">
                        @if (auth()->user()->role == 'Administrator')   
                            <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 card-wrapper" style="height: 400px;">
                                <a href="" class="card-link">
                                    <div class="icon-box service-box" data-aos="fade-up"
                                        data-aos-delay="{{ $delay = ($delay % $max) + $espacio }}" style="height: 100%;">
                                        <div class="icon">
                                            {{-- <i class="bx bx-group"></i> --}}
                                            <svg class="iconos" viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                    d="M16.604 11.048a5.67 5.67 0 0 0 .751-3.44c-.179-1.784-1.175-3.361-2.803-4.44l-1.105 1.666c1.119.742 1.8 1.799 1.918 2.974a3.693 3.693 0 0 1-1.072 2.986l-1.192 1.192l1.618.475C18.951 13.701 19 17.957 19 18h2c0-1.789-.956-5.285-4.396-6.952z" />
                                                <path fill="currentColor"
                                                    d="M9.5 12c2.206 0 4-1.794 4-4s-1.794-4-4-4s-4 1.794-4 4s1.794 4 4 4zm0-6c1.103 0 2 .897 2 2s-.897 2-2 2s-2-.897-2-2s.897-2 2-2zm1.5 7H8c-3.309 0-6 2.691-6 6v1h2v-1c0-2.206 1.794-4 4-4h3c2.206 0 4 1.794 4 4v1h2v-1c0-3.309-2.691-6-6-6z" />
                                            </svg>
                                        </div>
                                        <h4 class="title">View All Tasks</h4>
                                        <p class="description">In this module you can interact with all the tasks your users have. You can edit, delete and create new Tasks and Subtasks.  
                                        </p>
                                    </div>
                                </a>
                            </div>
                        @else
                            <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 card-wrapper" style="height: 200px;">
                                <a href="" class="card-link">
                                    <div class="icon-box service-box" data-aos="fade-up"
                                        data-aos-delay="{{ $delay = ($delay % $max) + $espacio }}" style="height: 100%;">
                                        <div class="icon">
                                            {{-- <i class="bx bx-group"></i> --}}
                                            <svg class="iconos" viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                    d="M16.604 11.048a5.67 5.67 0 0 0 .751-3.44c-.179-1.784-1.175-3.361-2.803-4.44l-1.105 1.666c1.119.742 1.8 1.799 1.918 2.974a3.693 3.693 0 0 1-1.072 2.986l-1.192 1.192l1.618.475C18.951 13.701 19 17.957 19 18h2c0-1.789-.956-5.285-4.396-6.952z" />
                                                <path fill="currentColor"
                                                    d="M9.5 12c2.206 0 4-1.794 4-4s-1.794-4-4-4s-4 1.794-4 4s1.794 4 4 4zm0-6c1.103 0 2 .897 2 2s-.897 2-2 2s-2-.897-2-2s.897-2 2-2zm1.5 7H8c-3.309 0-6 2.691-6 6v1h2v-1c0-2.206 1.794-4 4-4h3c2.206 0 4 1.794 4 4v1h2v-1c0-3.309-2.691-6-6-6z" />
                                            </svg>
                                        </div>
                                        <h4 class="title">View My Tasks</h4>
                                        <p class="description">In this module you can interact with your tasks.  
                                        </p>
                                    </div>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                </div>
            </section><!-- End Featured Services Section -->
            <!-- ======= Contact Section ======= -->
            <div id="preloader"></div>
            <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
                    class="bi bi-arrow-up-short"></i></a>
    </body>
</x-app2>

<!-- Bootstrap JS y dependencias -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-beta3/js/bootstrap.min.js"></script>