<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Treino</title>
</head>
<style>
    #tabela{
        border-collapse: collapse;
        width: 100%;
    }
    #tabela th, td{
        border: 1px solid black;
        padding: 8px;
        text-align: center
    }

</style>
<body>
    {{-- @dd($treino->user) --}}
    <h4>Nome do treino: {{$treino->nome}}</h4>
    <h4>Nome do aluno: {{$treino->user->nome}}</h4>
    <h4>Criado por: {{$treino->professor->nome}}</h4>
    <div class="div-tabela">
        <table id="tabela">
            <tr>
                <th>Exercício</th>
                <th>Séries</th>
                <th>Repetições</th>
                <th>Carga</th>
                <th>Intervalo</th>
                <th>Observações</th>
            </tr>
            @foreach ($exercicios as $exercicio)
                <tr>
                    <td>{{$exercicio->exercicios->nome}}</td>
                    <td>{{$exercicio->series}}</td>
                    <td>{{$exercicio->reps}}</td>
                    <td>{{$exercicio->carga}}</td>
                    <td>{{$exercicio->intervalo}}</td>
                    <td>{{$exercicio->observacoes}}</td>
                </tr>
            @endforeach
        </table>
    </div>
</body>
</html>