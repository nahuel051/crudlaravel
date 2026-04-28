<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\FormController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TeamsController;
use App\Http\Controllers\UsuarioController;
// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/saludo',function(){
//     return 'Hola mundo!';
// }); //http://127.0.0.1:8000/saludo 
// Route::get('/', [FormController::class, 'index']);
// Route::post('/show', [FormController::class, 'show']);
// Route::get('/players', function () {
//     return view('futbol');
// });
Route::post('/players', [PlayerController::class, 'getintoDate']);
Route::get('/players', [PlayerController::class, 'showPlayers']);
Route::get('/players/search', [PlayerController::class, 'searchplayers']);
Route::delete('/players/{id}', [PlayerController::class, 'deletePlayer']);
Route::get('/players/{id}/edit', [PlayerController::class, 'editPlayer']);
Route::put('/players/{id}', [PlayerController::class, 'updatePlayer']);
Route::get('/teams', [TeamsController::class, 'showTeams']);
Route::post('/teams', [TeamsController::class, 'createTeam']);
Route::post('/usuarios', [UsuarioController::class, 'createUsers']);
Route::get('/usuarios', [UsuarioController::class, 'showUsers']);