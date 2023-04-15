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
        <a class="btn btn-default add_btn" href="/client_add"><i class="fa fa-add"></i> Adicionar Cliente</a>
    </div>

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
                    {{number_format(($client->uninvested_amount - $client->invested_amount), 2, ',','.');}}
                    </td>
                    <td class="text-center" scope="col">R$
                    {{number_format($client->invested_amount, 2, ',','.');}}
                    </td>
                    <td class="text-center" scope="col">R$
                    {{number_format($client->uninvested_amount, 2, ',','.');}}
                    </td>
                    <td class="text-center" scope="col">
                        <a class="btn btn-default border-secondary"><i class="fa fa-pen-to-square"></i></a>
                    </td>  
                    <td class="text-center" scope="col">
                        <a class="btn btn-default invest_btn border-secondary"><i class="fa fa-money-bill-trend-up"></i></a>
                    </td> 
                    <td class="text-center" scope="col">
                        <a class="btn btn-default delete_btn border-secondary"><i class="fa fa-trash-can"></i></a>
                    </td> 
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection