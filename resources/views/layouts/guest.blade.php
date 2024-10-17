<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Login</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="shortcut icon" href="{{asset('assets/img/unifae-logo-verde.png')}}" type="image/x-icon">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="{{asset('assets/css/login.css')}}">
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="imagem-fae">
                <img width="300px" src="{{asset('assets/img/unifae-logo-branco.png')}}" alt="Logo UNIFAE">
                <h2>ACADEMIA</h2>
            </div>
            <form class="login" method="POST" action="/login">
                @csrf
                <div class="form-group">
                    @if (session('novaSenha'))
                        <span id="novaSenha">{{session('novaSenha')}}</span>
                    @endif
                    <label>Email</label>
                    <input type="email" name="email" value="{{old('email')}}">
                    @error('email')
                      <span class="error">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Senha</label>
                    <input type="password" name="password" value="{{old('password')}}">
                    @error('password')
                      <span class="error">{{$message}}</span>
                    @enderror
                    @if (session('error'))
                        <span class="error">{{session('error')}}</span>
                    @endif
                </div>
                <div class="form-submit">
                    <a href="/reset-password">Esqueceu a senha? <span>Clique aqui</span></a>
                    <button id="btnSubmit" type="submit">Entrar</button>
                </div>
            </form>
        </div>
        <script>
            $('.login').submit(function () { 
            const btn = document.getElementById("btnSubmit")
            btn.disabled = true
        });
        </script>
    </body>
</html>
