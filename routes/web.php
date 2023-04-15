<?php

use Illuminate\Support\Facades\Route;

//Incluindo os Controladores da Aplicação
use App\Http\Controllers\MainController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\InvestmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Rotas Principais
Route::get('/', [MainController::class, 'index']);
Route::get('/investments', [MainController::class, 'investments']);

//Rotas de Clientes
Route::get('/client_add', [ClientController::class, 'add']);
Route::post('/client_post', [ClientController::class, 'post']);

//Rotas de Investimentos
Route::get('/investment_add', [InvestmentController::class, 'add']);
Route::post('/investment_post', [InvestmentController::class, 'post']);
