<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $credencials = $request->only('email', 'password');
        // dd($credencials);
        Auth::attempt($credencials);

    }
}
