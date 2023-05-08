<?php

// Controlador de Clientes da Aplicação

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Regras de validação customizadas para clientes
use App\Http\Requests\ClientRequest;
use App\Http\Requests\ClientPatchRequest;
use App\Http\Requests\InvestRetrieveRequest;

//Incluindo os Models para utilizar o Eloquent no controlador
use \App\Models\Client;
use App\Models\ClientInvestment;
use \App\Models\Investment;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    //Função para ir à tela de adicionar um cliente
    public function add()
    {
        return view('client.client_add');
    }

    //Função para ir à tela de atualizar um cliente
    public function edit($id)
    {
        //Cliente específico pelo ID passado, volta caso não seja um ID válido
        if(!$client = Client::find($id)){
            return back();
        }

        return view('client.client_edit', ['client' => $client]);
    }

    //Função para adicionar clientes no banco de dados
    public function post(ClientRequest $request)
    {
        //Incluindo constantes da aplicação (valor_total)
        include(app_path('includes/constants.php'));
        $constants = getConstants();

        //Validando a existência da pasta "images" e pegando seu path
        $path = public_path('images/');
        !is_dir($path) &&
            mkdir($path, 0777, true);

        //Criando nome para a imagem do avatar de acordo com o horário
        $avatar_name = time() . '.' . $request->avatar->extension();

        //Salvando a imagem do avatar na pasta "public/images" do projeto
        //TODO: Salvar imagem na Storage
        $request->avatar->move($path, $avatar_name);
        $avatar_path = "images/" . $avatar_name;

        //POST do novo cliente no banco de dados
        Client::create(
            array_merge($request->only('first_name', 'last_name', 'email'), [
                'avatar' => $avatar_path,
                'invested_amount' => 0,
                'uninvested_amount' => $constants["valor_total"]
            ])); 

        return redirect()->route('index')->with('success', "Cliente cadastrado(a) com Sucesso!");
    }

    //Função para atualizar clientes (sem novo avatar) no banco de dados
    public function patch(ClientPatchRequest $request, $id)
    {
        //PATCH do cliente no banco de dados
        Client::find($id)
            ->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email
            ]);

        return redirect()->route('index')->with('success', "Cliente atualizado(a) com Sucesso!");
    }

    //Função para atualizar clientes (com novo avatar) no banco de dados
    public function patch_with_avatar(ClientRequest $request, $id)
    {
        //Validando a existência da pasta "images" e pegando seu path
        $path = public_path('images/');
        !is_dir($path) &&
            mkdir($path, 0777, true);

        //Criando nome para a imagem do avatar de acordo com o horário
        $avatar_name = time() . '.' . $request->avatar->extension();

        //Salvando a imagem do avatar na pasta "public/images" do projeto
        //TODO: Salvar imagem na Storage
        $request->avatar->move($path, $avatar_name);
        $avatar_path = "images/" . $avatar_name;

        //PATCH do cliente no banco de dados
        Client::find($id)
            ->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'avatar' => $avatar_path
            ]);

        return redirect()->route('index')->with('success', "Cliente atualizado(a) com Sucesso!");
    }

    //Função para deletar um cliente
    public function delete($id)
    {
        //Acessando todos os investimentos feitos por esse cliente
        $client_investments = ClientInvestment::select('*')->where("client_investment.client_id", '=', $id)->get();

        foreach ($client_investments as $client_investment) {
            //Devolvendo os valores aplicados do cliente nesse investimento
            $client = Client::find($client_investment->client_id);
            $client->uninvested_amount = $client->uninvested_amount + $client_investment->investment_amount;
            $client->invested_amount = $client->invested_amount - $client_investment->investment_amount;
            $client->save();
            $client_investment->delete();
        }

        //Cliente específico pelo ID passado
        $client = Client::find($id);

        $client->delete();

        return redirect()->route('index')->with('success', 'Cliente excluído(a) com Sucesso!');
    }

    //Função para ir à tela de investimentos de um cliente
    public function investment($id)
    {
        //Cliente específico pelo ID passado, volta caso não seja um ID válido
        if(!$client = Client::find($id)){
            return back();
        }

        $investment_list = Investment::all();

        //Investimentos do Cliente
        $investments = DB::table('client_investment')
            ->where('client_id', '=', $id)
            ->join('investments', 'client_investment.investment_id', '=', 'investments.id')
            ->select('investments.id', 'client_investment.id AS invest_id', 'investments.commercial_name', 'investments.commercial_sail', 'client_investment.investment_amount')
            ->get();

        //Contador para a lógica
        $count = 0;

        //Investimentos não investidos pelo cliente
        foreach ($investment_list as $investment) {
            foreach ($investments as $invest) {
                if ($invest->id == $investment->id) {
                    $count++;
                    break;
                }
            }
            if ($count == 0) {
                $not_invested[] = $investment;
            }
            $count = 0;
        }

        //Caso não haja opção disponível de novo investimento
        if (!isset($not_invested)) {
            $not_invested = [];
        }

        return view('client.client_investment', ['client' => $client, 'investments' => $investments, 'not_invested' => $not_invested]);
    }

    //Função para adicionar valor investido do cliente em investimento no banco de dados
    public function invest(InvestRetrieveRequest $request, $invested_id, $client_id)
    {
        //Mudando vírgula para ponto a fim de guardar no banco de dados
        $new_valor = str_replace(",", ".", $request->new_valor);
        $new_valor = (float)$new_valor;

        //Acessando o cliente e sua relação com investimento do banco de dados
        $client = Client::find($client_id);
        $client_investment = ClientInvestment::find($invested_id);

        //Se o novo valor for maior que o disponível do cliente, retorna
        if ($new_valor  > $client->uninvested_amount) {
            return redirect()->route('client.investment', $client_id)->with('fail', 'Não é possível investir mais que o disponível!');
        }

        //Se o novo valor for menor que o disponível ou igual, computa o investimento
        $client->uninvested_amount = $client->uninvested_amount - $new_valor;
        $client->invested_amount = $client->invested_amount + $new_valor;
        $client_investment->investment_amount = $client_investment->investment_amount + $new_valor;
        $client->save();
        $client_investment->save();

        return redirect()->route('client.investment', $client_id)->with('success', 'Investimento Atualizado com Sucesso!');
    }

    //Função para resgatar valor investido do cliente em investimento no banco de dados
    public function retrieve(InvestRetrieveRequest $request, $invested_id, $client_id)
    {
        //Mudando vírgula para ponto a fim de guardar no banco de dados
        $new_valor = str_replace(",", ".", $request->new_valor);
        $new_valor = (float)$new_valor;

        //Acessando o cliente e sua relação com investimento do banco de dados
        $client = Client::find($client_id);
        $client_investment = ClientInvestment::find($invested_id);

        //Se o valor resgatado for maior que o investido, retorna
        if ($new_valor > $client_investment->investment_amount) {
            return redirect()->route('client.investment', $client_id)->with('fail', 'Não é possível resgatar um valor maior que o investido!');
        }
        //Se o valor resgatado for igual ao investido, deleta o investimento
        elseif ($new_valor == $client_investment->investment_amount) {
            $client->uninvested_amount = $client->uninvested_amount + $new_valor;
            $client->invested_amount = $client->invested_amount - $new_valor;
            $client->save();
            $client_investment->delete();
            return redirect()->route('client.investment', $client_id)->with('success', 'Investimento totalmente resgatado.');
        }

        //Se o valor resgatado for menor que o investido ou igual, computa o investimento
        $client->uninvested_amount = $client->uninvested_amount + $new_valor;
        $client->invested_amount = $client->invested_amount - $new_valor;
        $client_investment->investment_amount = $client_investment->investment_amount - $new_valor;
        $client->save();
        $client_investment->save();

        return redirect()->route('client.investment', $client_id)->with('success', 'Valor Resgatado com Sucesso!');
    }

    //Função para adicionar novo investimento de um cliente
    public function new_investment(InvestRetrieveRequest $request, $investment_id, $client_id)
    {
        //Mudando vírgula para ponto a fim de guardar no banco de dados
        $invest_valor = str_replace(",", ".", $request->new_valor);
        $invest_valor = (float)$invest_valor;

        //Acessando o cliente do banco de dados
        $client = Client::find($client_id);

        //Se o novo valor for maior que o disponível do cliente, retorna
        if ($invest_valor  > $client->uninvested_amount) {
            return redirect()->route('client.investment', $client_id)->with('fail', 'Não é possível investir mais que o disponível!');
        }

        //Se o novo valor for menor que o disponível ou igual, computa o novo investimento
        $client->uninvested_amount = $client->uninvested_amount - $invest_valor;
        $client->invested_amount = $client->invested_amount + $invest_valor;
        $client->save();
        ClientInvestment::create([
                'client_id' => $client_id,
                'investment_id' => $investment_id,
                'investment_amount' => $invest_valor
        ]); 

        return redirect()->route('client.investment', $client_id)->with('success', 'Novo Investimento Realizado com Sucesso!');
    }
}
