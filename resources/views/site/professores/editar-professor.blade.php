@extends('layout.layout')

@section('title', 'Edição')

@section('content')

{{-- @dd($professor) --}}

<form class="container-fluid py-4" method="POST" action="/professores/update/{{$professor->id}}">
  @csrf
  @method('PUT')
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header pb-0">
            <p class="mb-3 fw-bold">Editando: {{$professor->nome}}</p>
            <div class="d-flex align-items-center justify-content-between">
              <p class="mb-0">Dados Pessoais</p>
              <a class="btn btn-outline-dark btn-sm m-0" href="/alunos"><i class="bi bi-arrow-left me-3 fw-bold"></i>Voltar</a>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name" class="form-control-label">Nome completo</label>
                  <input class="form-control" type="text" name="name" value="{{$professor->nome}}" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="cpf" class="form-control-label">CPF</label>
                  <input class="cpf form-control" type="text" name="cpf" value="{{$professor->cpf}}" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="contato" class="form-control-label">Telefone</label>
                  <input class="telefone form-control" type="text" name="contato" value="{{$professor->contato}}" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nascimento" class="form-control-label">Data de nascimento</label>
                  <input class="form-control" type="date" max="{{date('Y-m-d')}}" name="nascimento" value="{{$professor->nascimento}}" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email" class="form-control-label">Email</label>
                  <input class="form-control" type="email" name="email" value="{{$professor->email}}" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="senha" class="form-control-label">Senha</label>
                  <div class="form-control d-flex">
                    <input class="senha w-100 border-0" type="password" id="senha" name="senha" value="{{$professor->senha}}" required>
                    <i class="bi bi-eye-fill" onclick="senha(this)"></i>
                  </div>
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
                <input class="form-control" type="text" name="especialidade" placeholder="Digite aqui as especialidades" value="{{$professor->especialidades->nome}}" required>
              </div>
              <div class="col-md-12 mt-3">
                <button type="submit" class="btn bg-gradient-info shadow-info btn-sm w-100">Editar</button>
              </div>
           </div>
        </div>
      </div>
    </div>
  </form>

@endsection