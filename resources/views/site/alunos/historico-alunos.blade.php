@extends('layout.layout')

@section('title', 'Histórico')

@section('content')

{{-- @dd($historico, $idAluno) --}}

@if (count($historico) == 0)
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center my-2 header-historico-responsive">
          <div class="d-flex flex-column justify-content-between mb-2">
            <h6 class="mt-0">Histórico de Treinos</h6>
          </div>
          <div class="d-flex flex-column gap-2">
            @can('admin')
              <a class="btn bg-gradient-info shadow-info m-0" href="/alunos/treinos/{{$idAluno}}">Ver treinos</a>
            @elsecan('aluno')
              <a class="btn bg-gradient-info shadow-info m-0" href="/alunos/treinos/{{auth()->user()->id}}">Meus Treinos</a>
            @endcan
            <a class="btn btn-outline-dark m-0" href="#" onclick="javascript:window.history.back(-1);return false;"><i class="bi bi-arrow-left me-3 fw-bold"></i>Voltar</a>
          </div>
        </div>
        <div class="card-header pb-0 d-flex justify-content-between align-items-center my-2 mx-1 header-historico">
          <h6>Histórico de Treinos</h6>
          <div class="text-end">
            @can('admin')
              <a class="btn bg-gradient-info shadow-info m-0" href="/alunos/treinos/{{$idAluno}}">Ver treinos</a>
              @elsecan('aluno')
              <a class="btn bg-gradient-info shadow-info m-0" href="/alunos/treinos/{{auth()->user()->id}}">Meus Treinos</a>
              @endcan
              <a class="btn btn-outline-dark m-0" href="#" onclick="javascript:window.history.back(-1);return false;"><i class="bi bi-arrow-left me-3 fw-bold"></i>Voltar</a>
          </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <p class="text-sm mb-0 text-uppercase font-weight-bold ps-4 mb-2">Não há nenhum treino registrado!</p>
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
        <div class="card-header pb-0 d-flex justify-content-between align-items-center my-2 mx-1 header-historico">
          <h6>Histórico de Treinos</h6>
          <div class="text-end">
            @can('admin')
            <a class="btn bg-gradient-info shadow-info m-0" href="/alunos/treinos/{{$idAluno}}">Ver treinos</a>
            @elsecan('aluno')
              <a class="btn bg-gradient-info shadow-info m-0" href="/alunos/treinos/{{auth()->user()->id}}">Meus Treinos</a>
            @endcan
            <a class="btn btn-outline-dark m-0" href="/"><i class="bi bi-arrow-left me-3 fw-bold"></i>Voltar</a>
          </div>
        </div>
        <div class="card-header pb-0 d-flex justify-content-between align-items-center my-2 mx-1 header-historico-responsive">
          <div class="d-flex flex-column justify-content-between mb-2">
            <h6 class="mt-0">Histórico de Treinos</h6>
          </div>
          <div class="d-flex flex-column gap-2">
            <a class="btn bg-gradient-info shadow-info m-0" href="/alunos/treinos/{{auth()->user()->id}}">Meus Treinos</a>
            <a class="btn btn-outline-dark m-0" href="/"><i class="bi bi-arrow-left me-3 fw-bold"></i>Voltar</a>
          </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="accordion accordion-flush" id="accordionHistoricoAlunos">
            @foreach ($historico as $treino)
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed border-top text-dark fw-bold fs-6" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$treino->id}}" aria-expanded="false" aria-controls="flush-collapseOne">
                  {{$treino->treino->nome}} - {{date('d/m/Y', strtotime($treino->data))}}
                </button>
              </h2>
              <div id="flush-collapse{{$treino->id}}" class="accordion-collapse collapse" data-bs-parent="#accordionHistoricoAlunos">
                <div class="accordion-body">
                  <div class="mb-3">
                    <label class="form-label">Nome do treino</label>
                    <input type="text" class="form-control" readonly value="{{$treino->treino->nome}}">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Professor</label>
                    <input type="text" class="form-control" readonly value="{{$treino->treino->professor->nome}}">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Data</label>
                    <input type="text" class="form-control" readonly value="{{date('d/m/Y', strtotime($treino->data))}}">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Ações</label>
                    <div class="d-flex">
                      <a class="btn btn-link text-success text-gradient mb-0 ps-1" target="_blank" href="/treinos/download/{{$treino->treino_id}}">Ver treino</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          <div class="table-responsive p-0" id="tabela-historico-alunos">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome do treino</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Professor</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Data</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ações</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($historico as $treino)
                <tr>
                  <td>
                    <h6 class="mb-0 text-sm ps-3">{{$treino->treino->nome}}</h6>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">{{$treino->treino->professor->nome}}</p>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">{{date('d/m/Y', strtotime($treino->data))}}</p>
                  </td>
                  <td class="align-middle text-center">
                    <a class="btn btn-link text-success text-gradient mb-0" target="_blank" href="/treinos/download/{{$treino->treino_id}}">Ver treino</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    {{$historico->links()}}
  </div>
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