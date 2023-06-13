<?php

// Controlador Principal da Aplicação

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

//Incluindo os Models para utilizar o Eloquent no controlador
use \App\Models\Client;
use \App\Models\Investment;

class MainController extends Controller
{
    //Função inicial da aplicação
    public function index()
    {

        //return Inertia::render('Clients', compact('clients'));
        return Inertia::render('Clients', [
            'clients' => Client::all()->map(function($client) {
                return [
                    'id' => $client->id,
                    'first_name' => $client->first_name,
                    'last_name' => $client->last_name,
                    'email' => $client->email,
                    'avatar' => $client->avatar,
                    'invested_amount' => $client->invested_amount,
                    'uninvested_amount' => $client->uninvested_amount,

                ];
            })
        ]);

    }

    //Função para a rota de investimentos
    public function investments()
    {
        $investments = Investment::all();

        return Inertia::render('Investments', compact('investments'));
    }
}
