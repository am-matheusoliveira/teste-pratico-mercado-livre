<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Página inicial do sistema login do usuário
Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

// Grupo de rotas do perfil do usuário
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard da aplicação
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    Route::patch('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.updatePhoto');
    
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // TESTE DE USO DO MIDDLEWARE - password.confirm DO LARAVEL BREEZE
    Route::get('/delete-account', function () {
    
        // // Excluindo o usuário logado
        // $user = auth()->user();
        // $user->delete();
        // 
        // // Fazendo logout
        // auth()->logout();
        // 
        // // Redirecionando para a tela de login com uma mensagem de sucesso
        // return redirect('/login')->with('status', 'Sua conta foi excluída com sucesso.');
    
    })->middleware(['store.next.redirect', 'password.confirm:password.confirm, 0'])->name('delete-account');     

    // ---------------------------------------------------------------------------------------------------//

    // Página de inicial
    Route::get('/produto', [ProdutoController::class, 'index'])->name('produto');

    // Cadastrar produtos
    Route::post('/produto/cadastrar-produto', [ProdutoController::class, 'cadastrarProduto'])->name('cadastrar-produto');

    // Gerar o Token de acesso a API
    Route::get('/produto/gerar-token', [ProdutoController::class, 'gerarToken'])->name('gerar-token');
});

// Require arquivo auth.php
require __DIR__.'/auth.php';