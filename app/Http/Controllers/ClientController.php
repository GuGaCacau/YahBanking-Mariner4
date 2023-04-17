<?php

// Controlador de Clientes da Aplicação

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Regras de validação customizadas para clientes
use App\Http\Requests\ClientRequest;
use App\Http\Requests\ClientPatchRequest;

//Incluindo os Models para utilizar o Eloquent no controlador
use \App\Models\Client;
use \App\Models\Investment;

//Valor total padrão para cadastros novos
$valor_total = 5000;

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
        //Cliente específico pelo ID passado
        $client = Client::find($id);

        return view('client.client_edit', ['client' => $client]);
    }

    //Função para adicionar clientes no banco de dados
    public function post(ClientRequest $request)
    {        
        //Validando a existência da pasta "images" e pegando seu path
        $path = public_path('images/');
        !is_dir($path) &&
            mkdir($path, 0777, true);

        //Criando nome para a imagem do avatar de acordo com o horário
        $avatar_name = time() . '.' . $request->avatar->extension();
        
        //Salvando a imagem do avatar na pasta "public/images" do projeto
        $request->avatar->move($path, $avatar_name);
        $avatar_path = "images/".$avatar_name;

        //POST do novo cliente no banco de dados
        $client = new Client;
        $client->first_name = $request->first_name;
        $client->last_name = $request->last_name;
        $client->email = $request->email;
        $client->avatar = $avatar_path;
        $client->invested_amount = 0;
        $client->uninvested_amount = 5000;
        $client->save();

        return redirect('/')->with('success', 'Cadastro Realizado com Sucesso!');
    }

    //Função para atualizar clientes (sem novo avatar) no banco de dados
    public function patch(ClientPatchRequest $request, $id)
    {        
        //PATCH do cliente no banco de dados
        $client = Client::find($id);
        $client->first_name = $request->first_name;
        $client->last_name = $request->last_name;
        $client->email = $request->email;
        $client->save();

        return redirect('/')->with('success', 'Cadastro Atualizado com Sucesso!');
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
        $request->avatar->move($path, $avatar_name);
        $avatar_path = "images/".$avatar_name;

        //PATCH do cliente no banco de dados
        $client = Client::find($id);
        $client->first_name = $request->first_name;
        $client->last_name = $request->last_name;
        $client->email = $request->email;
        $client->avatar = $avatar_path;
        $client->save();

        return redirect('/')->with('success', 'Cadastro Atualizado com Sucesso!');
    }

    //Função para deletar um cliente
    public function delete($id)
    {
        //Cliente específico pelo ID passado
        $client = Client::find($id);

        $client->delete();

        return view('client.client_edit', ['client' => $client]);
    }

}
