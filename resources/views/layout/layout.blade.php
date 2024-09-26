<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/logo.png">
  <title>
    @yield('title')
  </title>
  <!--     Fonts and icons     -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{asset('assets/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{asset('assets/css/argon-dashboard.css?v=2.0.4')}}" rel="stylesheet" />
  <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
  <link rel="shortcut icon" href="{{asset('assets/img/logo.png')}}" type="image/x-icon">
    <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
   <!-- Github buttons -->
   <script async defer src="https://buttons.github.io/buttons.js"></script>
   <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
   <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<!-- Or for RTL support -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
</head>

<body class="g-sidenav-show   bg-gray-100">
  <div id="img-header" class="min-height-300 position-absolute w-100"></div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="/">
        <img src="{{asset('assets/img/logo.png')}}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">Costa Titanium</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        @canany(['admin', 'professor'])
        <li class="nav-item">
          <a class="nav-link" href="/">
            <div class="icon icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="bi bi-house text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Menu Principal</span>
          </a>
        </li>
        <li class="nav-item my-1 disabled">
          <a href="#dropdownA" class="nav-link" data-bs-toggle="collapse" aria-current="page">
            <div class="icon icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="bi bi-person text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Alunos</span>
          </a>
          <ul class="nav collapse ms-5 flex-column" id="dropdownA" data-bs-parent="#sidenav-main">
            <li class="nav-item">
              <a class="nav-link text-xs" href="/alunos">Ver alunos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-xs" href="/alunos/cadastrar">Cadastrar aluno</a>
            </li>
          </ul>
        </li>
        @can('admin')
        <li class="nav-item my-1 disabled">
          <a href="#dropdownP" class="nav-link" data-bs-toggle="collapse" aria-current="page">
            <div class="icon icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="bi bi-person-square text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Professores</span>
          </a>
          <ul class="nav collapse ms-5 flex-column" id="dropdownP" data-bs-parent="#sidenav-main">
            <li class="nav-item">
              <a class="nav-link text-xs" href="/professores">Ver professores</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-xs" href="/professores/cadastrar">Cadastrar professor</a>
            </li>
          </ul>
        </li>
        @endcan
        <li class="nav-item my-1 disabled">
          <a href="#dropdownT" class="nav-link" data-bs-toggle="collapse" aria-current="page">
            <div class="icon icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="bi bi-lightning-charge text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Treinos</span>
          </a>
          <ul class="nav collapse ms-5 flex-column" id="dropdownT" data-bs-parent="#sidenav-main">
            <li class="nav-item">
              <a class="nav-link text-xs" href="/treinos">Ver treinos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-xs" href="/treinos/cadastrar">Criar treino</a>
            </li>
          </ul>
        </li>
        <li class="nav-item my-1 disabled">
          <a href="#dropdownE" class="nav-link" data-bs-toggle="collapse" aria-current="page">
            <div class="icon icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <ion-icon class="text-info" name="barbell-outline"></ion-icon>
            </div>
            <span class="nav-link-text ms-1">Exercícios</span>
          </a>
          <ul class="nav collapse ms-5 flex-column" id="dropdownE" data-bs-parent="#sidenav-main">
            <li class="nav-item">
              <a class="nav-link text-xs" href="/exercicios">Ver exercícios</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-xs" href="/exercicios/cadastrar">Criar exercício</a>
            </li>
          </ul>
        </li>
        @endcanany
        @can('aluno')
        <li class="nav-item">
          <a class="nav-link" href="/">
            <div class="icon icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="bi bi-house text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Menu Principal</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/alunos/treinos/{{auth()->user()->id}}">
            <div class="icon icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="bi bi-lightning-charge text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Meus Treinos</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/alunos/perfil/{{auth()->user()->id}}">
            <div class="icon icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="bi bi-person text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Meu Perfil</span>
          </a>
        </li>
        @endcan
      </ul>
    </div>
  </aside>
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Página</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">@yield('title')</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">@yield('title')</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
              <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="btn bg-gradient-danger shadow-danger btn-sm w-100 m-0">Sair</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </nav>
    @if (session('msg'))
        <script>
          Swal.fire({
            text: "{{session('msg')}}",
            icon: "success"
          });
        </script>
    @endif
    @yield('content')
    </div>
  </main>

  <script>
    $('.telefone').mask('(00) 00000-0000');
    $('.cpf').mask('000.000.000-00', {reverse: true});
    $('.time').mask('00:00');

    var a

    function senha(element){
      if(a == 1){
      document.getElementById('senha').type = 'password'
      element.className = 'bi bi-eye-fill'
      a = 0
      } else {
        document.getElementById('senha').type = 'text'
      element.className = 'bi bi-eye-slash-fill'

        a = 1
      }
    }
  </script>
  </body>
  </html>