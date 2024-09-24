<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreinoExercicio extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'treino_exercicio';

    protected $fillable = [
        'treino_id',
        'exercicio_id',
        'series',
        'reps',
        'carga'
    ];

    public function exercicios(){
        return $this->hasOne(Exercicio::class, 'id', 'exercicio_id');
    }

    public function treinos(){
        return $this->hasOne(Treino::class, 'id', 'treino_id');
    }
}
