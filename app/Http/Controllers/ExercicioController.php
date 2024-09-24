<?php

namespace App\Http\Controllers;

use App\Models\Exercicio;
use Illuminate\Http\Request;

class ExercicioController extends Controller
{
    public function index(){

        $search = request('search');

        if($search){

            $exercicios = Exercicio::where([
                ['nome', 'like', '%'.$search.'%']
            ])->paginate(8);

        } else {

            $exercicios = Exercicio::orderBy('musculo', 'asc')->orderBy('nome', 'asc')->paginate(8);
        
        }

        return view('site.exercicios.menu-exercicios', ['exercicios' => $exercicios]);

    }



    public function create(){
        return view('site.exercicios.cadastro-exercicio');
    }

    public function store(Request $request){
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'musculo' => 'required'
        ], [
            'name.required' => 'Este campo é obrigatório',
            'musculo.required' => 'Este campo é obrigatório'
        ]);

        $existeExercicio = Exercicio::where('nome', $request->name)->get();
        if(count($existeExercicio) > 0){
            return redirect('/exercicios/cadastrar')->with('msg', 'Exercício já cadastrado!');
        }

        $exercicio = new Exercicio;

        $exercicio->nome = $request->name;
        $exercicio->musculo = $request->musculo;

        $exercicio->save();

        return redirect('/exercicios')->with('msg', 'Exercício cadastrado com sucesso!');
    }

    public function edit($id){
        $exercicio = Exercicio::findOrFail($id);

        return view('site.exercicios.editar-exercicio', ['exercicio' => $exercicio]);
    }

    public function update(Request $request){
        
        Exercicio::findOrFail($request->id)->update([
            'nome' => $request->name,
            'musculo' => $request->musculo
        ]);
        
        return redirect('/exercicios')->with('msg', 'Exercício editado com sucesso');
    }

    public function destroy($id){
        Exercicio::findOrFail($id)->delete();

        return redirect('/exercicios')->with('msg', 'Exercício excluído com sucesso');
    }
}

