@extends('layout.layout')

@section('title', 'Edição')

@section('content')

{{-- @dd($professor) --}}

<form class="container-fluid py-4" method="POST" action="/professores/update/{{$professor->id}}" id="editProf" enctype="multipart/form-data">
  @csrf
  @method('PUT')
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header pb-0">
            @can('admin')
            <p class="mb-3 fw-bold">Editando: {{$professor->nome}}</p>
            @endcan
            <div class="d-flex align-items-center justify-content-between">
              <p class="mb-0">Dados Pessoais</p>
              @can('admin')
                <a class="btn btn-outline-dark btn-sm m-0" href="/professores"><i class="bi bi-arrow-left me-3 fw-bold"></i>Voltar</a>
              @elsecan('professor')
              <a class="btn btn-outline-dark btn-sm m-0" href="/professores/perfil/{{auth()->user()->id}}"><i class="bi bi-arrow-left me-3 fw-bold"></i>Voltar</a>
              @endcan
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name" class="form-control-label">Nome completo</label>
                  <input class="form-control" type="text" name="name" value="{{$professor->nome}}">
                  @error('name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="cpf" class="form-control-label">CPF</label>
                  <input class="cpf form-control" type="text" name="cpf" value="{{$professor->cpf}}">
                  @error('cpf')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="contato" class="form-control-label">Telefone</label>
                  <input class="telefone form-control" type="text" name="telefone" value="{{$professor->contato}}">
                  @error('telefone')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nascimento" class="form-control-label">Data de nascimento</label>
                  <input class="form-control" type="date" max="{{date('Y-m-d')}}" name="nascimento" value="{{$professor->nascimento}}">
                  @error('nascimento')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email" class="form-control-label">Email</label>
                  <input class="form-control" type="email" name="email" value="{{$professor->email}}">
                  @error('email')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="senha" class="form-control-label">Senha</label>
                  <div class="form-control d-flex">
                    <input class="senha w-100 border-0" type="password" id="senha" name="senha" value="{{old('senha')}}">
                    <i class="bi bi-eye-fill" onclick="senha(this)"></i>
                  </div>
                  @error('senha')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="image" class="form-control-label">Foto do professor</label>
                  <input class="form-control" type="file" name="image">
                  @error('image')
                      <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
              </div>
              <hr class="horizontal dark my-3">

              <div class="d-flex align-items-center gap-3 mb-3">
                <p class="text-uppercase text-sm m-0">Horário de trabalho</p>
              </div>

              <div class="col-md-4">
                <div class="row g-1 align-items-center mb-3">
                  <div class="col-auto">
                    <label class="form-control-label">Segunda:</label>
                  </div>
                  <div class="col-auto">
                    <input type="text" class="time form-control" name="segundaInicio" placeholder="Início" 
                      @foreach ($professor->horarios as $horario)
                        @if ($horario->dia == "Segunda")
                          value="{{$horario->inicio}}"    
                        @endif
                      @endforeach>
                  </div>
                  <div class="col-auto mx-2">
                    às
                  </div>
                  <div class="col-auto">
                    <input type="text" class="time form-control" name="segundaFim" placeholder="Término" 
                    @foreach ($professor->horarios as $horario)
                        @if ($horario->dia == "Segunda")
                          value="{{$horario->fim}}"    
                        @endif
                      @endforeach>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="row g-1 align-items-center mb-3">
                  <div class="col-auto">
                    <label class="form-control-label">Terça:</label>
                  </div>
                  <div class="col-auto">
                    <input type="text" class="time form-control" name="tercaInicio" placeholder="Início"
                    @foreach ($professor->horarios as $horario)
                        @if ($horario->dia == "Terça")
                          value="{{$horario->inicio}}"    
                        @endif
                      @endforeach>
                  </div>
                  <div class="col-auto mx-2">
                    às
                  </div>
                  <div class="col-auto">
                    <input type="text" class="time form-control" name="tercaFim" placeholder="Término"
                    @foreach ($professor->horarios as $horario)
                        @if ($horario->dia == "Terça")
                          value="{{$horario->inicio}}"    
                        @endif
                      @endforeach>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="row g-1 align-items-center mb-3">
                  <div class="col-auto">
                    <label class="form-control-label">Quarta:</label>
                  </div>
                  <div class="col-auto">
                    <input type="text" class="time form-control" name="quartaInicio" placeholder="Início"
                    @foreach ($professor->horarios as $horario)
                        @if ($horario->dia == "Quarta")
                          value="{{$horario->inicio}}"    
                        @endif
                      @endforeach>
                  </div>
                  <div class="col-auto mx-2">
                    às
                  </div>
                  <div class="col-auto">
                    <input type="text" class="time form-control" name="quartaFim" placeholder="Término"
                    @foreach ($professor->horarios as $horario)
                        @if ($horario->dia == "Quarta")
                          value="{{$horario->inicio}}"    
                        @endif
                      @endforeach>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="row g-1 align-items-center mb-3">
                  <div class="col-auto">
                    <label class="form-control-label">Quinta:</label>
                  </div>
                  <div class="col-auto">
                    <input type="text" class="time form-control" name="quintaInicio" placeholder="Início"
                    @foreach ($professor->horarios as $horario)
                        @if ($horario->dia == "Quinta")
                          value="{{$horario->inicio}}"    
                        @endif
                      @endforeach>
                  </div>
                  <div class="col-auto mx-2">
                    às
                  </div>
                  <div class="col-auto">
                    <input type="text" class="time form-control" name="quintaFim" placeholder="Término"
                    @foreach ($professor->horarios as $horario)
                        @if ($horario->dia == "Quinta")
                          value="{{$horario->inicio}}"    
                        @endif
                      @endforeach>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="row g-1 align-items-center mb-3">
                  <div class="col-auto">
                    <label class="form-control-label">Sexta:</label>
                  </div>
                  <div class="col-auto">
                    <input type="text" class="time form-control" name="sextaInicio" placeholder="Início"
                    @foreach ($professor->horarios as $horario)
                        @if ($horario->dia == "Sexta")
                          value="{{$horario->inicio}}"    
                        @endif
                      @endforeach>
                  </div>
                  <div class="col-auto mx-2">
                    às
                  </div>
                  <div class="col-auto">
                    <input type="text" class="time form-control" name="sextaFim" placeholder="Término"
                    @foreach ($professor->horarios as $horario)
                        @if ($horario->dia == "Sexta")
                          value="{{$horario->inicio}}"    
                        @endif
                      @endforeach>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="row g-1 align-items-center mb-3">
                  <div class="col-auto">
                    <label class="form-control-label">Sábado:</label>
                  </div>
                  <div class="col-auto">
                    <input type="text" class="time form-control" name="sabadoInicio" placeholder="Início"
                    @foreach ($professor->horarios as $horario)
                        @if ($horario->dia == "Sábado")
                          value="{{$horario->inicio}}"    
                        @endif
                      @endforeach>
                  </div>
                  <div class="col-auto mx-2">
                    às
                  </div>
                  <div class="col-auto">
                    <input type="text" class="time form-control" name="sabadoFim" placeholder="Término"
                    @foreach ($professor->horarios as $horario)
                        @if ($horario->dia == "Sábado")
                          value="{{$horario->inicio}}"    
                        @endif
                      @endforeach>
                  </div>
                </div>
              </div>

              <hr class="horizontal dark my-3">

              <div class="d-flex align-items-center gap-3 mb-3">
                <p class="text-uppercase text-sm m-0">Especialidades</p>
              </div>
              <div class="col-md-12">
                <input class="form-control" type="text" name="especialidade" placeholder="Digite aqui as especialidades" value="{{$professor->especialidades->nome}}">
                @error('especialidade')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
              </div>
              <div class="col-md-12 mt-3">
                <button id="btnEditProf" type="submit" class="btn bg-gradient-info shadow-info btn-sm w-100">Editar</button>
              </div>
           </div>
        </div>
      </div>
    </div>
  </form>
  <script>
    $(document).on('submit', '#editProf', function () {
      var btn = document.getElementById('btnEditProf')
      btn.disabled = true
    });
  </script>

@endsection