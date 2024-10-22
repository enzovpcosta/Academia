<?php

namespace App\Http\Controllers;

use App\Models\Treino;
use App\Models\TreinoExercicio;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function pdf($id){
        $treino = Treino::findOrFail($id);
        $exercicios = TreinoExercicio::where('treino_id', $id)->with('exercicios')->get();
        // dd($exercicios);
        $pdf = Pdf::loadView('site.pdf',['treino' => $treino, 'exercicios' => $exercicios]);
        return $pdf->stream('treino-'.$treino->nome.'.pdf');

    }
}
