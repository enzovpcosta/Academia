@extends('layout.layout')

@section('title', 'Cadastrar administrador')

@section('content')

<form class="container-fluid py-4" method="POST" action="/administradores/cadastrar" enctype="multipart/form-data" id="cadastroAdmin">
  @csrf
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header pb-0">
            <div class="d-flex justify-content-between align-items-center">
              <p class="mb-0">Dados Pessoais</p>
              <a class="btn btn-outline-dark btn-sm m-0" href="/administradores"><i class="bi bi-arrow-left me-3 fw-bold"></i>Voltar</a>
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
                  @error('cpf')
                      <span class="text-danger">{{$message}}</span>
                  @enderror
                  @error('error')
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
                  <input class="form-control" type="email" name="email" placeholder="Digite o email" value="{{old('email')}}" autofocus="false">
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
              <div class="col-md-12 d-flex align-items-center">
                  <button id="btnCadastroAdmin" type="submit" class="btn bg-gradient-info shadow-info btn-sm w-100 m-0">Cadastrar</button>
              </div>
           </div>
        </div>
      </div>
    </div>
  </form>
  <script>
    $(document).on('submit', '#cadastroAdmin', function () {
      var btn = document.getElementById('btnCadastroAdmin')
      btn.disabled = true
    });
  </script>

@endsection