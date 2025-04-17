<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

// Página inicial do sistema login do usuário
Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

// Dashboard da aplicação
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grupo de rotas do perfil do usuário
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::patch('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.updatePhoto');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

// Require arquivo auth.php
require __DIR__.'/auth.php';

// Grupo de rotas do produto
Route::middleware('auth')->group(function () {
    // Página de inicial
    Route::get('/produto', [ProdutoController::class, 'index'])
        ->name('produto');        

    // Cadastrar produtos
    Route::post('/produto/cadastrar-produto', [ProdutoController::class, 'cadastrarProduto'])
        ->name('cadastrar-produto');

    // Gerar o Token de acesso a API
    Route::get('/produto/gerar-token', [ProdutoController::class, 'gerarToken'])
        ->name('gerar-token');

});