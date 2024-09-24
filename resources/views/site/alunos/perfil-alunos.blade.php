@extends('layout.layout')

@section('title', 'Alunos')

@section('content')

{{-- @dd($aluno) --}}

<div class="card shadow-lg mx-4 card-profile-bottom">
      <div class="card-body p-3">
        <div class="row gx-4">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="{{asset('assets/img/alunos/'.$aluno->image)}}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                {{$aluno->nome}}
              </h5>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <h6>Informações do aluno</h6>
                <a href="/alunos/editar/{{$aluno->id}}" class="btn btn-primary btn-sm ms-auto">Editar</a>
              </div>
            </div>
            <div class="card-body">
              <p class="text-uppercase text-sm">Dados Pessoais</p>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Nome</label>
                    <input class="form-control" type="text" value="{{$aluno->nome}}" readonly>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Email</label>
                    <input class="form-control" type="text" value="{{$aluno->email}}" readonly>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Data de nascimento</label>
                    <input class="form-control" type="text" value="{{date('d/m/Y', strtotime($aluno->nascimento))}}" readonly>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">CPF</label>
                    <input class="form-control" type="text" value="{{$aluno->cpf}}" readonly>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Telefone</label>
                    <input class="form-control" type="text" value="{{$aluno->contato}}" readonly>
                  </div>
                </div>
              </div>
              <hr class="horizontal dark">
              <p class="text-uppercase text-sm">Informações do plano</p>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Plano</label>
                    <input class="form-control" type="text" value="{{$aluno->assinatura->plano}}" readonly>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Data de assinatura</label>
                    <input class="form-control" type="text" value="{{date('d/m/Y', strtotime($aluno->assinatura->obtencao))}}" readonly>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Data de vencimento</label>
                    <input class="form-control" type="text" value="{{date('d/m/Y', strtotime($aluno->assinatura->vencimento))}}" readonly>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </zdiv>
    </div>
  </div>
@endsection