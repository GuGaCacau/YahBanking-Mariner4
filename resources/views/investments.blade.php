<!-- Conexão com o Layout Padrão -->
@extends('layouts.master')

<!-- Título da Página -->
@section('title', 'Investimentos')

<!-- Ativando o link "investimentos" da navbar -->
@section('navbar-investments')
    active
@endsection
    
<!-- Array com todos os textos da cabeça da table-->
@php
$table_head = [
    "Nome",
    "Sigla",
    "Editar",
    "Visualizar",
    "Encerrar",
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

    <!-- Botão de adicionar investimentos -->
    <div style="background-color:#262b2e;">
        <a class="btn btn-default add_btn" href="/investment_add"><i class="fa fa-add"></i> Adicionar Investimento</a>
    </div>

    <!-- Table da lista dos investimentos -->
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
                <!-- Loop pegando as informações dos investimentos e colocando na table -->
                @foreach ($investments as $investment)
                <tr> 
                    <td class="text-center" scope="col">{{$investment->commercial_name}}</td>
                    <td class="text-center" scope="col">{{$investment->commercial_sail}}</td>
                    <td class="text-center" scope="col">
                        <a class="btn btn-default border-secondary" href="/investment_edit/{{$investment->id}}"><i class="fa fa-pen-to-square"></i></a>
                    </td>  
                    <td class="text-center" scope="col">
                        <a class="btn btn-default border-secondary"><i class="fa fa-search"></i></a>
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