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
Route::get('/client_edit/{id}', [ClientController::class, 'edit']);
Route::post('/client_post', [ClientController::class, 'post']);
Route::post('/client_patch/{id}', [ClientController::class, 'patch']);
Route::post('/client_patch_avatar/{id}', [ClientController::class, 'patch_with_avatar']);
Route::get('/client_delete/{id}', [ClientController::class, 'delete']);


//Rotas de Investimentos
Route::get('/investment_add', [InvestmentController::class, 'add']);
Route::get('/investment_edit/{id}', [InvestmentController::class, 'edit']);
Route::post('/investment_post', [InvestmentController::class, 'post']);
Route::post('/investment_patch/{id}', [InvestmentController::class, 'patch']);
Route::get('/investment_delete/{id}', [InvestmentController::class, 'delete']);
