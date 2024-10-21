<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Fav Icon do Mercado Livre -->
        <link href="https://http2.mlstatic.com/frontend-assets/ml-web-navigation/ui-navigation/5.21.22/mercadolibre/favicon.svg" rel="icon"/>

        <!-- Permissão para carregamento do conteúdo com HTTP -->
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Titulo da aplicação -->
        {{-- <title>{{ config('app.name', 'Integração - API Mercado Livre') }}</title> --}}
        <title>Integração - API Mercado Livre</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Importação do arquivo CSS customizado -->
        <link rel="stylesheet" href="{{ secure_asset('css/custom.css') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">            
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <h2 class="p-0 my-0">Integração Mercado Livre</h2>

            <div class="m-0 w-full sm:max-w-md mt-6 mt-2 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
