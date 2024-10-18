@extends('layout.layout')

@section('title', 'Administradores')

@section('content')

{{-- @dd(auth()->user()->id) --}}

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center my-2" id="header-admins-responsive">
          <div class="d-flex flex-column justify-content-between mb-2">
            <h5 class="mt-0">Administradores</h5>
          </div>
          <div class="d-flex flex-column gap-2">
            <a class="btn bg-gradient-info shadow-info m-0" href="/administradores/cadastrar">Cadastrar novo administrador</a>
            <a class="btn btn-outline-dark m-0" href="/"><i class="bi bi-arrow-left me-3 fw-bold"></i>Voltar</a>
          </div>
        </div>
        <div class="card-header pb-0 d-flex justify-content-between align-items-center my-2 mx-1" id="header-admins">
          <h5>Administradores</h5>
          <div class="text-end">
            <a class="btn bg-gradient-info shadow-info m-0" href="/administradores/cadastrar">Cadastrar novo administrador</a>
            <a class="btn btn-outline-dark m-0" href="/"><i class="bi bi-arrow-left me-3 fw-bold"></i>Voltar</a>
          </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="accordion accordion-flush" id="accordionAdmins">
            @foreach ($admins as $admin)
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed border-top text-dark fw-bold fs-6" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$admin->id}}" aria-expanded="false" aria-controls="flush-collapseOne">
                  <div class="d-flex px-2 py-1">
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm">{{$admin->nome}}</h6>
                      <p class="text-xs text-secondary mb-0">{{$admin->email}}</p>
                    </div>
                  </div>
                </button>
              </h2>
              <div id="flush-collapse{{$admin->id}}" class="accordion-collapse collapse" data-bs-parent="#accordionAdmins">
                <div class="accordion-body">
                  <h5>Dados Pessoais</h5>
                  <div class="mb-2">
                    <label class="form-label">Nome</label>
                    <input type="text" class="form-control" readonly value="{{$admin->nome}}">
                  </div>
                  <div class="mb-2">
                    <label class="form-label">CPF</label>
                    <input type="text" class="cpf form-control" readonly value="{{$admin->cpf}}">
                  </div>
                  <div class="mb-2">
                    <label class="form-label">Telefone</label>
                    <input type="text" class="form-control" readonly value="{{$admin->contato}}">
                  </div>
                  <div class="mb-2">
                    <label class="form-label">Data de nascimento</label>
                    <input type="text" class="form-control" readonly value="{{date('d/m/Y', strtotime($admin->nascimento))}}">
                  </div>
                  <hr class="horizontal dark my-3">
                  <div class="mb-2">
                    <label class="form-label">Ações</label>
                    <div class="d-flex">
                      <a class="btn btn-link mb-0 px-0" href="/administradores/editar/{{$admin->id}}">Editar</a>
                      @if ($admin->id != auth()->user()->id)
                      <form id="{{$admin->id}}" class="d-inline" action="/administradores/deletar/{{$admin->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="excluir btn btn-link text-danger text-gradient mb-0" value="{{$admin->id}}">Excluir</button>
                      </form>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          <div class="table-responsive p-0" id="tabela-admins">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Nome</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Cpf</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Telefone</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Data de nascimento</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ações</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($admins as $admin)
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">{{$admin->nome}}</h6>
                        <p class="text-xs text-secondary mb-0">{{$admin->email}}</p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="cpf text-xs font-weight-bold mb-0">
                      {{$admin->cpf}}
                    </p>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">{{$admin->contato}}</p>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">{{date('d/m/Y', strtotime($admin->nascimento))}}</p>
                  </td>
                  <td class="align-middle text-center">
                    <a class="btn btn-link mb-0 px-0" href="/administradores/editar/{{$admin->id}}">Editar</a>
                     @if ($admin->id != auth()->user()->id)
                      <form id="{{$admin->id}}" class="d-inline" action="/administradores/deletar/{{$admin->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="excluir btn btn-link text-danger text-gradient mb-0" value="{{$admin->id}}">Excluir</button>
                      </form>
                      @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    {{$admins->links()}}
  </div> 
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