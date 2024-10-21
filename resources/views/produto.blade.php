<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Produto') }}
        </h2>
    </x-slot>
        
    <div class="container">
        <div class="row my-5">
            <div class="col">
                <div class="row">
                    <div class="col-md-10">
                        <h2>Mercado Livre</h2>
                    </div>
                </div>
                
                @if(empty($tokenAPI))
                    <div class="alert alert-warning" role="alert">
                        <h4 class="alert-heading">Não Conectado <i class="fa-solid fa-circle-exclamation"></i></h4>
                        <p>Para realizar o cadastro de produtos você precisa esta conectado a uma conta do Mercado Livre.</p>
                        <p>Realize seu login clicando no botão abaixo.</p>
                        
                        <hr>

                        <a href="https://auth.mercadolivre.com.br/authorization?response_type=code&client_id={{ env('CLIENT_ID') }}&redirect_uri={{ urlencode(env('REDIRECT_URI')) }}" class="btn btn-warning shadow-none"><i class="fa-solid fa-user"></i> Realizar Login</a>
                    </div>
                @else
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">Conectado <i class="fa-solid fa-circle-check"></i></h4>
                        <p>Você esta conectado ao Mercado Livre.</p>
                    </div>
                @endif
            </div>
                
            <div class="col-md-6">

                <div class="row">
                    <div class="col-md-10">
                        <h2>Adicionar Produto</h2>
                    </div>
                </div>
    
                @if (session('success'))
                    <div class="alert alert-success">
                        <i class="fa-regular fa-circle-check"></i> {{ session('success') }}
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-danger">
                        <i class="fa-solid fa-triangle-exclamation"></i> {{ session('error') }}
                    </div>
                @endif
                    
                <form action="{{ route('cadastrar-produto') }}" method="POST" class="requires-validation" enctype="multipart/form-data" novalidate>                    
                    @csrf
    
                    <div class="mb-3">
                        <label for="input-nome" class="form-label">Nome</label>
                        <input type="text" class="form-control shadow-none" name="input-nome" id="input-nome" aria-describedby="nome" maxlength="255" required {{ $inputStatus }}>
    
                        <div class="valid-feedback">Campo corretamente preenchido!</div>
                        <div class="invalid-feedback">O Campo produto e obrigatório!</div>                        
                    </div>
    
                    <div class="mb-3">
                        <label for="input-descricao" class="form-label">Descrição</label>
                        <textarea class="form-control shadow-none" name="input-descricao" id="input-descricao" rows="3" required {{ $inputStatus }}></textarea>
    
                        <div class="valid-feedback">Campo corretamente preenchido!</div>
                        <div class="invalid-feedback">O Campo descrição e obrigatório!</div>                        
                    </div>
    
                    <div class="mb-3">
                        <label for="input-preco" class="form-label">Preço</label>
                        <input type="text" class="form-control shadow-none" name="input-preco" id="input-preco" maxlength="10" required {{ $inputStatus }}>
    
                        <div class="valid-feedback">Campo corretamente preenchido!</div>
                        <div class="invalid-feedback">O Campo preço e obrigatório!</div>
                    </div>                    
    
                    <div class="mb-3">
                        <label for="input-quantidade" class="form-label">Quantidade</label>
                        <input type="text" class="form-control shadow-none" name="input-quantidade" id="input-quantidade" maxlength="5" required {{ $inputStatus }}>
    
                        <div class="valid-feedback">Campo corretamente preenchido!</div>
                        <div class="invalid-feedback">O Campo quantidade e obrigatório!</div>                        
                    </div>                    
    
                    <div class="mb-3">
                        <label for="select-categoria" class="form-label">Categoria</label>
                        <select class="form-select shadow-none" aria-label="Default select example" name="select-categoria" id="select-categoria" maxlength="100" required {{ $inputStatus }}>
                            @if(count($categorias) > 0)
                                <option value="" selected disabled>Selecione uma categoria</option>
                                @foreach($categorias['children_categories'] as $categoria)
                                    <option value="{{ $categoria['id'] }}">{{ $categoria['name'] }}</option>
                                @endforeach
                            @else
                                <option value="" disabled>Nenhuma categoria encontrada</option>
                            @endif                            
                        </select>
    
                        <div class="valid-feedback">Campo corretamente preenchido!</div>
                        <div class="invalid-feedback">O Campo categoria e obrigatório!</div>                        
                    </div>
    
                    <div class="mb-3">
                        <label for="input-imagem" class="form-label">Imagem</label>
                        <input type="file" class="form-control shadow-none" name="input-imagem" id="input-imagem" accept=".png, .jpg, .jpeg, .webp" required {{ $inputStatus }}>
    
                        <div class="valid-feedback">Campo corretamente preenchido!</div>
                        <div class="invalid-feedback">O Campo imagem e obrigatório!</div>                        
                    </div>                
    
                    <button type="submit" class="btn btn-primary shadow-none" {{ $inputStatus }}><i class="fa-regular fa-floppy-disk"></i> Cadastrar Produto</button>
                </form>                
            </div>

            <div class="col">
                <div class="row">
                    <div class="col-md-10">
                        <h2>Resposta da API</h2>
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">
                        <i class="fa-regular fa-circle-check"></i> {{ session('success') }}
                        
                        @if(session('response'))
                            <hr>

                            <h4>Produto Cadastrado</h4>
                            <p class="m-0"><b>ID:         </b>{{ session('response')['id'] }}</p>
                            <p class="m-0"><b>Nome:       </b>{{ session('response')['title'] }}</p>
                            <p class="m-0"><b>Status:     </b>{{ session('response')['status'] }}</p>
                            <p class="m-0"><b>Quantidade: </b>{{ session('response')['available_quantity'] }}</p>
                        @endif

                        <hr>

                        <p>
                            {{ session('msgDescricao') }} 
                            
                            @if(session('response'))
                                <a href="{{ session('response')['permalink'] }}" target="_blank">Produto</a>.
                            @endif
                        </p>
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-danger">
                        <i class="fa-solid fa-triangle-exclamation"></i> {{ session('error') }}
                        <hr>
                        <p>{{ session('msgDescricao') }}</p>
                    </div>
                @endif
                
            </div>

        </div>
    </div>
</x-app-layout>