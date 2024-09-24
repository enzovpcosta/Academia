<?php

namespace App\Http\Controllers;

use App\Models\Especialidade;
use App\Models\Horario;
use App\Models\Treino;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfessorController extends Controller
{
    public function index(){

        $search = request('search');

        if($search){
            $professores = User::where([
                'tipo' => 'professor',
                ['nome', 'like', '%'.$search.'%']
            ])->with(['especialidades', 'horarios'])->paginate(8);
        } else {

        $professores = User::where('tipo','professor')->with(['especialidades', 'horarios'])->paginate(8);
        
    }

    return view('site.professores.menu-professores', ['professores' => $professores, 'search' => $search]);

 }

    public function create(){

        return view('site.professores.cadastro-professor');

    }

    public function store(Request $request){

        $professor = new User;

        $professor->nome = $request->name;
        $professor->tipo = 'professor';
        $professor->cpf = $request->cpf;
        $professor->nascimento = $request->nascimento;
        $professor->contato = $request->telefone;
        $professor->email = $request->email;
        $professor->password = Hash::make('password');

        if($request->hasFile('image') && $request->file('image')->isValid()){
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $request->image->move(public_path('assets/img/professores'), $imageName);

            $professor->image = $imageName;
        }

        $professor->save();

        if(isset($request->segundaInicio) && isset($request->segundaFim)){

            $horario = new Horario;

            $horario->inicio = $request->segundaInicio;
            $horario->fim = $request->segundaFim;
            $horario->dia = "Segunda";
            $horario->user_id = $professor->id;

            $horario->save();
        }

        if(isset($request->tercaInicio) && isset($request->tercaFim)){

            $horario = new Horario;

            $horario->inicio = $request->tercaInicio;
            $horario->fim = $request->tercaFim;
            $horario->dia = "Terça";
            $horario->user_id = $professor->id;

            $horario->save();
        }

        if(isset($request->quartaInicio) && isset($request->quartaFim)){

            $horario = new Horario;

            $horario->inicio = $request->quartaInicio;
            $horario->fim = $request->quartaFim;
            $horario->dia = "Quarta";
            $horario->user_id = $professor->id;

            $horario->save();
        }

        if(isset($request->quintaInicio) && isset($request->quintaFim)){

            $horario = new Horario;

            $horario->inicio = $request->quintaInicio;
            $horario->fim = $request->quintaFim;
            $horario->dia = "Quinta";
            $horario->user_id = $professor->id;

            $horario->save();
        }

        if(isset($request->sextaInicio) && isset($request->sextaFim)){

            $horario = new Horario;

            $horario->inicio = $request->sextaInicio;
            $horario->fim = $request->sextaFim;
            $horario->dia = "Sexta";
            $horario->user_id = $professor->id;

            $horario->save();
        }

        if(isset($request->sabadoInicio) && isset($request->sabadoFim)){

            $horario = new Horario;

            $horario->inicio = $request->segundaInicio;
            $horario->fim = $request->sabadoFim;
            $horario->dia = "Sábado";
            $horario->user_id = $professor->id;

            $horario->save();
        }

        $especialidade = new Especialidade;

        $especialidade->nome = $request->especialidade;
        $especialidade->user_id = $professor->id;

        $especialidade->save();

        return redirect('/professores')->with('msg', 'Professor cadastrado com sucesso!');

    }

    public function edit($id){
        $professor = User::findOrFail($id);

        return view('site.professores.editar-professor', ['professor' => $professor->load('especialidades', 'horarios')]);
    }
    
    public function update(Request $request){

        if(isset($request->segundaInicio) && isset($request->segundaFim)){

            $horario = Horario::where([
                'dia' => 'Segunda',
                'user_id' => $request->id
            ])->get();

            if(count($horario) == 0){
                
                $horario = new Horario;

                $horario->inicio = $request->segundaInicio;
                $horario->fim = $request->segundaFim;
                $horario->dia = "Segunda";
                $horario->user_id = $request->id;

                $horario->save();

            } else {

                Horario::where([
                    'dia' => 'Segunda',
                    'user_id' => $request->id
                ])->update([
                    'inicio' => $request->segundaInicio,
                    'fim' => $request->segundaFim
                ]);
            }

        } else {
            Horario::where([
                'dia' => 'Segunda',
                'user_id' => $request->id
            ])->delete();
        }
        
        if(isset($request->tercaInicio) && isset($request->tercaFim)){

            $horario = Horario::where([
                'dia' => 'Terça',
                'user_id' => $request->id
            ])->get();

            if(count($horario) == 0){
                
                $horario = new Horario;

                $horario->inicio = $request->tercaInicio;
                $horario->fim = $request->tercaFim;
                $horario->dia = "Terça";
                $horario->user_id = $request->id;

                $horario->save();

            } else {
                Horario::where([
                    'dia' => 'Terça',
                    'user_id' => $request->id
                ])->update([
                    'inicio' => $request->tercaInicio,
                    'fim' => $request->tercaFim
                ]);
            }

        } else {
            Horario::where([
                'dia' => 'Terça',
                'user_id' => $request->id
            ])->delete();
        }
        
        if(isset($request->quartaInicio) && isset($request->quartaFim)){

            $horario = Horario::where([
                'dia' => 'Quarta',
                'user_id' => $request->id
            ])->get();

            if(count($horario) == 0){
                
                $horario = new Horario;

                $horario->inicio = $request->quartaInicio;
                $horario->fim = $request->quartaFim;
                $horario->dia = "Quarta";
                $horario->user_id = $request->id;

                $horario->save();

            } else {

                Horario::where([
                    'dia' => 'Quarta',
                    'user_id' => $request->id
                ])->update([
                    'inicio' => $request->quartaInicio,
                    'fim' => $request->quartaFim
                ]);
            }

        } else {
            Horario::where([
                'dia' => 'Quarta',
                'user_id' => $request->id
            ])->delete();
        }
        
        if(isset($request->quintaInicio) && isset($request->quintaFim)){

            $horario = Horario::where([
                'dia' => 'Quinta',
                'user_id' => $request->id
            ])->get();

            if(count($horario) == 0){
                
                $horario = new Horario;

                $horario->inicio = $request->quintaInicio;
                $horario->fim = $request->quintaFim;
                $horario->dia = "Quinta";
                $horario->user_id = $request->id;

                $horario->save();

            } else {

                Horario::where([
                    'dia' => 'Quinta',
                    'user_id' => $request->id
                ])->update([
                    'inicio' => $request->quintaInicio,
                    'fim' => $request->quintaFim
                ]);
            }

        } else {
            Horario::where([
                'dia' => 'Quinta',
                'user_id' => $request->id
            ])->delete();
        }
        
        if(isset($request->sextaInicio) && isset($request->sextaFim)){

            $horario = Horario::where([
                'dia' => 'Sexta',
                'user_id' => $request->id
            ])->get();

            if(count($horario) == 0){
                
                $horario = new Horario;

                $horario->inicio = $request->sextaInicio;
                $horario->fim = $request->sextaFim;
                $horario->dia = "Sexta";
                $horario->user_id = $request->id;

                $horario->save();

            } else {

                Horario::where([
                    'dia' => 'Sexta',
                    'user_id' => $request->id
                ])->update([
                    'inicio' => $request->sextaInicio,
                    'fim' => $request->sextaFim
                ]);
            }

        } else {
            Horario::where([
                'dia' => 'Sexta',
                'user_id' => $request->id
            ])->delete();
        }
        
        if(isset($request->sabadoInicio) && isset($request->sabadoFim)){

            $horario = Horario::where([
                'dia' => 'Sábado',
                'user_id' => $request->id
            ])->get();

            if(count($horario) == 0){
                
                $horario = new Horario;

                $horario->inicio = $request->sabadoInicio;
                $horario->fim = $request->sabadoFim;
                $horario->dia = "Sábado";
                $horario->user_id = $request->id;

                $horario->save();

            } else {

                Horario::where([
                    'dia' => 'Sábado',
                    'user_id' => $request->id
                ])->update([
                    'inicio' => $request->sabadoInicio,
                    'fim' => $request->sabadoFim
                ]);
            }

        } else {
            Horario::where([
                'dia' => 'Sábado',
                'user_id' => $request->id
            ])->delete();
        }
        
        User::findOrFail($request->id)->update([
            'nome' => $request->name,
            'cpf' => $request->cpf,
            'nascimento' => $request->nascimento,
            'contato' => $request->contato,
            'email' => $request->email,
            'senha' => $request->senha
        ]);

        Especialidade::where('user_id', $request->id)->update([
            "nome" => $request->especialidade
        ]);
        
        return redirect('/professores')->with('msg', 'Professor editado com sucesso');
    }

    public function destroy($id){

        // Horario::where('user_id', $id)->delete();
        // Especialidade::where('user_id', $id)->delete();
        $professor = User::findOrFail($id);
        $image_path = public_path('assets/img/professores/'.$professor->image);

        if(file_exists($image_path)) {
            unlink($image_path);
        }

        $professor->delete();

        return redirect('/professores')->with('msg', 'Professor excluído com sucesso');

    }

    public function showPerfil($id){

        $professor = User::findOrFail($id);

        return view('site.professores.perfil-professores', ['professor' => $professor->load('especialidades', 'horarios')]);

    }

    public function treinos($id){
        $treinos = Treino::where('professor_id', $id)->get();
        $professor = User::where('id', $id)->first();
        
        return view('site.professores.treinos-professores', ['treinos' => $treinos, 'professor' => $professor]);
    }

}
