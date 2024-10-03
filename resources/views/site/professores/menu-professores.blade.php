@extends('layout.layout')

@section('title', 'Professores')

@section('content')

{{-- @dd($professores) --}}

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center my-2" id="header-professores-responsive">
          <div class="d-flex flex-column justify-content-between mb-2">
            <h6 class="mt-0">Professores</h6>
            <div class="w-100 mb-0">
              <form action="/professores" method="GET"><input type="text" id="search" name="search" class="form-control" maxlength="11"  placeholder="Digite o CPF do professor"></form>
            </div>
          </div>
          <div class="d-flex flex-column gap-2">
            <a class="btn bg-gradient-info shadow-info m-0" href="/professores/cadastrar">Cadastrar novo professor</a>
            <a class="btn btn-outline-dark m-0" href="/"><i class="bi bi-arrow-left me-3 fw-bold"></i>Voltar</a>
          </div>
        </div>
        <div class="card-header pb-0 d-flex justify-content-between align-items-center my-2" id="header-professores">
          <h6>Professores</h6>
          <div class="col-4">
            <form action="/professores" method="GET"><input type="text" id="search" name="search" class="form-control" maxlength="11" placeholder="Digite o CPF do professor"></form>
          </div>
          <div class="text-end">
            <a class="btn bg-gradient-info shadow-info m-0" href="/professores/cadastrar">Cadastrar novo professor</a>
            <a class="btn btn-outline-dark m-0" href="/"><i class="bi bi-arrow-left me-3 fw-bold"></i>Voltar</a>
          </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          @if ($professores == 'menu')
          <p class="text-sm mb-0 text-uppercase font-weight-bold ps-4 mb-2">Digite o CPF do professor!</p>
          @elseif($professores != 'menu' && count($professores) == 0)
          <p class="text-sm mb-0 text-uppercase font-weight-bold ps-4 mb-2">Não há nenhum professor registrado com o cpf: {{$search}}</p>
          @else
          <div class="accordion accordion-flush" id="accordionProfessores">
            @foreach ($professores as $professor)
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed border-top border-bottom text-dark fw-bold fs-6" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$professor->id}}" aria-expanded="false" aria-controls="flush-collapseOne">
                  {{$professor->id}}- {{$professor->nome}}
                </button>
              </h2>
              <div id="flush-collapse{{$professor->id}}" class="accordion-collapse collapse" data-bs-parent="#accordionTreinosAlunos">
                <div class="accordion-body">
                  <h5>Dados Pessoais</h5>
                  <div class="mb-2">
                    <label class="form-label">Nome</label>
                    <input type="text" class="form-control" readonly value="{{$professor->nome}}">
                  </div>
                  <div class="mb-2">
                    <label class="form-label">CPF</label>
                    <input type="text" class="cpf form-control" readonly value="{{$professor->cpf}}">
                  </div>
                  <div class="mb-2">
                    <label class="form-label">Telefone</label>
                    <input type="text" class="form-control" readonly value="{{$professor->contato}}">
                  </div>
                  <div class="mb-2">
                    <label class="form-label">Especialidades</label>
                    <input type="text" class="form-control" readonly value="{{$professor->especialidades->nome}}">
                  </div>
                  <hr class="horizontal dark my-3">
                  <div class="mb-2">
                    <h5>Horário de trabalho</h5>
                  </div>
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
                      <div class="mb-1">
                        <label class="form-label">Segunda</label>
                        <input type="text" class="form-control" readonly value="{{$segundaInicio}} às {{$segundaFim}}">
                      </div>
                      @endisset
                      @isset($terca)
                      <div class="mb-1">
                        <label class="form-label">Terça</label>
                        <input type="text" class="form-control" readonly value="{{$tercaInicio}} às {{$tercaFim}}">
                      </div>
                      @endisset
                      @isset($quarta)
                      <div class="mb-1">
                        <label class="form-label">Quarta</label>
                        <input type="text" class="form-control" readonly value="{{$quartaInicio}} às {{$quartaFim}}">
                      </div>
                      @endisset
                      @isset($quinta)
                      <div class="mb-1">
                        <label class="form-label">Quinta</label>
                        <input type="text" class="form-control" readonly value="{{$quintaInicio}} às {{$quintaFim}}">
                      </div>
                      @endisset
                      @isset($sexta)
                      <div class="mb-1">
                        <label class="form-label">Sexta</label>
                        <input type="text" class="form-control" readonly value="{{$sextaInicio}} às {{$sextaFim}}">
                      </div>
                      @endisset
                      @isset($sabado)
                      <div class="mb-1">
                        <label class="form-label">Sábado</label>
                        <input type="text" class="form-control" readonly value="{{$sabadoInicio}} às {{$sabadoFim}}">
                      </div>
                      @endisset
                      <hr class="horizontal dark my-3">
                  <div class="mb-2">
                    <h5>Ações</h5>
                    <div class="d-flex">
                      <a class="btn btn-link text-success text-gradient mb-0 ps-1" href="/professores/treinos/{{$professor->id}}">Treinos</a>
                      <a class="btn btn-link mb-0" href="/professores/editar/{{$professor->id}}">Editar</a>
                      <form id="{{$professor->id}}" class="d-inline" action="/professores/deletar/{{$professor->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="excluir btn btn-link text-danger text-gradient mb-0" value="{{$professor->id}}">Excluir</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          <div class="table-responsive p-0" id="tabela-professores">
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