<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('head', 'Comercializadora')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    
    <style>
        /* Sticky footer styles */
        html, body {
            height: 100%;
            margin: 0;
        }
        #app {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex: 1;
        }
        footer {
            background-color: rgba(0, 0, 0, 0.05);
            text-align: center;
            padding: 10px 0; /* Ajusta el relleno según tus necesidades */
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-primary shadow-sm navbar-custom">
            <div class="container">
                @if (!request()->is('show_products') && !request()->is('show_products/search*'))
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <h1 class="text-white">@yield('title', 'Comercializadora')</h1>
                    </a>
                @else
                    <h1 class="text-white">@yield('title', 'Comercializadora de Productos de Limpieza')</h1>
                @endif

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (!request()->is('show_products') && !request()->is('show_products/search*'))
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif
                        
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link  text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @endif {{-- Cierra el bloque que has añadido --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle  text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <footer class="text-center text-lg-start bg-light text-muted">
            <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
                <!-- Left -->
                {{-- <div class="me-5 d-none d-lg-block">
                    <span>Conéctate con nosotros en las redes sociales:</span>
                </div> --}}
                <!-- Left -->
        
                <!-- Right -->
                {{-- <div>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-github"></i>
                    </a>
                </div> --}}
                <!-- Right -->
            </section>
        
            <!-- Section: Links  -->
            {{-- <section class="">
                <div class="container text-center text-md-start mt-5">
                    <div class="row mt-3">
                        <!-- Company Info -->
                        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                            <h6 class="text-uppercase fw-bold mb-4">
                                <i class="fas fa-gem me-3"></i>Nombre de la Empresa
                            </h6>
                            <p>
                                Aquí puedes usar filas y columnas para organizar tu contenido de pie de página o lo que sea que desees.
                            </p>
                        </div>
                        <!-- Links -->
                        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                            <h6 class="text-uppercase fw-bold mb-4">
                                Productos
                            </h6>
                            <p>
                                <a href="#!" class="text-reset">Angular</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">React</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">Vue</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">Laravel</a>
                            </p>
                        </div>
                        <!-- Links -->
                        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                            <h6 class="text-uppercase fw-bold mb-4">
                                Enlaces Útiles
                            </h6>
                            <p>
                                <a href="#!" class="text-reset">Precios</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">Configuraciones</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">Pedidos</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">Ayuda</a>
                            </p>
                        </div>
                        <!-- Contact -->
                        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                            <h6 class="text-uppercase fw-bold mb-4">
                                Contacto
                            </h6>
                            <p><i class="fas fa-home me-3"></i> Ciudad, Estado, País</p>
                            <p>
                                <i class="fas fa-envelope me-3"></i>
                                info@example.com
                            </p>
                            <p><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
                            <p><i class="fas fa-print me-3"></i> + 01 234 567 89</p>
                        </div>
                    </div>
                </div>
            </section> --}}
            <!-- Section: Links  -->
        
            <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
                © {{ now()->year }} Derechos Reservados:
                <a class="text-reset fw-bold" 
                    @if (auth()->check())
                        href="https://comercializadora.domcloud.dev/"
                    @else
                        href="https://comercializadora.domcloud.dev/show_products"    
                    @endif
                >comercializadora.domcloud.dev</a>
            </div>
        </footer>        
    </div>
</body>
</html>
