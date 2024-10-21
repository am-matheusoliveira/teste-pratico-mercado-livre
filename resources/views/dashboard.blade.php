<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- __("You're logged in!") --}}
                    
                    <!-- Título chamativo -->
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Menu do Sistema</h2>
                    
                    <div class="bg-white border-b border-gray-200 shadow-md rounded-lg w-80"> <!-- Largura fixa do card -->

                        <!-- Descrição dentro de um card -->
                        <div class="p-4 rounded-lg mb-4 text-center">
                            <p class="whitespace-nowrap text-gray-600 font-semibold text-lg">
                                Integração Mercado Livre
                            </p>

                            <!-- Botão centralizado -->
                            <div class="flex justify-center mt-4"> <!-- Centraliza o botão -->
                                <a href="{{ route('produto') }}" class="mt-8 no-underline inline-flex items-center justify-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Acessar Opção <i class="ms-2 fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
