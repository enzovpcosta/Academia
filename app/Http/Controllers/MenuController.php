<?php

namespace App\Http\Controllers;

use App\Models\Exercicio;
use App\Models\Treino;
use App\Models\User;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $alunos = User::where('tipo', 'aluno')->get();
        $professores = User::where('tipo', 'professor')->get();
        $exercicios = Exercicio::all();
        $treinos = Treino::all();

        return view('site.dashboard', ['alunos' => $alunos, 'professores' => $professores, 'exercicios' => $exercicios, 'treinos' => $treinos]);
    }
}