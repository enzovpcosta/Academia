@extends('layout.layout')

@section('title', 'Treinos')
    
@section('content')

{{-- @dd($treinos) --}}

{{-- @foreach ($treinos as $treino)
  @dd($treino->professor, $treino->user)  
@endforeach --}}

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center my-2">
          <h6>Treinos</h6>
          <div class="col-4">
            <form action="/treinos" method="GET"><input type="text" id="search" name="search" class="form-control" placeholder="Digite o CPF do aluno"></form>
          </div>
          <div class="text-end">
            <a class="btn bg-gradient-info shadow-info m-0" href="/treinos/cadastrar">Cadastrar treinos</a>
          </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          @if ($treinos == 'menu')
          <p class="text-sm mb-0 text-uppercase font-weight-bold ps-4 mb-2">Digite o CPF do aluno no campo de pesquisa para ver seus treinos!</p>
          @elseif($treinos != 'menu' && count($treinos) == 0)
          <p class="text-sm mb-0 text-uppercase font-weight-bold ps-4 mb-2">Não há nenhum treino registrado para o cpf: {{$search}}</p>
          @else
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