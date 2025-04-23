<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Adicionar Produto') }}
        </h2>
    </x-slot>
    
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-8 my-10">

            <!-- Coluna da esquerda: Formulário (maior) -->
            <div class="w-full lg:w-2/3">
                {{--
                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded mb-4">
                        <i class="fa-regular fa-circle-check"></i> {{ session('success') }}
                    </div>
                @elseif(session('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded mb-4">
                        <i class="fa-solid fa-triangle-exclamation"></i> {{ session('error') }}
                    </div>
                @endif
                --}}
                <form action="{{ route('cadastrar-produto') }}" method="POST" enctype="multipart/form-data" novalidate class="space-y-4">
                    @csrf

                    <div>
                        <label for="input-nome" class="block font-medium">Nome</label>
                        <input type="text" name="input-nome" id="input-nome" maxlength="255" required {{ $inputStatus }}
                            class="w-full border border-gray-300 rounded px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label for="input-descricao" class="block font-medium">Descrição</label>
                        <textarea name="input-descricao" id="input-descricao" rows="3" required {{ $inputStatus }}
                                class="w-full border border-gray-300 rounded px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex-1">
                            <label for="input-preco" class="block font-medium">Preço</label>
                            <input type="text" name="input-preco" id="input-preco" maxlength="10" required {{ $inputStatus }} class="w-full border border-gray-300 rounded px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">                    
                        </div>
                        
                        <div class="flex-1">
                            <label for="input-quantidade" class="block font-medium">Quantidade</label>
                            <input type="text" name="input-quantidade" id="input-quantidade" maxlength="5" required {{ $inputStatus }} class="w-full border border-gray-300 rounded px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>                  
                    </div>

                    <div>
                        <label for="select-categoria" class="block font-medium">Categoria</label>
                        <select name="select-categoria" id="select-categoria" required {{ $inputStatus }}
                                class="w-full border border-gray-300 rounded px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            @if(count($categorias) > 0)
                                <option value="" disabled selected>Selecione uma categoria</option>
                                @foreach($categorias['children_categories'] as $categoria)
                                    <option value="{{ $categoria['id'] }}">{{ $categoria['name'] }}</option>
                                @endforeach
                            @else
                                <option value="" disabled>Nenhuma categoria encontrada</option>
                            @endif
                        </select>
                    </div>

                    <div>
                        <label for="input-imagem" class="block font-medium">Imagem</label>
                        <input type="file" name="input-imagem" id="input-imagem" accept=".png, .jpg, .jpeg, .webp" required {{ $inputStatus }}
                            class="w-full border border-gray-300 rounded px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded" {{ $inputStatus }}>
                        <i class="fa-regular fa-floppy-disk"></i> Cadastrar Produto
                    </button>
                </form>
            </div>

            <!-- Coluna da direita -->
            <div class="w-full lg:w-1/3 flex flex-col gap-8">
                <!-- Bloco 1: Mercado Livre -->
                <div>
                    <h2 class="text-2xl font-bold mb-4">Mercado Livre</h2>

                    @if(empty($tokenAPI))
                        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded">
                            <h4 class="text-lg font-semibold">Não Conectado <i class="fa-solid fa-circle-exclamation"></i></h4>
                            <p class="mt-2">Para realizar o cadastro de produtos, você precisa estar conectado a uma conta do Mercado Livre.</p>
                            <p>Realize seu login clicando no botão abaixo.</p>
                            <hr class="my-2">
                            <a href="https://auth.mercadolivre.com.br/authorization?response_type=code&client_id={{ env('CLIENT_ID') }}&redirect_uri={{ urlencode(env('REDIRECT_URI')) }}" 
                            class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-4 py-2 rounded mt-2">
                                <i class="fa-solid fa-user"></i> Realizar Login
                            </a>
                        </div>
                    @else
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded">
                            <h4 class="text-lg font-semibold">Conectado <i class="fa-solid fa-circle-check"></i></h4>
                            <p class="mt-2">Você está conectado ao Mercado Livre.</p>
                        </div>
                    @endif
                </div>

                <!-- Bloco 2: Resposta da API -->
                <div>
                    @if(session('success') || session('error'))
                        <h2 class="text-2xl font-bold mb-4">Resposta da API</h2>
                    @endif
                    
                    @if (session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded">
                            <i class="fa-regular fa-circle-check"></i> {{ session('success') }}
                            
                            @if(session('response'))
                                <hr class="my-2">
                                <h4 class="font-semibold">Produto Cadastrado</h4>
                                <p><strong>ID:</strong> {{ session('response')['id'] }}</p>
                                <p><strong>Nome:</strong> {{ session('response')['title'] }}</p>
                                <p><strong>Status:</strong> {{ session('response')['status'] }}</p>
                                <p><strong>Quantidade:</strong> {{ session('response')['available_quantity'] }}</p>
                            @endif
                            
                            <hr class="my-2">

                            <p>{{ session('msgDescricao') }}
                                @if(session('response'))
                                    <a href="{{ session('response')['permalink'] }}" target="_blank" class="text-blue-600 underline">Produto</a>.
                                @endif
                            </p>
                        </div>
                    @elseif(session('error'))                        
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded">
                            <i class="fa-solid fa-triangle-exclamation"></i> {{ session('error') }}
                            <hr class="my-2">
                            <p>{!! session('msgDescricao') !!}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <x-slot name="customJsCode">
        <script>            
            // Obtendo o Input 'input-preco'
            const inputPreco = document.getElementById('input-preco');            

            // Obtendo o Input 'input-quantidade'
            const inputQuantidade = document.getElementById('input-quantidade');
            
            // Chamando Função
            formatarMoedaBR(inputPreco);
            somenteNumero(inputQuantidade);
        </script>
    </x-slot>    
</x-app-layout>