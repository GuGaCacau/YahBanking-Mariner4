<!-- Conexão com o Layout Padrão -->
@extends('layouts.master')

<!-- Título da Página -->
@section('title', 'Cadastro - Clientes')
    
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
    
    <!-- Formulário para Cadastro de novo Cliente -->
    <div class="col-4 container mt-5">
        <form style="color:white" action="{{url('/client_post')}}" method="post" enctype="multipart/form-data">
        @csrf
            <!-- Input do Nome -->
            <div class="form-outline mb-2">
            <input type="text" class="form-control" name="first_name"/>
            <label class="form-label">Nome</label>
            </div>
        
            <!-- Input do Sobrenome -->
            <div class="form-outline mb-2">
            <input type="text" class="form-control" name="last_name"/>
            <label class="form-label">Sobrenome</label>
            </div>

            <!-- Input do Email -->
            <div class="form-outline mb-2">
            <input type="text" class="form-control" name="email"/>
            <label class="form-label">Email</label>
            </div>

            <!-- Input do Avatar -->
            <div class="form-outline mb-2">
                <input type="file" class="form-control" name="avatar" placeholder="Escolha um Avatar"/>
                <label class="form-label">Avatar</label>
            </div>
        
            <!-- Botão de Cadastro -->
            <button type="submit" class="btn btn-primary btn-block mb-5">Cadastrar</button>
        
        </form>
    </div>
@endsection