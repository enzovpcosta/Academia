<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Recuperar senha</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="shortcut icon" href="{{asset('assets/img/unifae-logo-verde.png')}}" type="image/x-icon">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="{{asset('assets/css/login.css')}}">
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="imagem-fae">
                <img width="300px" src="{{asset('assets/img/unifae-logo-branco.png')}}" alt="Logo UNIFAE">
                <h2>ACADEMIA</h2>
            </div>
            <form class="loginReset" method="POST" action="/reset-password">
                @csrf
                <div class="form-group">
                    <label>Informe seu email</label>
                    <input type="email" name="email" value="{{old('email')}}">
                    @if(session('error'))
                      <span class="error">{{session('error')}}</span>
                    @endif
                </div>
                <div class="form-submit-Reset">
                    <button id="btnVoltar">
                        <a href="/login" id="voltar"><i class="bi bi-arrow-left"></i>Voltar</a>
                    </button>
                    <button id="btnSubmitReset" type="submit">Entrar</button>
                </div>
            </form>
        </div>
    <script>
        $('.loginReset').submit(function () { 
            const btn = document.getElementById("btnSubmitReset")
            btn.disabled = true
        });

        $('#btnVoltar').click(function () { 
            const btn = document.getElementById('btnVoltar')
            btn.disabled = true
        });
    </script>
    </body>
</html>

