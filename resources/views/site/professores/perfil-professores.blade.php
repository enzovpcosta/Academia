@extends('layout.layout')

@section('title', 'Perfil')

@section('content')

{{-- @dd($professor) --}}

<div class="card shadow-lg mx-4">
  <div class="card-body px-4 py-3">
    <div class="d-flex gap-3">
        <div class="avatar avatar-xl position-relative">
          <img src="{{asset('assets/img/professores/'.$professor->image)}}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
        </div>
      <div class="w-100 my-auto">
        <div class="h-100 d-flex justify-content-between ">
          <h5 class="mb-1">
            {{$professor->nome}}
          </h5>
          <div class="text-end">
            <a class="btn btn-outline-dark btn-sm m-0" href="/"><i class="bi bi-arrow-left me-3 fw-bold"></i>Voltar</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-md-12">
        <div class="card shadow-lg">
          <div class="card-header pb-0">
            <div class="d-flex align-items-center">
              <h6>Informações do professor</h6>
              <a href="/professores/editar/{{$professor->id}}" class="btn btn-primary btn-sm ms-auto">Editar</a>
            </div>
          </div>
          <div class="card-body">
            <p class="text-uppercase text-sm">Dados Pessoais</p>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Nome</label>
                  <input class="form-control" type="text" value="{{$professor->nome}}" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Email</label>
                  <input class="form-control" type="text" value="{{$professor->email}}" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Data de nascimento</label>
                  <input class="form-control" type="text" value="{{date('d/m/Y', strtotime($professor->nascimento))}}" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">CPF</label>
                  <input class="form-control" type="text" value="{{$professor->cpf}}" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Telefone</label>
                  <input class="form-control" type="text" value="{{$professor->contato}}" readonly>
                </div>
              </div>
            </div>
            <hr class="horizontal dark">
            <p class="text-uppercase text-sm">Horário de trabalho</p>
            <div class="row">
              @if (count($professor->horarios) == 1)
                @php
                    $classe = 'col-md-12'
                @endphp
              @elseif(count($professor->horarios) == 2)
                @php
                    $classe = 'col-md-6'
                @endphp
              @elseif(count($professor->horarios) == 3)
                @php
                  $classe = 'col-md-4'
                @endphp
              @elseif(count($professor->horarios) == 4)
                @php
                    $classe = 'col-md-3'
                @endphp
              @else
                @php
                  $classe = 'col-md-2'
                @endphp
              @endif
              @foreach ($professor->horarios as $horario)
              <div class="{{$classe}}">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">{{$horario->dia}}</label>
                  <input class="form-control" type="text" value="{{$horario->inicio}} às {{$horario->fim}}" readonly>
                </div>
              </div>
              @endforeach
            </div>
            <hr class="horizontal dark">
            <p class="text-uppercase text-sm">Especialidades</p>
            <input class="form-control" type="text" value="{{$professor->especialidades->nome}}" readonly>
          </div>
        </div>
      </div>
    </zdiv>
  </div>
</div>
@endsection