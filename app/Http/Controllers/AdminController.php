<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){

        if(!auth()->user()->hasPermission('admin')){
            return to_route('dashboard');
        }

        $admins = User::where('tipo', 'admin')->orderBy('nome', 'asc')->paginate(10);

        return view('site.admins.menu-admins', ['admins' => $admins]);
    }

    public function create(){

        if(!auth()->user()->hasPermission('admin')){
            return to_route('dashboard');
        }

        return view('site.admins.cadastro-admin');

    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required',
            'cpf' => 'required|size:14',
            'nascimento' => 'required|date',
            'telefone' => 'required|size:15',
            'email' => 'required|email',
            'senha' => 'required|min:4',
        ],[
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
        ]);

        if(count(User::where('cpf', preg_replace('/[^A-Za-z0-9]/', '', $request->cpf))->get()) > 0){
            return back()->withErrors(['error' => 'CPF já cadastrado!']);
        }
        if(count(User::where('email', $request->email)->get()) > 0){
            return back()->withErrors(['errorEmail' => 'Email já cadastrado!']);
        }

        $admin = new User;

        $admin->nome = $request->name;
        $admin->cpf = preg_replace('/[^A-Za-z0-9]/', '', $request->cpf);
        $admin->nascimento = $request->nascimento;
        $admin->contato = $request->telefone;
        $admin->email = $request->email;
        $admin->password = $request->senha;

        $admin->save();

        $admin->assignPermission('admin');

        return redirect('/administradores')->with('msg', 'Administrador cadastrado com sucesso!');
    }

    public function edit($id){

        if(!auth()->user()->hasPermission('admin')){
            return to_route('dashboard');
        }

        $admin = User::find($id);

        return view('site.admins.editar-admin', ['admin' => $admin]);
    }

    public function update(Request $request){
        // dd($request->all());

        $request->validate([
            'name' => 'required',
            'cpf' => 'required|size:14',
            'nascimento' => 'required|date',
            'telefone' => 'required|size:15',
            'email' => 'required|email',
            'senha' => 'required|min:4',
        ],[
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
        ]);

        $admin = User::find($request->id);

        $admin->update([
            'name' => $request->name,
            'cpf' => preg_replace('/[^A-Za-z0-9]/', '', $request->cpf),
            'nascimento' => $request->nascimento,
            'contato' => $request->telefone,
            'email' => $request->email,
            'password' => $request->senha
        ]);

        return redirect('/administradores')->with('msg', 'Administrador editado com sucesso!');
    }

    public function destroy($id){
        User::find($id)->delete();

        return back()->with('msg', 'Administrador excluído com sucesso');
    }
}
