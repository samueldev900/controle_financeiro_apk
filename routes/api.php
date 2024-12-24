<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\FamilyController;
use App\Http\Controllers\AuthController;

/* Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum'); */


//Route::post('/login',);

Route::prefix('v1')->group(function () {

    //Users
    
    //Route::apiResource('users', UserController::class); Agrupa todas as rotas acima 
    
    /* Rotas protegidas pelo Auth Sanctum */
    Route::post('/users', [UserController::class, 'store']); // Cadastrando novos Usuários
    Route::middleware('auth:sanctum')->group(function(){
        
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
    Route::post('/login', [AuthController::class, 'login']);
});
