<?php

namespace App\Http\Controllers;

use App\Models\Assinatura;
use App\Models\Exercicio;
use App\Models\Treino;
use App\Models\User;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function __invoke(Request $request)
    {

        if(auth()->user()->hasPermission('aluno')){
            $treinos = Treino::where('user_id', auth()->user()->id)->get();
            $plano = Assinatura::where('user_id', auth()->user()->id)->first();
        } elseif(auth()->user()->hasPermission('professor')) {
            $treinos = Treino::where('professor_id', auth()->user()->id)->get();
            $plano = '';
        } else {
            $treinos = Treino::all();
            $plano = '';

        }

        $alunos = User::where('tipo', 'aluno')->get();
        $professores = User::where('tipo', 'professor')->get();
        $exercicios = Exercicio::all();
        $admins = User::where('tipo', 'admin')->get();
        
        return view('site.dashboard', ['alunos' => $alunos, 'professores' => $professores, 'exercicios' => $exercicios, 'treinos' => $treinos, 'plano' => $plano, 'admins' => $admins]);

    }
}