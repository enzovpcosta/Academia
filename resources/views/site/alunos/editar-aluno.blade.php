@extends('layout.layout')

@section('title', 'Edição')

@section('content')

{{-- @dd($aluno) --}}

<form class="container-fluid py-4" method="POST" action="/alunos/update/{{$aluno->id}}" enctype="multipart/form-data" id="editAluno">
  @csrf
  @method('PUT')
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header pb-0">
            @canany('admin', 'professor')
            <p class="mb-3 fw-bold">Editando: {{$aluno->nome}}</p>
            @endcanany
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
                  <input class="form-control" type="text" name="name" value="{{$aluno->nome}}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="cpf" class="form-control-label">CPF</label>
                  <input class="cpf form-control" type="text" name="cpf" value="{{$aluno->cpf}}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="contato" class="form-control-label">Telefone</label>
                  <input class="telefone form-control" type="text" name="contato" value="{{$aluno->contato}}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nascimento" class="form-control-label">Data de nascimento</label>
                  <input class="form-control" type="date" max="{{date('Y-m-d')}}" name="nascimento" value="{{$aluno->nascimento}}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email" class="form-control-label">Email</label>
                  <input class="form-control" type="email" name="email" value="{{$aluno->email}}">
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
              @canany('admin', 'professor')
              <div class="col-md-6">
                <div class="form-group">
                  <label for="plano" class="form-control-label">Selecione o plano:</label>
                  <select name="plano" id="plano" class="form-control">
                    <option value="Mensal">Mensal</option>
                    <option value="Trimestral">Trimestral</option> 
                    <option value="Semestral">Semestral</option> 
                    <option value="Anual">Anual</option>             
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="image" class="form-control-label">Foto do aluno</label>
                  <input class="form-control" type="file" name="image">
                  @error('image')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <button id="btnEditAluno" type="submit" class="btn bg-gradient-info shadow-info btn-sm w-100 m-0">Editar</button>
                </div>
              </div>
              @elsecan('aluno')
              <div class="col-md-12">
                <div class="form-group">
                  <label for="image" class="form-control-label">Foto do aluno</label>
                  <input class="form-control" type="file" name="image">
                  @error('image')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <button id="btnEditAluno" type="submit" class="btn bg-gradient-info shadow-info btn-sm w-100 m-0">Editar</button>
                </div>
              </div>
              @endcan
           </div>
        </div>
      </div>
    </div>
  </form>

  <script>
    $('#plano').select2({
      placeholder: 'Escolha algum plano',
      theme: 'bootstrap-5'
    });

    $(document).on('submit', '#editAluno', function () {
      var btn = document.getElementById('btnEditAluno')
      btn.disabled = true
    });
  </script>

@endsection