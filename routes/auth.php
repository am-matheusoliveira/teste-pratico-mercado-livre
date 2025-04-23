<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

// Grupo de rotas do usuário - Convidado
Route::middleware('guest')->group(function () {    
    // Register New User
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');    
    Route::post('register', [RegisteredUserController::class, 'store']);
    
    // Login User
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');    
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    
    // Essas rotas estão no grupo, mas sem o middleware guest
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request')->withoutMiddleware('guest');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email')->withoutMiddleware('guest');

    // Form New Password
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset')->withoutMiddleware('guest');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store')->withoutMiddleware('guest');
});

// Grupo de rotas do usuário - Autenticado
Route::middleware('auth')->group(function () {
    // Verificação de e-mail ao criar conta
    Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');
    
    // Confirmação de Senha
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');    
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);   
    
    // Atualizar senha Form Profile Edit
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');
    
    // Logout App
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
