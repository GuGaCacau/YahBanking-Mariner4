<!-- Conexão com o Layout Padrão -->
@extends('layouts.master')

<!-- Título da Página -->
@section('title', 'Editar - Investimento')
    
<!-- Corpo da Página -->
@section('content')

        <!-- Mensagens de erro tiradas do ClientRequest -->
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    
    <!-- Formulário para Atualização de um Cliente -->
    <div class="col-5 container mt-4 px-5 border border-4 border-dark rounded-3">
        <h4 class="text-light mt-4 mb-4 text-center">Atualização de Investimento</h4>
        <form id="form_head" style="color:white" action="{{ route("investment.patch", $investment->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <!-- Input do Nome -->
            <div class="form-outline mb-2">
            <input type="text" class="form-control" name="commercial_name" value="{{$investment->commercial_name}}"/>
            <label class="form-label">Nome Comercial</label>
            </div>
        
            <!-- Input do Sigla -->
            <div class="form-outline mb-2">
            <input type="text" class="form-control" name="commercial_sail" value="{{$investment->commercial_sail}}"/>
            <label class="form-label">Sigla Comercial</label>
            </div>

            <!-- Input do Descrição -->
            <div class="form-outline mb-2">
            <textarea type="text" class="form-control" name="description" rows="6">{{$investment->description}}</textarea>
            <label class="form-label">Descrição</label>
            </div>

            <!-- Botão de Atualizar -->
            <button type="submit" class="btn btn-primary btn-block mb-5">Atualizar</button>
        
        </form>
    </div>
@endsection