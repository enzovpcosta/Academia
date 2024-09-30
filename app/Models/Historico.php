<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historico extends Model
{
    use HasFactory;

    protected $table = 'historico';

    public $timestamps = false;

    protected $fillable = [
        'treino_id',
        'user_id',
        'data'
    ];

    public function treino(){
        return $this->hasOne(Treino::class, 'id', 'treino_id');
    }
}
