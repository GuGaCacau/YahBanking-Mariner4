<!-- Conexão com o Layout Padrão -->
@extends('layouts.master')

<!-- Título da Página -->
@section('title', 'Editar - Cliente')
    
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
        <h4 class="text-light mt-4 mb-4 text-center">Atualização de Cliente</h4>
        <form id="form_head" style="color:white" action="{{ route("client.patch", $client->id) }}" method="post" enctype="multipart/form-data">
        @csrf
            <!-- Input do Nome -->
            <div class="form-outline mb-2">
            <input type="text" class="form-control" name="first_name" value="{{$client->first_name}}"/>
            <label class="form-label">Nome</label>
            </div>
        
            <!-- Input do Sobrenome -->
            <div class="form-outline mb-2">
            <input type="text" class="form-control" name="last_name" value="{{$client->last_name}}"/>
            <label class="form-label">Sobrenome</label>
            </div>

            <!-- Input do Email -->
            <div class="form-outline mb-2">
            <input type="text" class="form-control" name="email" value="{{$client->email}}"/>
            <label class="form-label">Email</label>
            </div>

            <!-- Checkbox para Avatar -->
            <div class="form-check form-switch mb-2">
                <input id="checkbox" class="form-check-input" type="checkbox">
                <label class="form-check-label" for="flexSwitchCheckDefault">Deseja mudar o Avatar?</label>
            </div>

            <!-- Input do Avatar -->
            <div id="avatar_form" class="form-outline mb-2" style="display:none">
                <img class="img-fluid mb-2" src="{{asset($client->avatar)}}" alt="Avatar" style="height:70px;width:70px;">
                <input type="file" class="form-control" name="avatar" placeholder="Escolha um Avatar" value="{{$client->avatar}}"/>
                <label class="form-label">Avatar</label>
            </div>
        
            <!-- Botão de Atualizar -->
            <button type="submit" class="btn btn-primary btn-block mb-5">Atualizar</button>
        
        </form>
    </div>

    <script>
        //Mostrar Avatar caso o checkbox seja ativado
        var checkbox = document.getElementById('checkbox');
        var avatar_form = document.getElementById('avatar_form');
        var form_head = document.getElementById('form_head');
        checkbox.onclick = function() {
            if(this.checked) {
                avatar_form.style['display'] = 'block';
                form_head.action = '{{ route("client.patch.avatar", $client->id) }}';
            } else {
                avatar_form.style['display'] = 'none';
                form_head.action = '{{ route("client.patch", $client->id) }}';
            }
        };
    </script>
@endsection