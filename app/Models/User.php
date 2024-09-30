<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'tipo',
        'cpf',
        'nascimento',
        'contato',
        'email',
        'password',
        'image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    
    public function assinatura(){
        return $this->hasOne(Assinatura::class);
    }
    
    public function especialidades(){
        return $this->hasOne(Especialidade::class);
    }
    
    public function horarios(){
        return $this->hasMany(Horario::class);
    }
    
    public function treinos(){
        return $this->belongsToMany(Treino::class);
    }
    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }

    public function hasPermission($permission){
        return $this->permissions()->where('name', $permission)->exists();
    }

    public function assignPermission($permission){
        $permission = $this->permissions()->where('name', $permission)->firstOrCreate([
            'name' => $permission,
        ]);

        $this->permissions()->attach($permission);
    }

    public function removePermission($permission){
        $permission = $this->permissions()->where('name', $permission)->first();

        if($permission){
            $this->permissions()->detach($permission);
        }
    }
}
