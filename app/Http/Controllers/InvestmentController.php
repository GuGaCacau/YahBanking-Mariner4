<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Regras de validação customizadas para clientes
use App\Http\Requests\InvestmentRequest;

//Incluindo os Models para utilizar o Eloquent no controlador
use \App\Models\Client;
use App\Models\client_investment;
use \App\Models\Investment;
use Illuminate\Support\Facades\DB;

class InvestmentController extends Controller
{
    //Função para ir à tela de adicionar um investimento
    public function add()
    {
        return view('investment.investment_add');
    }

    //Função para ir à tela de atualizar um investimento
    public function edit($id)
    {
        //Investimento específico pelo ID passado
        $investment = Investment::find($id);

        return view('investment.investment_edit', ['investment' => $investment]);
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

    //Função para atualizar investimentos no banco de dados
    public function patch(InvestmentRequest $request, $id)
    {
        //PATCH do investimento no banco de dados
        $investment = Investment::find($id);
        $investment->commercial_name = $request->commercial_name;
        $investment->commercial_sail = $request->commercial_sail;
        $investment->description = $request->description;
        $investment->save();

        return redirect('/investments')->with('success', 'Cadastro Atualizado com Sucesso!');
    }

    //Função para ir à tela de info de um investimento
    public function info($id)
    {
        //Investimentos do Cliente
        $clients = DB::table('client_investment')
            ->where('investment_id', '=', $id)
            ->join('clients', 'client_investment.client_id', '=', 'clients.id')
            ->select('clients.*', 'client_investment.investment_amount')
            ->get();

        //Investimento específico pelo ID passado
        $investment = Investment::find($id);

        return view('investment.investment_info', ['investment' => $investment, 'clients' => $clients]);
    }

    //Função para deletar um investimento
    public function delete($id)
    {
        //Acessando todos os investimentos de clientes feitos nesse investimento
        $client_investments = client_investment::select('*')->where("client_investment.investment_id", '=', $id)->get();

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

        return redirect('/investments')->with('success', 'Investimento excluído com Sucesso!');
    }
}
