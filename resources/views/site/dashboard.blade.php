@extends('layout.layout')

@section('title', 'Menu Principal')
    
@section('content')

{{-- @dd(auth()->user()->toArray(), auth()->user()->hasPermission('professor')) --}}
{{-- @dd(auth()->user()->hasPermission('aluno')) --}}

<div class="container-fluid py-4">
  <div class="row">
    @if (auth()->check())
        <h3 class="mb-5 text-light">Bem-vindo, {{auth()->user()->nome}}!</h3>
    @endif
    @can('admin')
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <a href="/alunos" class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total de Alunos</p>
                <h5 class="font-weight-bolder">
                  {{count($alunos)}}
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-dark shadow-primary text-center rounded-circle">
                <i class="bi bi-person-fill text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <a href="/professores" class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total de Professores</p>
                <h5 class="font-weight-bolder">
                  {{count($professores)}}
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-success shadow-succes text-center rounded-circle">
                <i class="bi bi-person-fill text-lg opacity-10"></i>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <a href="/treinos" class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total de treinos</p>
                <h5 class="font-weight-bolder">
                  {{count($treinos)}}
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                <i class="bi bi-lightning-charge-fill text-lg text-sm opacity-10"></i>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <a href="/exercicios" class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total de exercicios</p>
                <h5 class="font-weight-bolder">
                  {{count($exercicios)}}
                </h5>
              </div>
            </div>
            <div class="col-4 d-flex justify-content-end">
              <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle d-flex align-items-center justify-content-center">
                <ion-icon class="text-light" name="barbell-outline"></ion-icon>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>    
    @elsecan('professor')
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <a href="/alunos" class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total de Alunos</p>
                <h5 class="font-weight-bolder">
                  {{count($alunos)}}
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-dark shadow-primary text-center rounded-circle">
                <i class="bi bi-person-fill text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <a href="/treinos" class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total de treinos criados</p>
                <h5 class="font-weight-bolder">
                  {{count($treinos)}}
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                <i class="bi bi-lightning-charge-fill text-lg text-sm opacity-10"></i>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <a href="/exercicios" class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total de exercicios</p>
                <h5 class="font-weight-bolder">
                  {{count($exercicios)}}
                </h5>
              </div>
            </div>
            <div class="col-4 d-flex justify-content-end">
              <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle d-flex align-items-center justify-content-center">
                <ion-icon class="text-light" name="barbell-outline"></ion-icon>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>    
    @elsecan('aluno')
    {{-- @dd($plano) --}}
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <a href="/alunos/treinos/{{auth()->user()->id}}" class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total de treinos</p>
                <h5 class="font-weight-bolder">
                  {{count($treinos)}}
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                <i class="bi bi-lightning-charge-fill text-lg text-sm opacity-10"></i>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 font-weight-bold"><b>Plano</b>: {{$plano->plano}}</p>
                <h5 class="font-weight-bolder">Vencimento: <span class="fs-6 font-weight-bold">{{date('d/m/Y', strtotime($plano->vencimento))}}</span></h5>
              </div>
            </div>
            <div class="col-4 d-flex justify-content-end">
              <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle d-flex align-items-center justify-content-center">
                <ion-icon class="text-light" name="barbell-outline"></ion-icon>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endcan
    
  </div>
@endsection