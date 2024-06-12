<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* Estilos para pantallas grandes */
            .large-screen-container {
                display: flex;
                flex-direction: row;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
            }
            .large-screen-image-container {
                order: 1;
                width: 40%;
                margin-bottom: 20px; /* Agregado para separar la imagen del formulario */
            }
            .large-screen-form-container {
                order: 2;
                width: 50%;
                padding: 50px;
                background-color: #ffffff;
                /* box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); */
                border-radius: 0.375rem;
            }
    
            @media (min-width: 641px) {
                .small-screen-container {
                    display: none; /* Oculta el contenedor para pantallas pequeñas */
                }
            }
    
            @media (max-width: 640px) {
                .large-screen-container {
                    display: none; /* Oculta el contenedor para pantallas grandes */
                }
            }
    
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <!-- Contenedor para pantallas pequeñas -->
        <div class="small-screen-container">
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <a href="/">
                    <img src="{{ asset('images/laser.jpg') }}" style="
                    order: 1;
                    width: 50%;
                    margin-bottom: 20px;" 
                    class="rounded mx-auto d-block" width="250px" height="250px">
                </a>
                {{ $slot }}
            </div>
        </div>
    
        <!-- Contenedor para pantallas grandes -->
        <div class="large-screen-container">
            <div class="large-screen-image-container">
                <a href="/">
                    <img src="{{ asset('images/rectificadora.jpg') }}" class="rounded w-full" alt="Planetario" width="200px" height="200px">
                </a>
            </div>
            <div class="large-screen-form-container">
                <div class="w-full max-w-md bg-white shadow-md overflow-hidden rounded-lg">
                    {{ $slot }}
                </div>
            </div>
        </div>
    
    </body>
</html>