<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treino extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'nome',
        'dias',
        'user_id',
        'professor_id'
    ];

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    
    public function professor(){
        return $this->hasOne(User::class, 'id', 'professor_id');
    }

    public function historicos(){
        return $this->belongsToMany(Historico::class);
    }

    public function treinoExercicio(){
        return $this->belongsToMany(TreinoExercicio::class);
    }
}
