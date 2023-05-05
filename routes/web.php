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
Route::get('/', [MainController::class, 'index'])->name("index");
Route::get('/investments', [MainController::class, 'investments'])->name("investments");

//Rotas de Clientes
Route::get('/client/add', [ClientController::class, 'add'])->name("client.add");
Route::get('/client/edit/{id}', [ClientController::class, 'edit'])->name("client.edit");
Route::post('/client/post', [ClientController::class, 'post'])->name("client.post");
Route::put('/client/patch/{id}', [ClientController::class, 'patch'])->name("client.patch");
Route::put('/client/patch_avatar/{id}', [ClientController::class, 'patch_with_avatar'])->name("client.patch.avatar");
Route::delete('/client/delete/{id}', [ClientController::class, 'delete'])->name("client.delete");
Route::get('/client/investment/{id}', [ClientController::class, 'investment'])->name("client.investment");
Route::put('/client/investment/invest/{invested_id}/{client_id}', [ClientController::class, 'invest'])->name("client.invest");
Route::put('/client/investment/retrieve/{invested_id}/{client_id}', [ClientController::class, 'retrieve'])->name("client.retrieve");
Route::post('/client/investment/new_invest/{investment_id}/{client_id}', [ClientController::class, 'new_investment'])->name("client.new.investment");



//Rotas de Investimentos
Route::get('/investment/add', [InvestmentController::class, 'add'])->name("investment.add");
Route::get('/investment/edit/{id}', [InvestmentController::class, 'edit'])->name("investment.edit");
Route::post('/investment/post', [InvestmentController::class, 'post'])->name("investment.post");
Route::put('/investment/patch/{id}', [InvestmentController::class, 'patch'])->name("investment.patch");
Route::get('/investment/info/{id}', [InvestmentController::class, 'info'])->name("investment.info");
Route::delete('/investment/delete/{id}', [InvestmentController::class, 'delete'])->name("investment.delete");
