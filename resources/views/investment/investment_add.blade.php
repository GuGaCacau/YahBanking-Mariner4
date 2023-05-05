<!-- Conexão com o Layout Padrão -->
@extends('layouts.master')

<!-- Título da Página -->
@section('title', 'Cadastro - Investimentos')
    
<!-- Corpo da Página -->
@section('content')

        <!-- Mensagens de erro tiradas do InvestmentRequest -->
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    
    <!-- Formulário para Cadastro de novo Investimento -->
    <div class="col-5 container mt-4 px-5 border border-4 border-dark rounded-3">
        <h4 class="text-light mt-4 mb-4 text-center">Cadastro de Investimentos</h4>
        <form style="color:white" action="{{ route("investment.post") }}" method="post" enctype="multipart/form-data">
        @csrf
            <!-- Input do Nome -->
            <div class="form-outline mb-2">
            <input type="text" class="form-control" name="commercial_name"/>
            <label class="form-label">Nome Comercial</label>
            </div>
        
            <!-- Input da Sigla -->
            <div class="form-outline mb-2">
            <input type="text" class="form-control" name="commercial_sail"/>
            <label class="form-label">Sigla Comercial</label>
            </div>

            <!-- Input do Descrição -->
            <div class="form-outline mb-2">
            <textarea type="text" class="form-control" name="description" rows="6"></textarea>
            <label class="form-label">Descrição</label>
            </div>
        
            <!-- Botão de Cadastro -->
            <button type="submit" class="btn btn-primary btn-block mb-5">Cadastrar</button>
        
        </form>
    </div>
@endsection