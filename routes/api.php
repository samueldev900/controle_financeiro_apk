<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\FamilyController;

/* Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum'); */


//Route::post('/login',);

Route::prefix('v1')->group(function (){
    //Users
    Route::get('/users',[UserController::class, 'index']); // Listando todos os usuários
    Route::get('/users/{user}',[UserController::class, 'show']); // Mostrando um usuário especifico usando model bind por get enviando o ID
    Route::post('/users',[UserController::class, 'store']); //Cadastrando Usuários


    /* Families */
    Route::get('/families',[FamilyController::class, 'index']);

});
