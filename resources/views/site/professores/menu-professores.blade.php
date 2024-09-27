@extends('layout.layout')

@section('title', 'Professores')

@section('content')

{{-- @dd($professores) --}}

@if (count($professores) == 0)
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center my-2">
          <h6>Professores</h6>
          <div class="col-4 d-flex justify-content-center align-items-center">
            <form action="/professores" method="GET"><input type="text" id="search" name="search" class="form-control" placeholder="Digite aqui..."></form>
            <a class="btn btn-link m-0" href="/professores">Ver todos os professores</a>
          </div>
          <div class="text-end">
            <a class="btn bg-gradient-info shadow-info m-0" href="/professores/cadastrar">Cadastrar novo professor</a>
            <a class="btn btn-outline-dark m-0" href="/"><i class="bi bi-arrow-left me-3 fw-bold"></i>Voltar</a>
          </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <p class="text-sm mb-0 text-uppercase font-weight-bold ps-4 mb-2">Não há nenhum professor cadastrado</p>
        </div>
      </div>
    </div>
  </div>
</div>
@else
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center my-2">
          <h6>Professores</h6>
          <div class="col-4 d-flex justify-content-center align-items-center">
            <form action="/professores" method="GET"><input type="text" id="search" name="search" class="form-control" placeholder="Digite aqui..."></form>
            <a class="btn btn-link m-0" href="/professores">Ver todos os professores</a>
          </div>
          <div class="text-end">
            <a class="btn bg-gradient-info shadow-info m-0" href="/professores/cadastrar">Cadastrar novo professor</a>
            <a class="btn btn-outline-dark m-0" href="/"><i class="bi bi-arrow-left me-3 fw-bold"></i>Voltar</a>
          </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Cpf</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Telefone</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Especialidades</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Dia</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Horário</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ações</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($professores as $professor)
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div>
                        <a href="/professores/perfil/{{$professor->id}}">
                          <img src="../assets/img/professores/{{$professor->image}}" class="avatar avatar-sm me-3" alt="user1">
                        </a>
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">{{$professor->nome}}</h6>
                        <p class="text-xs text-secondary mb-0">{{$professor->email}}</p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="cpf text-xs font-weight-bold mb-0">
                      {{$professor->cpf}}
                    </p>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">{{$professor->contato}}</p>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">{{$professor->especialidades->nome}}</p>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">
                      @foreach ($professor->horarios as $horario)
                        @if ($horario->dia == "Segunda")
                          @php
                              $segunda = $horario->dia
                          @endphp
                        @elseif ($horario->dia == "Terça")
                          @php
                            $terca = $horario->dia
                          @endphp
                        @elseif ($horario->dia == "Quarta")
                          @php
                            $quarta = $horario->dia
                          @endphp
                        @elseif ($horario->dia == "Quinta")
                          @php
                            $quinta = $horario->dia
                          @endphp
                        @elseif ($horario->dia == "Sexta")
                          @php
                            $sexta = $horario->dia
                          @endphp
                        @elseif ($horario->dia == "Sábado")
                          @php
                            $sabado = $horario->dia
                          @endphp
                        @endif
                      @endforeach
                      @isset($segunda)
                        {{$segunda}} <br>
                      @endisset
                      @isset($terca)
                        {{$terca}}<br>
                      @endisset
                      @isset($quarta)
                        {{$quarta}}<br>
                      @endisset
                      @isset($quinta)
                        {{$quinta}}<br>
                      @endisset
                      @isset($sexta)
                        {{$sexta}}<br>
                      @endisset
                      @isset($sabado)
                        {{$sabado}}
                      @endisset
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">
                      @foreach ($professor->horarios as $horario)
                        @if ($horario->dia == "Segunda")
                          @php
                              $segundaInicio = $horario->inicio;
                              $segundaFim = $horario->fim;
                          @endphp
                        @elseif ($horario->dia == "Terça")
                          @php
                            $tercaInicio = $horario->inicio;
                            $tercaFim = $horario->fim;
                          @endphp
                        @elseif ($horario->dia == "Quarta")
                          @php
                            $quartaInicio = $horario->inicio;
                            $quartaFim = $horario->fim;
                          @endphp
                        @elseif ($horario->dia == "Quinta")
                          @php
                            $quintaInicio = $horario->inicio;
                            $quintaFim = $horario->fim;
                          @endphp
                        @elseif ($horario->dia == "Sexta")
                          @php
                            $sextaInicio = $horario->inicio;
                            $sextaFim = $horario->fim;
                          @endphp
                        @elseif ($horario->dia == "Sábado")
                          @php
                            $sabadoInicio = $horario->inicio;
                            $sabadoFim = $horario->fim;
                          @endphp
                        @endif
                      @endforeach
                      @isset($segunda)
                        {{$segundaInicio}}h às {{$segundaFim}}h <br>
                      @endisset
                      @isset($terca)
                        {{$tercaInicio}}h às {{$tercaFim}}h <br>
                      @endisset
                      @isset($quarta)
                        {{$quartaInicio}}h às {{$quartaFim}}h <br>
                      @endisset
                      @isset($quinta)
                        {{$quintaInicio}}h às {{$quintaFim}}h <br>
                      @endisset
                      @isset($sexta)
                        {{$sextaInicio}}h às {{$sextaFim}}h <br>
                      @endisset
                      @isset($sabado)
                        {{$sabadoInicio}}h às {{$sabadoFim}}h <br>
                      @endisset
                    </p>
                  </td>
                  <td class="text-center">
                    <a class="btn btn-link text-success text-gradient mb-0" href="/professores/treinos/{{$professor->id}}">Treinos</a>
                    <a class="btn btn-link mb-0" href="/professores/editar/{{$professor->id}}">Editar</a>
                    <form id="{{$professor->id}}" class="d-inline" action="/professores/deletar/{{$professor->id}}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button class="excluir btn btn-link text-danger text-gradient mb-0" value="{{$professor->id}}">Excluir</button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    {{$professores->links()}}
  </div>
@endif
<script>

  $('.excluir').click(function (e) { 
    e.preventDefault();

    var idProfessor = $(this).val();

    Swal.fire({
      title: "Confirmar exclusão?",
      text: "Não será possível reverter depois!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#228B22",
      cancelButtonColor: "#d33",
      cancelButtonText: "Cancelar",
      confirmButtonText: "Sim, excluir!"
    }).then((result) => {
      if (result.isConfirmed) {
        var formulario = document.getElementById(idProfessor)
        formulario.submit()
      }
    });
  });

</script>
@endsection