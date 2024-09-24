<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Exercicio;
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
            ['cpf', 'like', '%'.$search.'%']
        ])->first();
      //   dd($aluno);
        $treinos = Treino::where('user_id',$aluno->id)->get();
      //   dd($treinos);
     } else {

     $treinos = Treino::all();
     
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
      $professores = User::where('tipo', 'professor')->orderBy('nome', 'asc')->get();
      $exercicios = Exercicio::orderBy('nome', 'asc')->get();
      $musculos = Exercicio::distinct()->orderBy('musculo', 'asc')->get(['musculo']);

      return view('site.treinos.cadastro-treino', ['alunos' => $alunos, 'professores' => $professores, 'exercicios' => $exercicios, 'musculos' => $musculos]);

   }

   public function store(Request $request){
      // dd($request->all());

      $treino = new Treino;

      $treino->nome = $request->name;
      $treino->dias = $request->dias;
      $treino->user_id = $request->aluno;
      $treino->professor_id = $request->professor;

      // dd($request->exercicio);

      $treino->save();

      // dd($treino->id);
      $i = 0;

      for($i = 0;$i<count($request->exercicio);$i++){
         $treinoExercicio = new TreinoExercicio;

         $treinoExercicio->treino_id = $treino->id;
         $treinoExercicio->exercicio_id = $request->exercicio[$i];
         $treinoExercicio->series = $request->series[$i];
         $treinoExercicio->reps = $request->reps[$i];
         $treinoExercicio->carga = $request->carga[$i];
         // dd($treinoExercicio);

         $treinoExercicio->save();

         // dd($treinoExercicio);
      }

      return redirect('/treinos')->with('msg', 'Treino cadastrado com sucesso!');

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

   $i = 0;

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
            'carga' => $request->carga[$i]
         ]);
      } else {
         $treinoExercicio = new TreinoExercicio;

         $treinoExercicio->treino_id = $request->id;
         $treinoExercicio->exercicio_id = $request->exercicio[$i];
         $treinoExercicio->series = $request->series[$i];
         $treinoExercicio->reps = $request->reps[$i];
         $treinoExercicio->carga = $request->carga[$i];
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
   Treino::findOrFail($id)->delete();

   return back()->with('msg', 'Treino excluído com sucesso');
}

}