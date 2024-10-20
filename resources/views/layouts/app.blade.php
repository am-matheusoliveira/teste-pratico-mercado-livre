<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <!-- Titulo da aplicação -->
        <title>{{ config('app.name', 'Formualário de Cadastro de Produtos - API Mercado Livre') }}</title>

        <!-- Importação do arquivo CSS compilado pelo Vite -->
        <link rel="stylesheet" href="{{ secure_asset('build/assets/app-D0ZZ6qyk.css') }}">
        <link rel="stylesheet" href="{{ secure_asset('build/assets/app-CB61jlRJ.css') }}">    

        <!-- Importação do arquivo CSS customizado -->
        <link rel="stylesheet" href="{{ secure_asset('css/custom.css') }}">
        
        <!-- Biblioteca de icones - Font-awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">    
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.3/dist/tailwind.min.css" rel="stylesheet">

        <!-- Vite -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <!-- Importação do arquivo JS compilado pelo Vite -->
        <script src="{{ secure_asset('build/assets/app--nf08Gx-.js') }}"></script>
        
        <!-- Importação do arquivo JS customizado -->    
        <script src="{{ secure_asset('js/custom.js') }}"></script>                
    </body>
</html>
