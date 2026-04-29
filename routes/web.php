<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TeamsController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LoginController;

// Rutas públicas
Route::get('/login', [LoginController::class, 'showlogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout']);

// Rutas protegidas con middleware auth
Route::middleware('auth')->group(function () {
    Route::post('/players', [PlayerController::class, 'getintoDate']);
    Route::get('/players', [PlayerController::class, 'showPlayers']);
    Route::get('/players/search', [PlayerController::class, 'searchplayers']);
    Route::delete('/players/{id}', [PlayerController::class, 'deletePlayer']);
    Route::get('/players/{id}/edit', [PlayerController::class, 'editPlayer']);
    Route::put('/players/{id}', [PlayerController::class, 'updatePlayer']);
    Route::get('/teams', [TeamsController::class, 'showTeams']);
    Route::post('/teams', [TeamsController::class, 'createTeam']);
    Route::get('/usuarios', [UsuarioController::class, 'showUsers']);
    Route::post('/usuarios', [UsuarioController::class, 'createUsers']);
});