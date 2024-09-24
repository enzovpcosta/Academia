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
use App\Models\User;

// Route::get('/dashboard', [MenuController::class, '__invoke'])->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//     // Route::get('/', [MenuController::class, '__invoke']);
// });

// Route::get('/', function(){

//     $user = User::where('email', 'enzo@gmail.com')->first();
//     $user->assignPermission('admin');
//     auth()->login($user);

//     return view('site.dashboard');
// });
Route::get('/login', [LoginController::class, 'create']);
Route::post('/login', [LoginController::class, 'store']);

Route::get('/', [MenuController::class, '__invoke']);

// ROTAS ALUNOS

Route::get('/alunos', [AlunoController::class, 'index'] );
Route::get('/alunos/cadastrar', [AlunoController::class, 'create']);
Route::post('/alunos/cadastrar', [AlunoController::class, 'store']);
Route::get('/alunos/editar/{id}', [AlunoController::class, 'edit']);
Route::put('/alunos/update/{id}', [AlunoController::class, 'update']);
Route::delete('/alunos/deletar/{id}', [AlunoController::class, 'destroy']);
Route::get('/alunos/perfil/{id}', [AlunoController::class, 'showPerfil']);
Route::get('/alunos/treinos/{id}', [AlunoController::class, 'treinos']);

// ROTAS PROFESSORES

Route::get('/professores', [ProfessorController::class, 'index']);
Route::get('/professores/cadastrar', [ProfessorController::class, 'create']);
Route::post('/professores/cadastrar', [ProfessorController::class, 'store']);
Route::get('/professores/editar/{id}', [ProfessorController::class, 'edit']);
Route::put('/professores/update/{id}', [ProfessorController::class, 'update']);
Route::delete('/professores/deletar/{id}', [ProfessorController::class, 'destroy']);
Route::get('/professores/perfil/{id}', [ProfessorController::class, 'showPerfil']);
Route::get('/professores/treinos/{id}', [ProfessorController::class, 'treinos']);

// ROTAS EXERCÍCIOS

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
Route::delete('/treinos/deletar/{id}', [TreinoController::class, 'destroy']);
Route::get('/treinos/download/{id}', [PdfController::class, 'pdf']);

require __DIR__.'/auth.php';

