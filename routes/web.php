<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\ExercicioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\TreinoController;
use App\Models\Assinatura;
use App\Models\Treino;
use App\Models\User;
use FontLib\Table\Type\name;

// Route::get('/', function() {
//     User::factory()->create();
//     Assinatura::factory()->create();
// });

Route::middleware('guest')->group(function () {
    
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
    Route::get('/reset-password', [LoginController::class, 'resetPassword']);
    Route::post('/reset-password', [LoginController::class, 'newPassword']);
});


Route::middleware('auth')->group(function () {
    
    Route::get('/', [MenuController::class, '__invoke'])->name('dashboard');
    Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth');
    
    //ROTAS ALUNOS
    
    Route::get('/alunos', [AlunoController::class, 'index']);
    Route::get('/alunos/cadastrar', [AlunoController::class, 'create']);
    Route::post('/alunos/cadastrar', [AlunoController::class, 'store']);
    Route::get('/alunos/editar/{id}', [AlunoController::class, 'edit']);
    Route::put('/alunos/update/{id}', [AlunoController::class, 'update']);
    Route::get('/alunos/perfil/{id}', [AlunoController::class, 'showPerfil'])->name('aluno-perfil');
    Route::get('/alunos/treinos/{id}', [AlunoController::class, 'treinos'])->name('aluno-treinos');
    Route::delete('/alunos/deletar/{id}', [AlunoController::class, 'destroy']);
    Route::get('/alunos/historico/{id}', [TreinoController::class, 'indexHistorico']);
    Route::post('/alunos/historico/{id}', [TreinoController::class, 'storeHistorico']);
    Route::get('/aluno/treino/{id}', [TreinoController::class, 'getTreino']);
    
    //ROTAS PROFESSORES
    
    Route::get('/professores', [ProfessorController::class, 'index']);
    Route::get('/professores/cadastrar', [ProfessorController::class, 'create']);
    Route::post('/professores/cadastrar', [ProfessorController::class, 'store']);
    Route::get('/professores/editar/{id}', [ProfessorController::class, 'edit']);
    Route::put('/professores/update/{id}', [ProfessorController::class, 'update']);
    Route::delete('/professores/deletar/{id}', [ProfessorController::class, 'destroy']);
    Route::get('/professores/perfil/{id}', [ProfessorController::class, 'showPerfil']);
    Route::get('/professores/treinos/{id}', [ProfessorController::class, 'treinos']);
    
    //ROTAS EXERCICIOS
    
    Route::get('/exercicios', [ExercicioController::class, 'index']);
    Route::get('/exercicios/cadastrar', [ExercicioController::class, 'create']);
    Route::post('/exercicios/cadastrar', [ExercicioController::class, 'store']);
    Route::get('/exercicios/editar/{id}', [ExercicioController::class, 'edit']);
    Route::put('/exercicios/update/{id}', [ExercicioController::class, 'update']);
    Route::delete('/exercicios/deletar/{id}', [ExercicioController::class, 'destroy']);
    
    // ROTAS TREINOS
    
    Route::get('/treinos', [TreinoController::class, 'index']);
    Route::get('/treinos/cadastrar', [TreinoController::class, 'create']);
    Route::post('/treinos/cadastrar', [TreinoController::class, 'store']);
    Route::get('/treinos/todos', [TreinoController::class, 'todos']);
    Route::post('/treinos/alunos', [TreinoController::class, 'alunos']);
    Route::get('/treinos/editar/{id}', [TreinoController::class, 'edit']);
    Route::put('/treinos/update/{id}', [TreinoController::class, 'update']);
    Route::put('/treinos/deletar/{id}', [TreinoController::class, 'destroy']);
    Route::get('/treinos/download/{id}', [PdfController::class, 'pdf']);

});