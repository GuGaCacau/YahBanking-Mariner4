<!-- Conexão com o Layout Padrão -->
@extends('layouts.master')

<!-- Título da Página -->
@section('title', 'Investimentos - Cliente')
    
<!-- Array com todos os textos da cabeça da table-->
@php
$table_head = [
    "Nome Comercial",
    "Sigla Comercial",
    "Valor Investido",
    "Investir Valor",
    "Resgatar Valor",
];
@endphp

<!-- Array com todos os textos da cabeça da segunda table-->
@php
$second_table_head = [
    "Nome Comercial",
    "Sigla Comercial",
    "Começar a Investir",
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

<!-- Mensagem de alerta de falha -->
@if (session()->has('fail'))
<div class="col-4 container alert alert-danger">
        {{ session()->get('fail') }}
</div>
@endif

<!-- Containers com as informações do Cliente -->
<div class="row">
    <div class="col-lg-3 ms-5">
      <div class="card mb-4 avatar_card border border-1">
        <div class="card-body text-center">
          <img src="{{asset($client->avatar)}}" alt="avatar"
            class="rounded-circle img-fluid" style="width: 150px;">
          <h5 class="my-3">{{$client->first_name.' '.$client->last_name}}</h5>
          <div class="d-flex justify-content-center mb-2">
            <button class="btn btn-secondary">R$
                {{number_format(($client->uninvested_amount), 2, ',','.');}}</button>
            <button class="btn btn-success ms-1">R$
                {{number_format(($client->invested_amount), 2, ',','.');}}</button>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-8 ms-2">
        <div class="card mb-4 body_card border border-1
        ">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0 text-white">Nome</p>
              </div>
              <div class="col-sm-9">
                <p class="text-white opacity-75 mb-0">{{$client->first_name}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0 text-white">Sobrenome</p>
              </div>
              <div class="col-sm-9">
                <p class="text-white opacity-75 mb-0">{{$client->last_name}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0 text-white">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-white opacity-75 mb-0">{{$client->email}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0 text-white">Valor Não Investido</p>
              </div>
              <div class="col-sm-9">
                <p class="text-white opacity-75 mb-0">R$
                    {{number_format(($client->uninvested_amount), 2, ',','.');}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0 text-white">Valor Investido</p>
              </div>
              <div class="col-sm-9">
                <p class="text-white opacity-75 mb-0">R$
                    {{number_format(($client->invested_amount), 2, ',','.');}}</p>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>

<div class="text-white ms-2">
    <h4><i class="fa fa-money-bill-trend-up" style="color: green"></i> Investimentos Atuais</h4>
</div>

<!-- Condição para caso não haja investimento -->
@if(isset($investments[0]->commercial_name)){
    <!-- Table da lista de investientos do cliente -->
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
                <!-- Loop pegando as informações dos investimentos do cliente e colocando na table -->
                @foreach($investments as $investment)
                <tr>
                    <td class="text-center" scope="col">{{$investment->commercial_name}}</td>
                    <td class="text-center" scope="col">{{$investment->commercial_sail}}</td> 
                    <td class="text-center" scope="col">R$
                    {{number_format(($investment->investment_amount), 2, ',','.');}}
                    </td>
                    <td class="text-center" scope="col">
                        <a class="btn btn-default invest_btn border-secondary" data-toggle="modal" data-target=".invest_modal_{{$investment->invest_id}}"><i class="fa fa-money-bill-trend-up"></i></a>
                    </td>
                    <td class="text-center" scope="col">
                        <a class="btn btn-default border-secondary" data-toggle="modal" data-target=".retrieve_modal_{{$investment->invest_id}}"><i class="fa fa-delete-left"></i></a>
                    </td>

                    <!-- Modal de Investir-->
                    <div class="modal fade invest_modal_{{$investment->invest_id}}" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content border border-2">
                            <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">Quanto mais deseja investir?</h5>
                            </button>
                            </div>
                            <div class="modal-body">
                                {{$investment->commercial_name.' '}}&middot;{{' '.$investment->commercial_sail}}
                                <br>
                                Valor já investido: R$
                                {{number_format(($investment->investment_amount), 2, ',','.');}}
                                <br>
                                Valor disponível: R$
                                {{number_format(($client->uninvested_amount), 2, ',','.');}}
                                <form action="{{url("/client_invest/$investment->invest_id/$client->id")}}" method="post">
                                @csrf
                                    <div class="form-outline mt-3">
                                      <input type="text" class="form-control" name="new_valor" id="recipient-name">
                                    </div>
                                    <div class="row justify-content-end">
                                        <button type="button" class="btn modal-no-btn mt-3 col-2" data-dismiss="modal">Voltar</button>
                                        <button type="submit" class="btn modal-yes-btn mt-3 mx-3 col-2">Investir</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        </div>
                    </div>

                    <!-- Modal de Resgatar-->
                    <div class="modal fade retrieve_modal_{{$investment->invest_id}}" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content border border-2">
                            <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">Qual valor deseja resgatar?</h5>
                            </button>
                            </div>
                            <div class="modal-body">
                                {{$investment->commercial_name.' '}}&middot;{{' '.$investment->commercial_sail}}
                                <br>
                                Valor investido: R$
                                {{number_format(($investment->investment_amount), 2, ',','.');}}
                                <br>
                                <form action='{{url("/client_retrieve/$investment->invest_id/$client->id")}}' method="post">
                                @csrf
                                    <div class="form-outline mt-3">
                                      <input type="text" class="form-control" name="retrieve_valor" id="recipient-name">
                                    </div>
                                    <div class="row justify-content-end">
                                        <button type="button" class="btn modal-no-btn mt-3 col-2" data-dismiss="modal">Voltar</button>
                                        <button type="submit" class="btn modal-yes-btn mt-3 mx-3 px-2 col-2">Resgatar</button>
                                    </div>
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
        <h4>Esse Cliente não possui nenhum investimento</h4>
    </div>
}
@endif

<div class="text-white ms-2 mt-3">
  <h4><i class="fa fa-caret-up" style="color: greenyellow"></i> Investimentos Disponíveis</h4>
</div>

<!-- Condição para caso haja investimento em todas as opções -->
@if(isset($not_invested[0]->commercial_name)){
  <!-- Table da lista de investientos do cliente -->
  <div class="table-responsive">
      <table class="table table-dark table-striped table-hover table-bordered">
          <thead>
          <tr>
              <!-- Loop pegando os textos da cabeça da table -->
              @foreach ($second_table_head as $item2) 
              <th class="text-center" scope="col">{{$item2}}</th>
              @endforeach
          </tr>
          </thead>
          <tbody>
              <!-- Loop pegando as informações dos demais investimentos colocando na table -->
              @foreach ($not_invested as $investment2)
              <tr>
                  <td class="text-center" scope="col">{{$investment2->commercial_name}}</td>
                  <td class="text-center" scope="col">{{$investment2->commercial_sail}}</td> 
                  <td class="text-center" scope="col">
                      <a class="btn btn-default invest_btn border-secondary" data-toggle="modal" data-target=".invest_modal_{{$investment2->id}}"><i class="fa fa-money-bill-trend-up"></i></a>
                  </td>

                  <!-- Modal de Investir-->
                  <div class="modal fade invest_modal_{{$investment2->id}}" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                      <div class="modal-content border border-2">
                          <div class="modal-header">
                          <h5 class="modal-title" id="ModalLabel">Quanto deseja investir?</h5>
                          </button>
                          </div>
                          <div class="modal-body">
                              {{$investment2->commercial_name.' '}}&middot;{{' '.$investment2->commercial_sail}}
                              <br>
                              Valor disponível: R$
                              {{number_format(($client->uninvested_amount), 2, ',','.');}}
                              <form action='{{url("/client_new_invest/$investment2->id/$client->id")}}' method="post">
                              @csrf
                                  <div class="form-outline mt-3">
                                    <input type="text" class="form-control" name="invest_valor" id="recipient-name">
                                  </div>
                                  <div class="row justify-content-end">
                                      <button type="button" class="btn modal-no-btn mt-3 col-2" data-dismiss="modal">Voltar</button>
                                      <button type="submit" class="btn modal-yes-btn mt-3 mx-3 col-2">Investir</button>
                                  </div>
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
      <h4>Não há Investimentos disponíveis</h4>
  </div>
}
@endif

@endsection