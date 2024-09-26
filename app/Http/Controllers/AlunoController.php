<?php

namespace App\Http\Controllers;

use App\Models\Assinatura;
use App\Models\Treino;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class AlunoController extends Controller
{
    public function index(){

        if(auth()->user()->hasPermission('aluno')){
            return to_route('dashboard');
        }
        
        $search = request('search');

        if($search){

            $alunos = User::where([
                'tipo' => 'aluno',
                ['cpf', 'like', '%'.$search.'%']
            ])->with('assinatura')->paginate(10);

        } else {

            $alunos = User::where('tipo', 'aluno')->with('assinatura')->paginate(10);
        // dd($alunos);
            $assinaturas = Assinatura::all();
            foreach ($assinaturas as $assinatura){
                if($assinatura->vencimento < date('Y-m-d')){
                    Assinatura::where('user_id', $assinatura->user_id)->update([
                        'ativo' => false,
                    ]);
                } else {
                    Assinatura::where('user_id', $assinatura->user_id)->update([
                        'ativo' => true,
                    ]);
                }
            }
        }

        return view('site.alunos.menu-alunos', ['alunos' => $alunos, 'search' => $search]);

    }

    public function create(){

        if(auth()->user()->hasPermission('aluno')){
            return to_route('dashboard');
        }

        return view('site.alunos.cadastro-aluno');

    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required',
            'cpf' => 'required|size:14',
            'nascimento' => 'required|date',
            'telefone' => 'required|size:15',
            'email' => 'required|email',
            'senha' => 'required|min:4',
            'plano' => 'required',
            'image' => 'required'
        ], [
            'name.required' => 'Este campo é obrigatório',
            'cpf.required' => 'Este campo é obrigatório',
            'cpf.size' => 'Digite um CPF válido',
            'nascimento.required' => 'Este campo é obrigatório',
            'nascimento.date' => 'Escolha uma data válida',
            'telefone.required' => 'Este campo é obrigatório',
            'telefone.size' => 'Digite um telefone válido',
            'email.required' => 'Este campo é obrigatório',
            'email.email' => 'Digite um email válido',
            'senha.required' => 'Este campo é obrigatório',
            'senha.min' => 'A senha deve ter no mínimo :min caracteres',
            'plano.required' => 'Este campo é obrigatório',
            'image.required' => 'Este campo é obrigatório',
        ]);

        $aluno = new User;

        $aluno->nome = $request->name;
        $aluno->tipo = 'aluno';
        $aluno->cpf = preg_replace('/[^A-Za-z0-9]/', '', $request->cpf);
        $aluno->nascimento = $request->nascimento;
        $aluno->contato = $request->telefone;
        $aluno->email = $request->email;
        $aluno->password = $request->senha;

        if($request->hasFile('image') && $request->file('image')->isValid()){
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $request->image->move(public_path('assets/img/alunos'), $imageName);

            $aluno->image = $imageName;
        }

        $aluno->save();

        $aluno->assignPermission('aluno');

        $assinatura = new Assinatura;

        $assinatura->plano = $request->plano;
        $assinatura->ativo = true;
        $assinatura->obtencao = date('Y-m-d');

        if($request->plano == 'Mensal'){

            $assinatura->vencimento = date('Y-m-d', strtotime('+1 month', strtotime($assinatura->obtencao)));

        } elseif ($request->plano == 'Trimestral'){

            $assinatura->vencimento = date('Y-m-d', strtotime('+3 months', strtotime($assinatura->obtencao)));

        } elseif ($request->plano == 'Semestral'){

            $assinatura->vencimento = date('Y-m-d', strtotime('+6 months', strtotime($assinatura->obtencao)));

        } else {
            $assinatura->vencimento = date('Y-m-d', strtotime('+1 year', strtotime($assinatura->obtencao)));
        }

        $assinatura->user_id = $aluno->id;
        $assinatura->save();

        return redirect('/alunos')->with('msg', 'Aluno cadastrado com sucesso!');

    }

    public function edit($id){
        $aluno = User::findOrFail($id);

        if(auth()->user()->hasPermission('aluno')){
            if(auth()->user()->id == $aluno->id){
                return view('site.alunos.editar-aluno', ['aluno' => $aluno->load('assinatura')]);
            } else {
                return redirect()->route('dashboard');
            }
        }

        return view('site.alunos.editar-aluno', ['aluno' => $aluno->load('assinatura')]);

    }
    
    public function update(Request $request){

        $aluno = User::findOrFail($request->id);

        $image_path = public_path('assets/img/alunos/'.$aluno->image);

        if(file_exists($image_path)) {
            unlink($image_path);
        }

        if($request->hasFile('image') && $request->file('image')->isValid()){
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $request->image->move(public_path('assets/img/alunos'), $imageName);

        }
        
        $aluno->update([
            'nome' => $request->name,
            'cpf' => preg_replace('/[^A-Za-z0-9]/', '', $request->cpf),
            'nascimento' => $request->nascimento,
            'contato' => $request->contato,
            'email' => $request->email,
            'password' => $request->senha,
            'image' => $imageName
        ]);

        if(auth()->user()->hasPermission('admin') || auth()->user()->hasPermission('professor')){
            
            if($request->plano == 'Mensal'){
    
                $vencimento = date('Y-m-d', strtotime('+1 month', strtotime(date('Y-m-d'))));
    
            } elseif ($request->plano == 'Trimestral'){
    
                $vencimento = date('Y-m-d', strtotime('+3 months', strtotime(date('Y-m-d'))));
    
            } elseif ($request->plano == 'Semestral'){
    
                $vencimento = date('Y-m-d', strtotime('+6 months', strtotime(date('Y-m-d'))));
    
            } else {
                $vencimento = date('Y-m-d', strtotime('+1 year', strtotime(date('Y-m-d'))));
            }
            
            Assinatura::where('user_id', $request->id)->update([
                'plano' => $request->plano,
                'ativo' => true,
                'obtencao' => date('Y-m-d'),
                'vencimento' => $vencimento
            ]);

            return redirect('/alunos')->with('msg', 'Aluno editado com sucesso');
        }

         return redirect('/alunos/perfil/'.$request->id)->with('msg', 'Editado com sucesso'); 
        
    }

    public function destroy($id){

        // Assinatura::where('user_id', $id)->delete();
        $aluno = User::findOrFail($id);
        $image_path = public_path('assets/img/alunos/'.$aluno->image);
        $aluno->removePermission('aluno');

        if(file_exists($image_path)) {
            unlink($image_path);
        }

        $aluno->delete();

        return redirect('/alunos')->with('msg', 'Aluno excluído com sucesso');
    }

    public function showPerfil($id){

        $aluno = User::findOrFail($id);

        return view('site.alunos.perfil-alunos', ['aluno' => $aluno->load('assinatura')]);

    }

    public function treinos($id){
        $treinos = Treino::where('user_id', $id)->get();
        $aluno = User::where('id', $id)->first();
        
        return view('site.alunos.treinos-alunos', ['treinos' => $treinos, 'aluno' => $aluno]);
    }
}
