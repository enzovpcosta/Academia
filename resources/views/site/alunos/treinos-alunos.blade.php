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
              <h6>Meus Treinos:</h6>
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
          <h6>Meus Treinos:</h6>
          <div class="text-end">
            <a class="btn btn-outline-dark btn-sm m-0" href="/"><i class="bi bi-arrow-left me-3 fw-bold"></i>Voltar</a>
          </div>
          @endcan
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="accordion accordion-flush" id="accordionTreinosAlunos">
            @foreach ($treinos as $treino)
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed border-top border-bottom text-dark fw-bold fs-6" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$treino->id}}" aria-expanded="false" aria-controls="flush-collapseOne">
                  {{$treino->id}}- {{$treino->nome}}
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
                    <label class="form-label">Nome do professor</label>
                    <input type="text" class="form-control" readonly value="{{$treino->professor->nome}}">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Ações</label>
                    <div class="d-flex">
                      <button type="button" class="registrar btn btn-link mb-0 ps-1" data-bs-toggle="modal" data-bs-target="#modal" value="{{$treino->id}}">Registrar</button>
                      <a class="btn btn-link text-success text-gradient mb-0" target="_blank" href="/treinos/download/{{$treino->id}}">Baixar</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          <div class="table-responsive p-0" id="tabela-treinos-alunos">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nome</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Dias</th>
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
                    <p class="text-xs font-weight-bold mb-0">{{$treino->professor->nome}}</p>
                  </td>
                  <td class="align-middle text-center">
                    @can('aluno')
                    <button type="button" class="registrar btn btn-link mb-0" data-bs-toggle="modal" data-bs-target="#modal" value="{{$treino->id}}">Registrar</button>
                    @endcan
                    <a class="btn btn-link text-success text-gradient mb-0" target="_blank" href="/treinos/download/{{$treino->id}}">Baixar</a>
                    @can('admin')
                    <a class="btn btn-link mb-0" href="/treinos/editar/{{$treino->id}}">Editar</a>
                    <form id="{{$treino->id}}" class="d-inline" action="/treinos/deletar/{{$treino->id}}" method="POST">
                      @csrf
                      @method('PUT')
                      <button class="excluir btn btn-link text-danger text-gradient mb-0" value="{{$treino->id}}">Excluir</button>
                    </form>
                    @elsecan('professor')
                    <a class="btn btn-link mb-0" href="/treinos/editar/{{$treino->id}}">Editar</a>
                    <form id="{{$treino->id}}" class="d-inline" action="/treinos/deletar/{{$treino->id}}" method="POST">
                      @csrf
                      @method('PUT')
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
    {{$treinos->links()}}
  </div>
    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header justify-content-center">
            <h3 class="fs-5" id="modalTitle"></h3>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <form method="POST" id="formRegistrar">
                @csrf
                <label for="data" class="form-control-label">Selecione a data em que o treino foi realizado:</label>
                <input class="form-control" type="date" name="data" max="{{date('Y-m-d')}}" required>
                <p class="text-secondary text-xs font-weight-bolder opacity-7 mt-3">O treino será registrado em seu Histórico de Treinos.</p>
              </div>
              <div class="modal-footer gap-2">
                <button type="button" class="btn bg-gradient-secondary shadow-secondary btn-sm m-0" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn bg-gradient-info shadow-info btn-sm m-0">Enviar</button>
              </div>
              </form>
          </div>
        </div>
      </div>
    </div> 
@endif
<script>
  $('.registrar').click(function (e) { 
    e.preventDefault();

    var idTreino = $(this).val();

    $.ajax({
      type: "GET",
      url: "/aluno/treino/"+idTreino,
      success: function (response) {
        const res = JSON.parse(response);
        $('#modalTitle').text('Registrando treino: '+res[0].nome+', no Histórico de treinos!');
        $('#formRegistrar').attr('action', '/alunos/historico/'+idTreino);
      }
    });
    
  });

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