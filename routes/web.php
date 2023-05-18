<?php

use Illuminate\Support\Facades\Route;

//Incluindo os controladores da aplicação
use App\Http\Controllers\MainController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\InvestmentController;

// Rotas principais (Header)
Route::controller(MainController::class)->group(function () {

    Route::get('/', 'index')->name('index');
    Route::get('/investments', 'investments')->name('investments');
});

// Rotas relacionadas aos clientes
Route::controller(ClientController::class)->group(function () {

    // Rotas para adicionar clientes
    Route::get('/client/create', 'create')->name('client.create');
    Route::post('/client/store', 'store')->name('client.store');

    // Rotas para atualizar clientes
    Route::get('/client/edit/{id}', 'edit')->name('client.edit');
    Route::put('/client/update', 'update')->name('client.update');

    // Rota para deletar clientes
    Route::delete('/client/destroy/{id}', 'destroy')->name('client.destroy');

    // Rotas para adicionar e atualizar investimentos de clientes
    Route::get('/client/investment/{id}', 'investment')->name('client.investment');
    Route::post('/client/investment/store/{investment_id}/{client_id}', 'investmentStore')->name('client.investment.store');
    Route::put('/client/investment/invest/{investment_id}/{client_id}', 'investmentInvest')->name('client.investment.invest');
    Route::put('/client/investment/retrieve/{investment_id}/{client_id}', 'investmentRetrieve')->name('client.investment.retrieve');
});

// Rotas relacionadas aos investimentos
Route::controller(InvestmentController::class)->group(function () {

    // Rotas para adicionar investimentos
    Route::get('/investment/create', 'create')->name('investment.create');
    Route::post('/investment/store', 'store')->name('investment.store');

    // Rotas para atualizar investimentos
    Route::get('/investment/edit/{id}', 'edit')->name('investment.edit');
    Route::put('/investment/update', 'update')->name('investment.update');

    // Rota para deletar investimentos
    Route::delete('/investment/destroy/{id}', 'destroy')->name('investment.destroy');

    // Rota para verificar os clientes que investem em um investimento
    Route::get('/investment/info/{id}', 'info')->name('investment.info');
});

require __DIR__.'/auth.php';
