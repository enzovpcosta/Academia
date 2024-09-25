<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function create(){
        return view('auth.login');
    }

    public function store(LoginRequest $request){
        // dd($request->all());

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Este campo é obrigatório',
            'email.email' => 'Digite um email válido',
            'password.required' => 'Este campo é obrigatório'
        ]);

       $user = User::where('email', $request->email)->first();
    //    dd($user);

        if($user->tipo == 'admin'){
            if($request->password == $user->password){
                $user->assignPermission($user->tipo);
                auth()->login($user);
         
                Auth::loginUsingId($user->id);

                return redirect()->route('dashboard');
            }
        }

       if(!$user){
        return back()->withErrors(['error' => 'Email ou senha inválida!']);
       }

       if(!Hash::check($request->password, $user->password)){
        return back()->withErrors(['error' => 'Email ou senha inválida!']);
       }
       if($user->hasPermission($user->tipo) == false){
           $user->assignPermission($user->tipo);
       }

       auth()->login($user);

       Auth::loginUsingId($user->id);

       return redirect()->route('dashboard');

    }

    public function destroy(){
        Auth::logout();

        return redirect()->route('login');
    }
}
