<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JuegoController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Página principal - selección de personaje
Route::get('/', [JuegoController::class, 'index']);

// Selección de equipo (paso 2)
Route::get('/equipo/{personaje}', [JuegoController::class, 'seleccionarEquipo']);

// Ficha del personaje
Route::get('/personaje/{nombre}', [JuegoController::class, 'personaje']);

// Selección de armas (entre personaje y misión)
Route::get('/armas/{personaje}/{mision}', [JuegoController::class, 'seleccionarArmas']);

// Ejecutar misión
Route::get('/mision/{personaje}/{mision}', [JuegoController::class, 'ejecutarMision']);