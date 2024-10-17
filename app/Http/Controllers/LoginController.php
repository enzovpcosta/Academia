<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Mail\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
    
        if(!$user){
        return back()->with('error','Email ou senha inválida!');
        }
        
       if(!Hash::check($request->password, $user->password)){
        return back()->with('error','Email ou senha inválida!');
       }
       
       if($user->hasPermission($user->tipo) == false){
           $user->assignPermission($user->tipo);
       }

       auth()->login($user);

       Auth::loginUsingId($user->id);

       return redirect()->route('dashboard');

    }

    public function resetPassword(){
        return view('auth.forgot-password');
    }

    public function newPassword(Request $request){
        // dd($request->all());
        $user = User::where('email', $request->email)->first();
        
        if(!$user){
            return back()->with('error', 'Email inválido!');
        }
        
        $newPassword = substr(md5(time()), 0, 6);
        $user->update([
            'password' => $newPassword
        ]);
        
        Mail::to('costa@gmail.com', 'Costa')->send(new Contact([
            'fromName' => 'Academia',
            'fromEmail' => 'academia@academia',
            'subject' => 'Nova senha',
            'message' => 'Sua nova senha é: '.$newPassword
        ]));

        return to_route('login')->with('novaSenha', 'Sua nova senha foi enviada por e-mail!');
    }

    public function destroy(){
        Auth::logout();

        return redirect()->route('login');
    }
}
