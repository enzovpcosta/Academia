@extends('layout.layout')

@section('title', 'Alunos')

@section('content')

{{-- @dd($alunos) --}}

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center my-2" id="header-alunos-responsive">
          <div class="d-flex flex-column justify-content-between mb-2">
            <h6 class="mt-0">Alunos</h6>
            <div class="w-100 mb-0">
              <form action="/alunos" method="GET"><input type="text" id="search" name="search" class="form-control" maxlength="11" placeholder="Digite o CPF do aluno"></form>
            </div>
          </div>
          <div class="d-flex flex-column gap-2">
            <a class="btn bg-gradient-info shadow-info m-0" href="/alunos/cadastrar">Cadastrar novo aluno</a>
            <a class="btn btn-outline-dark m-0" href="/"><i class="bi bi-arrow-left me-3 fw-bold"></i>Voltar</a>
          </div>
        </div>
        <div class="card-header pb-0 d-flex justify-content-between align-items-center my-2" id="header-alunos">
          <h6>Alunos</h6>
          <div class="col-4">
            <form action="/alunos" method="GET"><input type="text" id="search" name="search" class="form-control" maxlength="11" placeholder="Digite o CPF do aluno"></form>
          </div>
          <div class="text-end">
            <a class="btn bg-gradient-info shadow-info m-0" href="/alunos/cadastrar">Cadastrar novo aluno</a>
            <a class="btn btn-outline-dark m-0" href="/"><i class="bi bi-arrow-left me-3 fw-bold"></i>Voltar</a>
          </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          @if ($alunos == 'menu')
          <p class="text-sm mb-0 text-uppercase font-weight-bold ps-4 mb-2">Digite o CPF do aluno!</p>
          @elseif($alunos != 'menu' && count($alunos) == 0)
          <p class="text-sm mb-0 text-uppercase font-weight-bold ps-4 mb-2">Não há nenhum aluno registrado com o cpf: {{$search}}</p>
          @else
          <div class="accordion accordion-flush" id="accordionAlunos">
            @foreach ($alunos as $aluno)
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed border-top border-bottom text-dark fw-bold fs-6" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$aluno->id}}" aria-expanded="false" aria-controls="flush-collapseOne">
                  {{$aluno->id}}- {{$aluno->nome}}
                </button>
              </h2>
              <div id="flush-collapse{{$aluno->id}}" class="accordion-collapse collapse" data-bs-parent="#accordionTreinosAlunos">
                <div class="accordion-body">
                  <h5>Dados Pessoais</h5>
                  <div class="mb-2">
                    <label class="form-label">Nome</label>
                    <input type="text" class="form-control" readonly value="{{$aluno->nome}}">
                  </div>
                  <div class="mb-2">
                    <label class="form-label">CPF</label>
                    <input type="text" class="cpf form-control" readonly value="{{$aluno->cpf}}">
                  </div>
                  <div class="mb-2">
                    <label class="form-label">Telefone</label>
                    <input type="text" class="form-control" readonly value="{{$aluno->contato}}">
                  </div>
                  <hr class="horizontal dark my-3">
                  <h5>Assinatura</h5>
                  <div class="mb-2">
                    <label class="form-label">Plano</label>
                    <input type="text" class="form-control" readonly value="{{$aluno->assinatura->plano}}">
                  </div>
                  <div class="mb-2">
                    <label class="form-label">Data de aquisição</label>
                    <input type="email" class="tel form-control" readonly value="{{date('d/m/Y', strtotime($aluno->assinatura->obtencao))}}">
                  </div>
                  <div class="mb-2">
                    <label class="form-label">Data de vencimento</label>
                    <input type="text" class="tel form-control" readonly value="{{date('d/m/Y', strtotime($aluno->assinatura->vencimento))}}">
                  </div>
                  <div class="mb-2 d-flex flex-column">
                    <label class="form-label">Status</label>
                    @if ($aluno->assinatura->ativo == true)
                    <span class="col-md-1 badge badge-sm bg-gradient-success">Ativo</span>
                    @else
                    <span class="col-md-1 badge badge-sm bg-gradient-dark">Inativo</span>
                    @endif
                  </div>
                  <div class="mb-2">
                    <label class="form-label">Ações</label>
                    <div class="d-flex">
                      <a class="btn btn-link text-success text-gradient mb-0 ps-1" href="/alunos/treinos/{{$aluno->id}}">Treinos</a>
                    <a class="btn btn-link mb-0" href="/alunos/editar/{{$aluno->id}}">Editar</a>
                    <form id="{{$aluno->id}}" class="d-inline" action="/alunos/deletar/{{$aluno->id}}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button class="excluir btn btn-link text-danger text-gradient mb-0" value="{{$aluno->id}}">Excluir</button>
                    </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          <div class="table-responsive p-0" id="tabela-alunos">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Cpf</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Telefone</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Plano</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Data de aquisição</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Data de vencimento</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ações</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($alunos as $aluno)
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div>
                        <a href="/alunos/perfil/{{$aluno->id}}">
                          <img src="../assets/img/alunos/{{$aluno->image}}" class="avatar avatar-sm me-3" alt="{{$aluno->image}}">
                        </a>
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">{{$aluno->nome}}</h6>
                        <p class="text-xs text-secondary mb-0">{{$aluno->email}}</p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="cpf text-xs font-weight-bold mb-0">
                      {{$aluno->cpf}}
                    </p>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">{{$aluno->contato}}</p>
                  </td>
                  <td class="align-middle text-center">
                    <p class="text-dark text-gradient mb-0 font-weight-bold">{{$aluno->assinatura->plano}}</p>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{date('d/m/Y', strtotime($aluno->assinatura->obtencao))}}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{date('d/m/Y', strtotime($aluno->assinatura->vencimento))}}</span>
                    </td>
                    <td class="align-middle text-center text-sm">
                        @if ($aluno->assinatura->ativo == true)
                        <span class="badge badge-sm bg-gradient-success">Ativo</span>
                        @else
                        <span class="badge badge-sm bg-gradient-dark">Inativo</span>
                        @endif
                    </td>
                  <td class="align-middle text-center">
                    <a class="btn btn-link text-success text-gradient mb-0" href="/alunos/treinos/{{$aluno->id}}">Treinos</a>
                    <a class="btn btn-link mb-0" href="/alunos/editar/{{$aluno->id}}">Editar</a>
                    <form id="{{$aluno->id}}" class="d-inline" action="/alunos/deletar/{{$aluno->id}}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button class="excluir btn btn-link text-danger text-gradient mb-0" value="{{$aluno->id}}">Excluir</button>
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
    {{$alunos->links()}}
  </div> 
@endif
<script>

  $('.excluir').click(function (e) { 
    e.preventDefault();

    var idAluno = $(this).val();

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
        var formulario = document.getElementById(idAluno)
        formulario.submit()
      }
    });
  });

</script>
@endsection