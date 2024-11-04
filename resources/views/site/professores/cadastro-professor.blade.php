@extends('layout.layout')

@section('title', 'Cadastrar professor')

@section('content')

<form class="container-fluid py-4" method="POST" action="/professores/cadastrar" enctype="multipart/form-data" id="cadastroProf">
  @csrf
    <div class="'row'">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header pb-0">
            <div class="d-flex align-items-center justify-content-between">
              <p class="mb-0">Dados Pessoais</p>
              <a class="btn btn-outline-dark m-0" href="#" onclick="javascript:window.history.back(-1);return false;"><i class="bi bi-arrow-left me-3 fw-bold"></i>Voltar</a>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name" class="form-control-label">Nome completo</label>
                  <input class="form-control" type="text" name="name" placeholder="Digite o nome" value="{{old('name')}}">
                  @error('name')
                      <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="cpf" class="form-control-label">CPF</label>
                  <input class="cpf form-control" type="text" name="cpf" placeholder="Digite o cpf" value="{{old('cpf')}}">
                  @error('error')
                    <span class="text-danger">{{$message}}</span>
                  @enderror
                  @error('cpf')
                      <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="telefone" class="form-control-label">Telefone</label>
                  <input class="telefone form-control" type="text" name="telefone" placeholder="Digite o telefone" value="{{old('telefone')}}">
                  @error('telefone')
                      <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nascimento" class="form-control-label">Data de nascimento</label>
                  <input class="form-control" type="date" max="{{date('Y-m-d')}}" name="nascimento" value="{{old('nascimento')}}">
                  @error('nascimento')
                      <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email" class="form-control-label">Email</label>
                  <input class="form-control" type="email" name="email" placeholder="Digite o email" value="{{old('email')}}">
                  @error('email')
                      <span class="text-danger">{{$message}}</span>
                  @enderror
                  @error('errorEmail')
                    <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="senha" class="form-control-label">Senha</label>
                  <div class="form-control d-flex">
                    <input class="senha w-100 border-0" type="password" id="senha" name="senha" placeholder="Digite a senha" value="{{old('senha')}}">
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

              <div class="d-flex gap-3" id="horarioProfResponsive">
                <div class="col-md-auto d-flex flex-column gap-4 pt-2">
                    <label class="form-control-label mb-0">Segunda:</label>
                    <label class="form-control-label mb-0">Terça:</label>
                    <label class="form-control-label mb-0">Quarta:</label>
                    <label class="form-control-label mb-0">Quinta:</label>
                    <label class="form-control-label mb-0">Sexta:</label>
                    <label class="form-control-label mb-0">Sábado:</label>
                </div>
                <div class="w-100 d-flex flex-column gap-1">
                  <div class="d-flex align-items-center">
                    <input type="text" class="time form-control" name="segundaInicio" placeholder="Início">
                    <span class="mx-2">às</span>
                    <input type="text" class="time form-control" name="segundaFim" placeholder="Término">
                  </div>
                  <div class="d-flex align-items-center">
                    <input type="text" class="time form-control" name="tercaInicio" placeholder="Início">
                    <span class="mx-2">às</span>
                    <input type="text" class="time form-control" name="tercaFim" placeholder="Término">
                  </div>
                  <div class="d-flex align-items-center">
                    <input type="text" class="time form-control" name="quartaInicio" placeholder="Início">
                    <span class="mx-2">às</span>
                    <input type="text" class="time form-control" name="quartaFim" placeholder="Término">
                  </div>
                  <div class="d-flex align-items-center">
                    <input type="text" class="time form-control" name="quintaInicio" placeholder="Início">
                    <span class="mx-2">às</span>
                    <input type="text" class="time form-control" name="quintaFim" placeholder="Término">
                  </div>
                  <div class="d-flex align-items-center">
                    <input type="text" class="time form-control" name="sextaInicio" placeholder="Início">
                    <span class="mx-2">às</span>
                    <input type="text" class="time form-control" name="sextaFim" placeholder="Término">
                  </div>
                  <div class="d-flex align-items-center">
                    <input type="text" class="time form-control" name="sabadoInicio" placeholder="Início">
                    <span class="mx-2">às</span>
                    <input type="text" class="time form-control" name="sabadoFim" placeholder="Término">
                  </div>
                </div>
              </div>
              
              
              <div class="col-md-4 px-0 pe-2 horarioProf">
                <div class="d-flex align-items-center mb-3">
                  <div class="col-md-auto">
                    <label class="form-control-label">Segunda:</label>
                  </div>
                  <div class="ms-2">
                    <input type="text" class="time form-control" name="segundaInicio" placeholder="Início">
                  </div>
                  <div class="mx-2">
                    às
                  </div>
                  <div>
                    <input type="text" class="time form-control" name="segundaFim" placeholder="Término">
                  </div>
                </div>
              </div>
              <div class="col-md-4 px-0 pe-2 horarioProf">
                <div class="d-flex align-items-center mb-3">
                  <div class="col-md-auto">
                    <label class="form-control-label">Terça:</label>
                  </div>
                  <div class="ms-2">
                    <input type="text" class="time form-control" name="tercaInicio" placeholder="Início">
                  </div>
                  <div class="mx-2">
                    às
                  </div>
                  <div>
                    <input type="text" class="time form-control" name="tercaFim" placeholder="Término">
                  </div>
                </div>
              </div>
              <div class="col-md-4 px-0 pe-2 horarioProf">
                <div class="d-flex align-items-center mb-3">
                  <div class="col-md-auto">
                    <label class="form-control-label">Quarta:</label>
                  </div>
                  <div class="ms-2">
                    <input type="text" class="time form-control" name="quartaInicio" placeholder="Início">
                  </div>
                  <div class="mx-2">
                    às
                  </div>
                  <div>
                    <input type="text" class="time form-control" name="quartaFim" placeholder="Término">
                  </div>
                </div>
              </div>
              <div class="col-md-4 px-0 pe-2 horarioProf">
                <div class="d-flex align-items-center mb-3">
                  <div class="col-md-auto">
                    <label class="form-control-label">Quinta:</label>
                  </div>
                  <div class="ms-2">
                    <input type="text" class="time form-control" name="quintaInicio" placeholder="Início">
                  </div>
                  <div class="mx-2">
                    às
                  </div>
                  <div>
                    <input type="text" class="time form-control" name="quintaFim" placeholder="Término">
                  </div>
                </div>
              </div>
              <div class="col-md-4 px-0 pe-2 horarioProf">
                <div class="d-flex align-items-center mb-3">
                  <div class="col-md-auto">
                    <label class="form-control-label">Sexta:</label>
                  </div>
                  <div class="ms-2">
                    <input type="text" class="time form-control" name="sextaInicio" placeholder="Início">
                  </div>
                  <div class="mx-2">
                    às
                  </div>
                  <div>
                    <input type="text" class="time form-control" name="sextaFim" placeholder="Término">
                  </div>
                </div>
              </div>
              <div class="col-md-4 px-0 pe-2 horarioProf">
                <div class="d-flex align-items-center mb-3">
                  <div class="col-md-auto">
                    <label class="form-control-label">Sábado:</label>
                  </div>
                  <div class="ms-2">
                    <input type="text" class="time form-control" name="sabadoInicio" placeholder="Início">
                  </div>
                  <div class="mx-2">
                    às
                  </div>
                  <div>
                    <input type="text" class="time form-control" name="sabadoFim" placeholder="Término">
                  </div>
                </div>
              </div>

              <hr class="horizontal dark my-3">

              <div class="d-flex align-items-center gap-3 mb-3">
                <p class="text-uppercase text-sm m-0">Especialidades</p>
              </div>
              <div class="col-md-12">
                <input class="form-control" type="text" name="especialidade" placeholder="Digite aqui as especialidades" value="{{old('especialidade')}}">
                @error('especialidade')
                      <span class="text-danger">{{$message}}</span>
                  @enderror
              </div>
              <div class="col-md-12 mt-3">
                <button id="btncadastro" type="submit" class="btn bg-gradient-info shadow-info btn-sm w-100">Cadastrar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>

  <script>
    $(document).on('submit', '#cadastroProf', function () {
      var btn = document.getElementById('btncadastro')
      btn.disabled = true
    });
  </script>
 
@endsection