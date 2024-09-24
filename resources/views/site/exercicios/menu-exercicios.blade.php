@extends('layout.layout')

@section('title', 'Exercícios')

@section('content')

{{-- @dd($exercicios) --}}

@if (count($exercicios) == 0)
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center my-2">
          <h6>Exercícios</h6>
          <div class="col-4 d-flex justify-content-center align-items-center">
            <form action="/exercicios" method="GET"><input type="text" id="search" name="search" class="form-control" placeholder="Digite aqui..."></form>
            <a class="btn btn-link m-0" href="/exercicios">Ver todos os exercicios</a>
          </div>
          <div class="text-end">
            <a class="btn btn-dark m-0" href="/exercicios/cadastrar">Cadastrar exercício</a>
          </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <p class="text-sm mb-0 text-uppercase font-weight-bold ps-4 mb-2">Não há nenhum exercício cadastrado</p>
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
          <h6>Exercícios</h6>
          <div class="col-4 d-flex justify-content-center align-items-center">
            <form action="/exercicios" method="GET"><input type="text" id="search" name="search" class="form-control" placeholder="Digite aqui..."></form>
            <a class="btn btn-link m-0" href="/exercicios">Ver todos os exercicios</a>
          </div>
          <div class="text-end">
            <a class="btn btn-dark m-0" href="/exercicios/cadastrar">Cadastrar exercício</a>
          </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Músculo</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ações</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($exercicios as $exercicio)
                <tr>
                  <td>
                    <h6 class="mb-0 text-sm px-2 py-1">{{$exercicio->nome}}</h6>
                  </td>
                  <td>
                    <h6 class="text-sm">{{$exercicio->musculo}}</h6>
                  </td>
                  <td class="align-middle text-center">
                    <a class="btn btn-link mb-0" href="/exercicios/editar/{{$exercicio->id}}">Editar</a>
                    <form id="{{$exercicio->id}}" class="d-inline" action="/exercicios/deletar/{{$exercicio->id}}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button class="excluir btn btn-link text-danger text-gradient mb-0" value="{{$exercicio->id}}">Excluir</button>
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
    {{$exercicios->links()}}
  </div> 
@endif
<script>

  $('.excluir').click(function (e) { 
    e.preventDefault();

    var idExercicio = $(this).val();

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
        var formulario = document.getElementById(idExercicio)
        formulario.submit()
      }
    });
  });

</script>
@endsection