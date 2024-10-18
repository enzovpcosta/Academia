<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Exercicio;
use App\Models\Historico;
use App\Models\Treino;
use App\Models\TreinoExercicio;
use Faker\Core\Number;

class TreinoController extends Controller
{
   public function index(){
      
      $search = request('search');

      if($search){
         $aluno = User::where([
            'tipo' => 'aluno',
            'cpf' => $search
        ])->first();
      //   dd($aluno);
            if($aluno){
               $treinos = Treino::where([
                  'user_id' => $aluno->id,
                  'ativo' => true
               ])->paginate(10);
            } else {
               $treinos = [];
            }
      //   dd($treinos);
     } else {

     $treinos = 'menu';
     
 }
      return view('site.treinos.menu-treinos', ['treinos' => $treinos, 'search' => $search]);
   }

   public function todos(){
      $exercicios = Exercicio::orderBy('nome', 'asc')->get();
      $musculos = Exercicio::distinct()->orderBy('musculo', 'asc')->get(['musculo']);
      return json_encode([
         $exercicios,
         $musculos
      ]);

   }

   public function alunos(Request $request){
      dd($request->all());
      $nomes = [];
      if($search=$request->name){
         $nomes = User::where([
         'tipo' => 'aluno',
         ['nome', 'like', '%'.$search.'%']
      ])->get();
      }
      
      return response()->json($nomes);
   }

   public function create(){
   
      $alunos = User::where('tipo', 'aluno')->orderBy('nome', 'asc')->get();
      $exercicios = Exercicio::orderBy('nome', 'asc')->get();
      $musculos = Exercicio::distinct()->orderBy('musculo', 'asc')->get(['musculo']);

      return view('site.treinos.cadastro-treino', ['alunos' => $alunos, 'exercicios' => $exercicios, 'musculos' => $musculos]);

   }

   public function store(Request $request){
      // dd($request->all());

      $treino = new Treino;

      $treino->nome = $request->name;
      $treino->dias = $request->dias;
      $treino->user_id = $request->aluno;
      $treino->professor_id = auth()->user()->id;
      $treino->ativo = true;

      // dd($request->exercicio);

      $treino->save();

      // dd($treino->id);
      // $i = 0;

      for($i = 0;$i<count($request->exercicio);$i++){
         $treinoExercicio = new TreinoExercicio;

         $treinoExercicio->treino_id = $treino->id;
         $treinoExercicio->exercicio_id = $request->exercicio[$i];
         $treinoExercicio->series = $request->series[$i];
         $treinoExercicio->reps = $request->reps[$i];
         $treinoExercicio->carga = $request->carga[$i];
         $treinoExercicio->intervalo = $request->intervalo[$i];
         $treinoExercicio->observacoes = $request->observacoes[$i];
         // dd($treinoExercicio);

         $treinoExercicio->save();

         // dd($treinoExercicio);
      }

      $aluno = User::findOrFail($request->aluno);

      return redirect('/treinos?search='.$aluno->cpf)->with('msg', 'Treino cadastrado com sucesso!');

   }

   public function edit($id){
      $treino = Treino::findOrFail($id);
      $exerciciosAluno = TreinoExercicio::where('treino_id', $id)->get();
      $exerciciosTodos = Exercicio::orderBy('nome', 'asc')->get();
      $musculos = Exercicio::distinct()->orderBy('musculo', 'asc')->get(['musculo']);

      return view('site.treinos.editar-treino', ['treino' => $treino, 'exerciciosAluno' => $exerciciosAluno, 'exerciciosTodos' => $exerciciosTodos, 'musculos' => $musculos]);
  }

  public function update(Request $request){

   // dd($request->exercicio);

   Treino::findOrFail($request->id)->update([
      'nome' => $request->treino,
      'dias' => $request->dias,
   ]);

   // $i = 0;

   for($i = 0;$i<count($request->exercicio);$i++){
      $exercicio = TreinoExercicio::where([
         'treino_id' => $request->id,
         'exercicio_id' => $request->exercicio[$i]
      ])->get();
      // dd($exercicio);

      if(count($exercicio) > 0){
         TreinoExercicio::where([
            'treino_id' => $request->id,
            'exercicio_id' => $request->exercicio[$i]
         ])->update([
            'series' => $request->series[$i],
            'reps' => $request->reps[$i],
            'carga' => $request->carga[$i],
            'intervalo' => $request->intervalo[$i],
            'observacoes' => $request->observacoes[$i]
         ]);
      } else {
         $treinoExercicio = new TreinoExercicio;

         $treinoExercicio->treino_id = $request->id;
         $treinoExercicio->exercicio_id = $request->exercicio[$i];
         $treinoExercicio->series = $request->series[$i];
         $treinoExercicio->reps = $request->reps[$i];
         $treinoExercicio->carga = $request->carga[$i];
         $treinoExercicio->intervalo = $request->intervalo[$i];
         $treinoExercicio->observacoes = $request->observacoes[$i];
         // dd($treinoExercicio);

         $treinoExercicio->save();

         // dd($treinoExercicio);
      }
      
   }

   $exerciciosAll = TreinoExercicio::where('treino_id', $request->id)->get();
   $ex = [];
   foreach($exerciciosAll as $exercicio){
      $ex[] = $exercicio->exercicio_id;
   }
   // dd($ex, $request->exercicio);
   for($i = 0; $i<count($ex); $i++){
      // dd(array_search($ex[$i], $request->exercicio));
     if(in_array($ex[$i], $request->exercicio) == false){
      TreinoExercicio::where([
         'treino_id' => $request->id,
         'exercicio_id' => $ex[$i]
      ])->delete();
     }
   }

   return redirect('/treinos')->with('msg', 'Treino editado com sucesso');
}

public function destroy($id){
   $treino = Treino::where('id', $id)->first();
   $treino->update([
      'ativo' => false
   ]);

   return redirect('/alunos/treinos/'.$treino->user_id)->with('msg', 'Treino excluído com sucesso');
}

public function indexHistorico($id){
   $historico = Historico::where('user_id', $id)->with('treino')->orderBy('data', 'desc')->paginate(10);

   return view('site.alunos.historico-alunos', ['historico' => $historico, 'idAluno' => $id]);
}

public function storeHistorico(Request $request){
   // dd($request->id);
   $aluno = Treino::where('id', $request->id)->first();

   $historico = new Historico;

   $historico->treino_id = $request->id;
   $historico->user_id = $aluno->user_id;
   $historico->data = $request->data;

   $historico->save();

   return redirect('/alunos/treinos/'.auth()->user()->id)->with('msg', 'O treino foi salvo no histórico de treinos!');
}

public function getTreino($id){
   $treino = Treino::findOrFail($id);
   return json_encode([
      $treino
   ]);
}

}