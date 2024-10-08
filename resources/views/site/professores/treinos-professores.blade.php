@extends('layout.layout')

@section('title', 'Treinos')
    
@section('content')

{{-- @dd($treinos) --}}

{{-- @foreach ($treinos as $treino)
  @dd($treino->professor, $treino->user)  
@endforeach --}}

@if (count($treinos) == 0)
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center my-2">
          <h5>Treinos criados por: <span class="text-secondary">{{$professor->nome}}</span></h5>
          <div class="text-end">
            <a class="btn btn-outline-dark btn-sm m-0" href="/professores"><i class="bi bi-arrow-left me-3 fw-bold"></i>Voltar</a>
          </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <p class="text-sm mb-0 text-uppercase font-weight-bold ps-4 mb-2">Não há nenhum treino registrado</p>
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
        <div class="card-header pb-0 d-flex justify-content-between align-items-center mt-2 mb-4">
          @can('admin')
          <h6>Treinos criados por: <span class="text-secondary">{{$professor->nome}}</span></h6>
          @elsecan('professor')
          <h5>Meus Treinos</h5>
          @endcan
          <div class="text-end">
            <a class="btn btn-outline-dark btn-sm m-0" href="/professores"><i class="bi bi-arrow-left me-3 fw-bold"></i>Voltar</a>
          </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="accordion accordion-flush" id="accordionTreinosProfessores">
            @foreach ($treinos as $treino)
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed border-top text-dark fw-bold fs-6" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$treino->id}}" aria-expanded="false" aria-controls="flush-collapseOne">
                  {{$treino->nome}} ({{$treino->user->nome}})
                </button>
              </h2>
              <div id="flush-collapse{{$treino->id}}" class="accordion-collapse collapse" data-bs-parent="#accordionTreinosAlunos">
                <div class="accordion-body">
                  <div class="mb-3">
                    <label class="form-label">Nome do treino</label>
                    <input type="text" class="form-control" readonly value="{{$treino->nome}}">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Dias em que o treino será realizado</label>
                    <input type="text" class="form-control" readonly value="{{$treino->dias}}">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Nome do aluno</label>
                    <input type="text" class="form-control" readonly value="{{$treino->user->nome}}">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Ações</label>
                    <div class="d-flex">
                      <a class="btn btn-link text-success text-gradient mb-0 ps-1" target="_blank" href="/treinos/download/{{$treino->id}}">Baixar</a>
                    <a class="btn btn-link mb-0" href="/treinos/editar/{{$treino->id}}">Editar</a>
                    <form id="{{$treino->id}}" class="d-inline" action="/treinos/deletar/{{$treino->id}}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button class="excluir btn btn-link text-danger text-gradient mb-0" value="{{$treino->id}}">Excluir</button>
                    </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          <div class="table-responsive p-0" id="tabela-treinos-professores">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Dias</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Aluno</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">professor</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ações</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($treinos as $treino)
                <tr>
                  <td>
                    <p class="text-xs font-weight-bold mb-0 ps-3">{{$treino->nome}}</p>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">{{$treino->dias}}</p>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">{{$treino->user->nome}}</p>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">{{$treino->professor->nome}}</p>
                  </td>
                  <td class="align-middle text-center">
                    <a class="btn btn-link text-success text-gradient mb-0" target="_blank" href="/treinos/download/{{$treino->id}}">Baixar</a>
                    <a class="btn btn-link mb-0" href="/treinos/editar/{{$treino->id}}">Editar</a>
                    <form id="{{$treino->id}}" class="d-inline" action="/treinos/deletar/{{$treino->id}}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button class="excluir btn btn-link text-danger text-gradient mb-0" value="{{$treino->id}}">Excluir</button>
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
  </div> 
@endif
<script>

  $('.excluir').click(function (e) { 
    e.preventDefault();

    var idTreino = $(this).val();
    // console.log(idTreino);
    // return

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
        var formulario = document.getElementById(idTreino)
        formulario.submit()
      }
    });
  });

</script>
@endsection