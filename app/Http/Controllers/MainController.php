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
        $clients = Client::all();

        //return view('clients', ['clients' => $clients]);
        return Inertia::render('Clients', compact('clients'));
    }

    //Função para a rota de investimentos
    public function investments()
    {
        $investments = Investment::all();

        //return view('investments', ['investments' => $investments]);
        return Inertia::render('Investments', compact('investments'));
    }
}
