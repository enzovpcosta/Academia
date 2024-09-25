@extends('layout.layout')

@section('title', 'Criar treino')

@section('content')

{{-- @dd($alunos, $professores, $exercicios, $musculos) --}}

<form id="cadastroTreino" class="container-fluid py-4" method="POST" action="/treinos/cadastrar">
  @csrf
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
                  <input class="form-control" type="text" id="name" name="name" placeholder="Nome do treino" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="aluno" class="form-control-label">Nome do aluno</label>
                  <select class="alunos form-select" id="aluno" name="aluno" required>
                    <option value=""></option>
                    @foreach ($alunos as $aluno)
                        <option value="{{$aluno->id}}">{{$aluno->nome}}</option>
                    @endforeach
                  </select>
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
                <div id="1" class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <select class="exercicios form-select" name="exercicio[]" id="selectExercicio" required>
                        <option value=""></option>
                        @foreach ($musculos as $musculo)
                            <optgroup label="{{$musculo->musculo}}">
                              @foreach ($exercicios as $exercicio)
                                  @if ($exercicio->musculo == $musculo->musculo)
                                      <option value="{{$exercicio->id}}">{{$exercicio->nome}}</option>
                                  @endif
                              @endforeach
                            </optgroup>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <input class="form-control" type="number" name="series[]" placeholder="Nº de séries" required>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <input class="form-control" type="number" name="reps[]" placeholder="Nº de repetições" required>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <input class="form-control" type="text" name="carga[]" placeholder="KG" required>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-control-label">Nome do professor</label>
                  <select class="professor form-select" id="professor" name="professor" required>
                    <option value=""></option>
                    @foreach ($professores as $professor)
                        <option value="{{$professor->id}}">{{$professor->nome}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-control-label">Dias da semana</label>
                  <input class="form-control" type="text" name="dias" placeholder="Dias em que o treino será realizado" required>
                </div>
              </div>
              <div class="col-md-12 mt-3">
                <button id="cadastrar" type="submit" class="btn bg-gradient-info shadow-info btn-sm w-100">Cadastrar</button>
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
      inputCarga.setAttribute('type', 'text')
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
        $('.alunos').select2({
          placeholder: 'Escolha o aluno',
          theme: 'bootstrap-5'
        })

        $('.exercicios').select2({
          placeholder: 'Escolha o exercício',
          theme: 'bootstrap-5'
        })

        $('.professor').select2({
          placeholder: 'Escolha o professor',
          theme: 'bootstrap-5'
        })
      });

    // $('#cadastrar').click(function (e) { 
    //     e.preventDefault();
    //     var aluno = $('#aluno').val();
    //     var professor = $('#professor').val();
    //     var nome = $('#name').val();
        

    //     if(nome != ""){
    //       if(aluno == 0){
    //           Swal.fire({
    //               icon: "error",
    //               title: "Erro!",
    //               text: "Selecione algum aluno!"
    //           });
    //       } else if(professor == 0){
    //         Swal.fire({
    //               icon: "error",
    //               title: "Erro!",
    //               text: "Selecione algum professor!"
    //           });
    //       } else {
    //           var form = document.getElementById("cadastroTreino")
    //           form.submit()
    //       }
    //     } else {
    //       Swal.fire({
    //               icon: "error",
    //               title: "Erro!",
    //               text: "Preencha todos os campos!"
    //           });
    //     }

          

    // });

  </script>
 
@endsection