@extends('layout.layout')

@section('title', 'Histórico')

@section('content')

{{-- @dd($historico) --}}

@if (count($historico) == 0)
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center my-2">
          <h6>Histórico de Treinos</h6>
          <div class="text-end">
            <a class="btn bg-gradient-info shadow-info m-0" href="/alunos/treinos/{{auth()->user()->id}}">Meus Treinos</a>
            <a class="btn btn-outline-dark m-0" href="/"><i class="bi bi-arrow-left me-3 fw-bold"></i>Voltar</a>
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
        <div class="card-header pb-0 d-flex justify-content-between align-items-center my-2" id="header-historico-responsive">
          <div class="d-flex flex-column justify-content-between mb-2">
            <h6 class="mt-0">Histórico de Treinos</h6>
          </div>
          <div class="d-flex flex-column gap-2">
            <a class="btn bg-gradient-info shadow-info m-0" href="/alunos/treinos/{{auth()->user()->id}}">Meus Treinos</a>
            <a class="btn btn-outline-dark m-0" href="/"><i class="bi bi-arrow-left me-3 fw-bold"></i>Voltar</a>
          </div>
        </div>
        <div class="card-header pb-0 d-flex justify-content-between align-items-center my-2" id="header-historico">
          <h6>Histórico de Treinos</h6>
          <div class="text-end">
            <a class="btn bg-gradient-info shadow-info m-0" href="/alunos/treinos/{{auth()->user()->id}}">Meus Treinos</a>
            <a class="btn btn-outline-dark m-0" href="/"><i class="bi bi-arrow-left me-3 fw-bold"></i>Voltar</a>
          </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome do treino</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Professor</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Data</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($historico as $treinos)
                <tr>
                  <td>
                    <h6 class="mb-0 text-sm ps-3">{{$treinos->treino->nome}}</h6>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">{{$treinos->treino->professor->nome}}</p>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">{{date('d/m/Y', strtotime($treinos->data))}}</p>
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