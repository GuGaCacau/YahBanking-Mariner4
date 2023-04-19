<!-- Conexão com o Layout Padrão -->
@extends('layouts.master')

<!-- Título da Página -->
@section('title', 'Investimentos - Info')
    
<!-- Array com todos os textos da cabeça da table-->
@php
$table_head = [
    "Avatar",
    "Nome",
    "Sobrenome",
    "Email",
    "Valor nesse Investimento",
];
@endphp

<!-- Corpo da Página -->
@section('content')

    <!-- Condição para caso não haja cadastro -->
    @if(isset($clients[0]->first_name)){

        <!-- Label da table -->
        <div class="text-white ms-2 mb-3">
            <h5>Lista de Clientes que investem em {{$investment->commercial_name}}</h5>
        </div>

        <!-- Table da lista dos clientes com investimento -->
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
                            <img alt="Avatar" style="height:80px;width:80px;" src={{asset($client->avatar)}}>
                        </td>
                        <td class="text-center" scope="col">{{$client->first_name}}</td>
                        <td class="text-center" scope="col">{{$client->last_name}}</td>
                        <td class="text-center" scope="col">{{$client->email}}</td> 
                        <td class="text-center" scope="col">R$
                        {{number_format(($client->investment_amount), 2, ',','.');}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    }
    @else{
        <div class="text-white ms-2">
            <h4>Nenhum Cliente investe em {{$investment->commercial_name}}</h4>
        </div>
    }
    @endif

@endsection