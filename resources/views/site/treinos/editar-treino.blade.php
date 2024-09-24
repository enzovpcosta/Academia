@extends('layout.layout')

@section('title', 'Editar treino')

@section('content')

{{-- @dd($treino, $exerciciosAluno, $exerciciosTodos, $musculos) --}}

<form class="container-fluid py-4" method="POST" action="/treinos/update/{{$treino->id}}">
  @csrf
  @method('PUT')
    <div class="'row'">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header pb-0">
            <div class="d-flex align-items-center">
              <p class="mb-0">Informações</p>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name" class="form-control-label">Nome do treino</label>
                  <input class="form-control" type="text" name="treino" placeholder="Nome do treino" value="{{$treino->nome}}" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="aluno" class="form-control-label">Nome do aluno</label>
                  <input class="form-control" type="text" name="aluno" value="{{$treino->user->nome}}" readonly>
                </div>
              </div>

              <div id="Title">
                <div class="row">
                  <div class="col-md-3">
                    <label class="form-control-label">Exercícios</label>
                  </div>
                  <div class="col-md-2">
                    <label class="form-control-label">Séries</label>
                  </div>
                  <div class="col-md-2">
                    <label class="form-control-label">Repetições</label>
                  </div>
                  <div class="col-md-2">
                    <label class="form-control-label">Carga</label>
                  </div>
                  <div class="col-md-3 text-center">
                    <button id="adicionarExercicio" class="btn btn-outline-success btn-sm m-0 py-1 px-2"><i class="bi bi-plus-lg"></i></button>
                  </div>
                </div>
              </div>
        
              <div id="divPai">
                @php
                    $i = 0
                @endphp
                @foreach ($exerciciosAluno as $exercicio)
                <div id="{{$exercicio->exercicios->nome}}" class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <select class="exercicios form-select" name="exercicio[]" id="selectExercicio">
                          <option selected value="{{$exercicio->exercicio_id}}">
                            {{$exercicio->exercicios->nome}}
                        </option>
                          @foreach ($musculos as $musculo)
                              <optgroup label="{{$musculo->musculo}}">
                                @foreach ($exerciciosTodos as $exercicios)
                                    @if ($exercicios->musculo == $musculo->musculo)
                                        <option value="{{$exercicios->id}}">{{$exercicios->nome}}</option>
                                    @endif
                                @endforeach
                              </optgroup>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <input class="form-control" type="number" name="series[]" placeholder="Nº de séries" value="{{$exercicio->series}}" required>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <input class="form-control" type="number" name="reps[]" placeholder="Nº de repetições" value="{{$exercicio->reps}}" required>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <input class="form-control" type="text" name="carga[]" placeholder="KG" value="{{$exercicio->carga}}" required>
                      </div>
                    </div>
                    @if ($i != 0)
                    <div class="col-md-3 text-center">
                      <button class="excluirExercicio btn btn-outline-danger btn-sm m-0 py-1 px-2" value="{{$exercicio->exercicios->nome}}"><i class="bi bi-trash3"></i></button>
                    </div>
                    {{$i++}}
                    @endif
                    
                  </div>
                @endforeach
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-control-label">Nome do professor</label>
                  <input class="form-control" type="text" name="professor" value="{{$treino->professor->nome}}" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-control-label">Dias da semana</label>
                  <input class="form-control" type="text" name="dias" placeholder="Dias em que o treino será realizado" required value="{{$treino->dias}}">
                </div>
              </div>
              <div class="col-md-12 mt-3">
                <button type="submit" class="btn btn-dark btn-sm w-100">Editar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
  <script>

    id_row = 2;

    $('#adicionarExercicio').click(function (e) { 
      e.preventDefault();

      var treinos = null

      $.ajax({
        type: "GET",
        url: "/treinos/todos",
        async: false,
        beforeSend: function() {            
                },
                success: function(data) {
                  treinos = (JSON.parse(data));
                  
                },
                error: function(err) {
                    reject(err) // Reject the promise and go to catch()
                }
      });

      // console.log(treinos);
      // return

      var divPai = document.getElementById('divPai')

      var novaDivPai = document.createElement('div')
      novaDivPai.id = id_row
      novaDivPai.className = 'row'

      var divSelect = document.createElement('div')
      divSelect.className = 'col-md-3'

      var formSelect = document.createElement('div')
      formSelect.className = 'form-group'
      
      var select = document.createElement('select')
      select.className = 'exercicios form-select'
      select.setAttribute('name', 'exercicio[]')
    
      var opcao1 = document.createElement('option')
      opcao1.value = ""
      opcao1.innerText = 'Selecione o exercicio'
      opcao1.selected = true

      addOption(treinos, select) 

      var divSeries = document.createElement('div')
      divSeries.className = 'col-md-2'

      var formSeries = document.createElement('div')
      formSeries.className = 'form-group'

      var inputSeries = document.createElement('input')
      inputSeries.className = 'form-control'
      inputSeries.setAttribute('type', 'number')
      inputSeries.setAttribute('name', 'series[]')
      inputSeries.setAttribute('placeholder', 'Nº de séries')
      inputSeries.required = true
      
      var divReps = document.createElement('div')
      divReps.className = 'col-md-2'

      var formReps = document.createElement('div')
      formReps.className = 'form-group'

      var inputReps = document.createElement('input')
      inputReps.className = 'form-control'
      inputReps.setAttribute('type', 'number')
      inputReps.setAttribute('name', 'reps[]')
      inputReps.setAttribute('placeholder', 'Nº de repetições')
      inputReps.required = true

      var divCarga = document.createElement('div')
      divCarga.className = 'col-md-2'

      var formCarga = document.createElement('div')
      formCarga.className = 'form-group'

      var inputCarga = document.createElement('input')
      inputCarga.className = 'form-control'
      inputCarga.setAttribute('type', 'number')
      inputCarga.setAttribute('name', 'carga[]')
      inputCarga.setAttribute('placeholder', 'KG')
      inputCarga.required = true

      var divExcluir = document.createElement('div')
      divExcluir.className = 'col-md-3 text-center'

      var buttonExcluir = document.createElement('button')
      buttonExcluir.className = 'excluirExercicio btn btn-outline-danger btn-sm m-0 py-1 px-2'
      $(buttonExcluir).val(id_row);
      
      var icon = document.createElement('i')
      icon.className = 'bi bi-trash3'

      divPai.append(novaDivPai)

      novaDivPai.append(divSelect)
      divSelect.append(formSelect)
      formSelect.append(select)
      select.prepend(opcao1)

      novaDivPai.append(divSeries)
      divSeries.append(formSeries)
      formSeries.append(inputSeries)
      
      novaDivPai.append(divReps)
      divReps.append(formReps)
      formReps.append(inputReps)

      novaDivPai.append(divCarga)
      divCarga.append(formCarga)
      formCarga.append(inputCarga)

      novaDivPai.append(divExcluir)
      divExcluir.append(buttonExcluir)
      buttonExcluir.append(icon)

      id_row++

      $('.exercicios').select2({
          placeholder: 'Escolha o exercício',
          theme: 'bootstrap-5'
        })
      
      });

      function addOption(option, element) {
        var optGroup = null
        option[1].forEach(musculo => {
          optGroup = document.createElement('optgroup');
          optGroup.label = musculo.musculo;
          option[0].forEach(exercicio => {
              if(exercicio.musculo == optGroup.label){
                let optionElement = new Option(exercicio.nome, exercicio.id);
                optGroup.appendChild(optionElement);
                element.appendChild(optGroup);
              }
          });
        });
      } 

      $(document).on('click', '.excluirExercicio', function (e) {
        e.preventDefault()

        var idDiv = $(this).val();

        var div = document.getElementById(idDiv)

        $(div).remove();
      });

      $(document).ready(function () {
        $('.exercicios').select2({
          placeholder: 'Escolha o exercício',
          theme: 'bootstrap-5'
        })
      });

  </script>
 
@endsection