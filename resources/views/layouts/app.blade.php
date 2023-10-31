<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha384-...Tu-Integridad-...==" crossorigin="anonymous">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>


    <style>
        .custom-column {
            background-color: #17a2b8;
            /* Fondo celeste */
            color: white;
            /* Texto blanco */
            font-size: 2px;
            /* Tamaño de fuente reducido */
            padding: 10px;
            /* Espaciado interno */
            text-align: center;
            /* Texto centrado */
        }

        /* Estilo para alinear el h3 al centro */
        .custom-column h6 {
            text-align: center;
        }

        label {
            color: #001b92f6;
            /* Puedes cambiar "blue" por el color deseado */
            margin-bottom: 10px;
            font-weight: bold;
        }

        .custom-button1 {
            border-radius: 0;
            /* Elimina los bordes redondeados */
            margin-left: 15px;
            /* Margen izquierdo de 15px */
            margin-right: 15px;
            /* Margen derecho de 10px */
            width: 200px;
            /* Ancho deseado del botón */
            text-align: center;
            /* Centra el texto dentro del botón */
            color: white;
            /* Texto blanco */
            font-weight: bold;
        }

        .custom-button2 {
            border-radius: 0;
            /* Elimina los bordes redondeados */
            width: 200px;
            /* Ancho deseado del botón */
            text-align: center;
            /* Centra el texto dentro del botón */
            color: white;
            /* Texto blanco */
            font-weight: bold;
        }
    </style>

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('logo.png') }}" alt="Logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @auth
                            @if (auth()->user()->role->name == 'compras' || auth()->user()->role->name == 'contabilidad')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/requests') }}">{{ __('Solicitudes') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Proveedores') }}</a>
                                </li>
                            @elseif(auth()->user()->role->name == 'admin')
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Formulario
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="#">Estados</a>
                                        <a class="dropdown-item" href="#">Politicas</a>
                                        <a class="dropdown-item" href="#">preguntas</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Administrar
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="#">Roles de usuarios</a>
                                        <a class="dropdown-item" href="#">Usuarios</a>
                                    </div>
                                </li>
                            @endif
                        @endauth
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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

        <main class="py-0 pb-4">

            <div class="container-fluid pb-4">
                <div class="row">
                    <div class="col-sm text-center bg-primary text-white custom-column">
                        <h6>Bienvenida</h6>
                    </div>
                    <div class="col-sm text-center bg-info custom-column">
                        <h6>Datos del Proveedor</h6>
                    </div>
                    <div class="col-sm text-center bg-info custom-column">
                        <h6>Revisión Código de Política</h6>
                    </div>
                    <div class="col-sm text-center bg-info custom-column">
                        <h6>Revisión Código de Ética</h6>
                    </div>
                    <div class="col-sm text-center bg-info custom-column">
                        <h6>Check List</h6>
                    </div>
                </div>
            </div>
            @yield('content')
        </main>

    </div>
    <script src="{{ asset('js/chart.js') }}"></script>
</body>

</html>
