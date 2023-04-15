<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Regras de validação customizadas para clientes
use App\Http\Requests\InvestmentRequest;

//Incluindo os Models para utilizar o Eloquent no controlador
use \App\Models\Client;
use \App\Models\Investment;

class InvestmentController extends Controller
{
    //Função para ir à tela de adicionar um investimento
    public function add()
    {
        return view('investment.investment_add');
    }

    //Função para adicionar investimentos no banco de dados
    public function post(InvestmentRequest $request)
    {        
        //POST do novo investimento no banco de dados
        $investment = new Investment;
        $investment->commercial_name = $request->commercial_name;
        $investment->commercial_sail = $request->commercial_sail;
        $investment->description = $request->description;
        $investment->save();

        return redirect('/investments')->with('success', 'Cadastro Realizado com Sucesso!');
    }
}
