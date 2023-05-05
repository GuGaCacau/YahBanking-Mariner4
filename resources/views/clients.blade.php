<!-- Conexão com o Layout Padrão -->
@extends('layouts.master')

<!-- Título da Página -->
@section('title', 'Clientes')

<!-- Ativando o link "clientes" da navbar -->
@section('navbar-clients')
    active
@endsection

<!-- Array com todos os textos da cabeça da table-->
@php
$table_head = [
    "Avatar",
    "Nome",
    "Sobrenome",
    "Email",
    "Valor Total",
    "Valor Investido",
    "Valor não Investido",
    "Editar",
    "Investimento",
    "Deletar",
];
@endphp
    
<!-- Corpo da Página -->
@section('content')

    <!-- Mensagem de alerta de sucesso -->
    @if (session()->has('success'))
        <div class="col-4 container alert alert-primary">
                {{ session()->get('success') }}
        </div>
    @endif

    <!-- Botão de adicionar clientes -->
    <div style="background-color:#262b2e;">
        <a class="btn btn-default add_btn" href="{{ route("client.add") }}"><i class="fa fa-add"></i> Adicionar Cliente</a>
    </div>

    <!-- Condição para caso não haja cadastro -->
    @if(isset($clients[0]->first_name)){
        <!-- Table da lista dos clientes -->
        <div class="table-responsive">
            <table class="table table-dark table-striped table-hover table-bordered">
                <thead>
                <tr>
                    <!-- Loop pegando os textos da cabeça da table -->
                    @foreach ($table_head as $item) 
                    <th class="text-center" scope="col">{{$item}}</th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                    <!-- Loop pegando as informações dos clientes e colocando na table -->
                    @foreach ($clients as $client)
                    <tr>
                        <td class="text-center" scope="col">
                            <img alt="Avatar" style="height:80px;width:80px;" src={{$client->avatar}}>
                        </td>
                        <td class="text-center" scope="col">{{$client->first_name}}</td>
                        <td class="text-center" scope="col">{{$client->last_name}}</td>
                        <td class="text-center" scope="col">{{$client->email}}</td> 
                        <td class="text-center" scope="col">R$
                        {{number_format(($client->uninvested_amount + $client->invested_amount), 2, ',','.');}}
                        </td>
                        <td class="text-center" scope="col">R$
                        {{number_format($client->invested_amount, 2, ',','.');}}
                        </td>
                        <td class="text-center" scope="col">R$
                        {{number_format($client->uninvested_amount, 2, ',','.');}}
                        </td>
                        <td class="text-center" scope="col">
                            <a class="btn btn-default border-secondary" href="{{ route("client.edit", $client->id) }}"><i class="fa fa-pen-to-square"></i></a>
                        </td>  
                        <td class="text-center" scope="col">
                            <a class="btn btn-default invest_btn border-secondary" href="{{ route("client.investment", $client->id) }}"><i class="fa fa-money-bill-trend-up"></i></a>
                        </td> 
                        <td class="text-center" scope="col">
                            <a class="btn btn-default delete_btn border-secondary" data-toggle="modal" data-target=".delete_modal_{{$client->id}}"><i class="fa fa-trash-can"></i></a>
                        </td>

                        <!-- Modal de Delete-->
                        <div class="modal fade delete_modal_{{$client->id}}" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content border border-2">
                                <div class="modal-header">
                                <h5 class="modal-title" id="ModalLabel">Realmente deseja deletar esse cliente?</h5>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <img class="mx-2" alt="Avatar" style="height:80px;width:80px;" src={{$client->avatar}}>
                                    {{$client->first_name.' '.$client->last_name}}
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn modal-no-btn" data-dismiss="modal">Não</button>
                                <form action="{{ route("client.delete", $client->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                    <button type="submit" class="btn modal-yes-btn">Sim</button>
                                </form>
                                </div>
                            </div>
                            </div>
                        </div> 
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    }
    @else{
        <div class="text-white ms-2">
            <h4>Nenhum Cliente está Cadastrado</h4>
        </div>
    }
    @endif
@endsection