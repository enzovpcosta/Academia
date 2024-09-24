@extends('layout.layout')

@section('title', 'Criar exercício')

@section('content')

{{-- @dd($exercicio) --}}

<form class="container-fluid py-4" method="POST" action="/exercicios/update/{{$exercicio->id}}" id="editarExercicio">
  @csrf
  @method('PUT')
    <div class="'row'">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header pb-0">
            <div class="d-flex align-items-center justify-content-between">
              <p class="mb-0">Informações</p>
              <a class="btn btn-outline-dark btn-sm m-0" href="/exercicios"><i class="bi bi-arrow-left me-3 fw-bold"></i>Voltar</a>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name" class="form-control-label">Nome do exercício</label>
                  <input class="form-control" type="text" name="name" value="{{$exercicio->nome}}" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="musculo" class="form-control-label">Músculo alvo</label>
                  <select class="musculos form-select" id="musculo" name="musculo" required>
                    <option value=""></option>
                    <optgroup label="Superiores">
                      <option value="Abdômen">Abdômen</option>
                      <option value="Antebraço">Antebraço</option>
                      <option value="Bíceps">Bíceps</option>
                      <option value="Costas">Costas</option>
                      <option value="Ombro">Ombro</option>
                      <option value="Peito">Peito</option>
                      <option value="Tríceps">Tríceps</option>
                    </optgroup>
                    <optgroup label="Inferiores">
                      <option value="Glúteo">Glúteo</option>
                      <option value="Panturrilha">Panturrilha</option>
                      <option value="Posterior de coxa">Posterior de coxa</option>
                      <option value="Quadríceps">Quadríceps</option>
                    </optgroup>
                  </select>
                </div>
              </div>
              <div class="col-md-12 mt-3">
                <button id="editar" class="btn btn-dark btn-sm w-100">Editar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
  @if (session('msg'))
  <script>
    Swal.fire({
      text: "{{session('msg')}}",
      icon: "error"
    });
  </script>
@endif
<script>
$(document).ready(function () {
        $('.musculos').select2({
          placeholder: 'Escolha o musculo',
          theme: 'bootstrap-5'
        })
      });
</script>
@endsection