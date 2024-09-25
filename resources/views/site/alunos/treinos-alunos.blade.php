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
          @can('admin')
          <h6>Treinos: <span class="text-secondary">{{$aluno->nome}}</span></h6>
          <div class="text-end">
            <a class="btn btn-outline-dark btn-sm m-0" href="/alunos"><i class="bi bi-arrow-left me-3 fw-bold"></i>Voltar</a>
          </div>
          @elsecan('professor')
          <h6>Treinos: <span class="text-secondary">{{$aluno->nome}}</span></h6>
          <div class="text-end">
            <a class="btn btn-outline-dark btn-sm m-0" href="/alunos"><i class="bi bi-arrow-left me-3 fw-bold"></i>Voltar</a>
          </div>
          @elsecan('aluno')
              <h6>Meus treinos</h6>
              <div class="text-end">
                <a class="btn btn-outline-dark btn-sm m-0" href="/"><i class="bi bi-arrow-left me-3 fw-bold"></i>Voltar</a>
              </div>
          @endcan
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
        <div class="card-header pb-0 d-flex justify-content-between align-items-center my-2">
          @can('admin')
          <h6>Treinos: <span class="text-secondary">{{$aluno->nome}}</span></h6>
          <div class="text-end">
            <a class="btn btn-outline-dark btn-sm m-0" href="/alunos"><i class="bi bi-arrow-left me-3 fw-bold"></i>Voltar</a>
          </div>
          @elsecan('professor')
          <h6>Treinos: <span class="text-secondary">{{$aluno->nome}}</span></h6>
          <div class="text-end">
            <a class="btn btn-outline-dark btn-sm m-0" href="/alunos"><i class="bi bi-arrow-left me-3 fw-bold"></i>Voltar</a>
          </div>
          @elsecan('aluno')
          <h6>Meus treinos</h6>
          <div class="text-end">
            <a class="btn btn-outline-dark btn-sm m-0" href="/"><i class="bi bi-arrow-left me-3 fw-bold"></i>Voltar</a>
          </div>
          @endcan
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nome</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Dias</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Aluno</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Professor</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ações</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($treinos as $treino)
                <tr>
                  <td>
                    <h6 class="mb-0 text-sm ps-3">{{$treino->id}}</h6>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">{{$treino->nome}}</p>
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
                    <a class="btn btn-link text-success text-gradient mb-0" href="/treinos/download/{{$treino->id}}">Baixar</a>
                    @can('admin')
                    <a class="btn btn-link mb-0" href="/treinos/editar/{{$treino->id}}">Editar</a>
                    <form id="{{$treino->id}}" class="d-inline" action="/treinos/deletar/{{$treino->id}}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button class="excluir btn btn-link text-danger text-gradient mb-0" value="{{$treino->id}}">Excluir</button>
                    </form>
                    @elsecan('professor')
                    <a class="btn btn-link mb-0" href="/treinos/editar/{{$treino->id}}">Editar</a>
                    <form id="{{$treino->id}}" class="d-inline" action="/treinos/deletar/{{$treino->id}}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button class="excluir btn btn-link text-danger text-gradient mb-0" value="{{$treino->id}}">Excluir</button>
                    </form>
                    @endcan
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