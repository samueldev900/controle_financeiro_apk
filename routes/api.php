<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\api\V1\RendaController;
use App\Http\Controllers\ParcelamentoController;
use App\Http\Controllers\Api\V1\FamilyController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


/* Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum'); */


//Route::post('/login',);

Route::prefix('v1')->group(function () {

    //Users

    //Route::apiResource('users', UserController::class); Agrupa todas as rotas acima 

    /* Rotas protegidas pelo Auth Sanctum */
    Route::post('/users', [UserController::class, 'store']); // Cadastrando novos Usuários
    Route::middleware('auth:sanctum')->group(function () {
        /* Rotas dos Users */
        Route::get('/users', [UserController::class, 'index']); // Listando todos os usuários
        Route::delete('/users/{user}', [UserController::class, 'destroy']); //Deletando Usuário
        Route::put('/users/{user}', [UserController::class, 'update']); //Atualizando Usuários
        Route::get('/users/{user}', [UserController::class, 'show']); // Mostrando um usuário especifico usando model bind por get enviando o ID

        Route::post('/logout', [AuthController::class, 'logout']);
    });


    /* Families */
    Route::get('/families', [FamilyController::class, 'index']);

    /* Login e cria o token*/
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    /*     Route::get('verify-email/{id}/{hash}', [AuthController::class, 'verifyEmail'])->name('verification.verify');
    
    Route::post('/email/resend', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return response()->json(['message' => 'Verification email resent.']);
    })->middleware(['auth:sanctum']); */

    Route::get('/renda', [RendaController::class, 'index']); // Listando todas as rendas
    Route::get('/renda/{renda}', [RendaController::class, 'show']); // Listando uma renda em especifico
    Route::post('/renda', [RendaController::class, 'store']); // cadastrando novas rendas
    Route::put('/renda/{renda}', [RendaController::class, 'update']); // Atualizando uma renda
    Route::delete('/renda/{renda}', [RendaController::class, 'destroy']); // Deletando uma renda

    Route::get('/parcelamento', [ParcelamentoController::class, 'index']); // lista todos os parcelamentos
    Route::get('/parcelamento/{parcelamento}', [ParcelamentoController::class, 'show']); // Mostra um parcelamento
    Route::post('/parcelamento', [ParcelamentoController::class, 'store']); // Cadastra um novo parcelamento
    Route::put('/parcelamento/{parcelamento}', [ParcelamentoController::class, 'update']); // Atualiza um parcelamento
    Route::delete('/parcelamento/{parcelamento}', [ParcelamentoController::class, 'destroy']); // Deleta um parcelamento
});
