<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

// Regras de validação customizadas para clientes
use App\Http\Requests\InvestmentRequest;
use App\Http\Requests\InvestmentStoreRequest;

//Incluindo os Models para utilizar o Eloquent no controlador
use \App\Models\Client;
use App\Models\ClientInvestment;
use \App\Models\Investment;
use Illuminate\Support\Facades\DB;

class InvestmentController extends Controller
{
    //Função para ir à tela de adicionar um investimento
    public function create()
    {
        return Inertia::render('Investment/InvestmentCreate');
    }

    //Função para adicionar investimentos no banco de dados
    public function store(InvestmentStoreRequest $request)
    {
        //POST do novo investimento no banco de dados
        Investment::create($request->validated());

        return redirect()->route('investments')
            ->with('message', "Investimento cadastrado com Sucesso!");
    }

    //Função para ir à tela de atualizar um investimento
    public function edit($id)
    {
        //Investimento específico pelo ID passado, volta caso não seja um ID válido
        if(!$investment = Investment::find($id)){
            return back();
        }

        return Inertia::render('Investment/InvestmentEdit', compact('investment'));
    }

    //Função para atualizar investimentos no banco de dados
    public function patch(InvestmentRequest $request, $id)
    {
        //PATCH do investimento no banco de dados
        Investment::find($id)
            ->update($request->all());

        return redirect()->route('investments')->with('message', 'Cadastro Atualizado com Sucesso!');
    }

    //Função para ir à tela de info de um investimento
    public function info($id)
    {
        //Investimento específico pelo ID passado, volta caso não seja um ID válido
        if(!$investment = Investment::find($id)){
            return back();
        }

        //Investimentos do Cliente
        $clients = DB::table('client_investment')
            ->where('investment_id', '=', $id)
            ->join('clients', 'client_investment.client_id', '=', 'clients.id')
            ->select('clients.*', 'client_investment.investment_amount')
            ->get();

        return view('investment.investment_info', compact('investment', 'clients'));
    }

    //Função para deletar um investimento
    public function destroy($id)
    {
        //Acessando todos os investimentos de clientes feitos nesse investimento
        $client_investments = ClientInvestment::select('*')->where("client_investment.investment_id", '=', $id)->get();

        foreach ($client_investments as $client_investment) {
            //Devolvendo os valores aplicados a cada cliente que possui esse investimento
            $client = Client::find($client_investment->client_id);
            $client->uninvested_amount = $client->uninvested_amount + $client_investment->investment_amount;
            $client->invested_amount = $client->invested_amount - $client_investment->investment_amount;
            $client->save();
            $client_investment->delete();
        }

        //Investimento específico pelo ID passado
        $investment = Investment::find($id);

        $investment->delete();

        return redirect()->route('investments')
            ->with('success', 'Investimento excluído com Sucesso!');
    }
}
