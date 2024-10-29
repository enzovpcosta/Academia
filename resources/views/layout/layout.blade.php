<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    @yield('title')
  </title>
  <!--     Fonts and icons     -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" de></script>
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
  <link rel="shortcut icon" href="{{asset('assets/img/unifae-logo-verde.png')}}" type="image/x-icon">
    <script src="{{asset('assets/js/core/popper.min.js')}}" ></script>
    {{-- <script src="{{asset('assets/js/core/bootstrap.min.js')}}" ></script> --}}
    {{-- <script src="{{asset('assets/js/argon-dashboard.min.js?v=2.0.4')}}"></script> --}}
  <script src="{{asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/chartjs.min.js')}}"></script>
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
</head>

<body class="g-sidenav-show   bg-gray-100">
  <div id="img-header" class="min-height-300 position-absolute w-100"></div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4" id="aside">
    <div class="sidenav-header d-flex align-items-center justify-content-center">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="/">
        <img src="{{asset('assets/img/unifae-logo-verde.png')}}" class="navbar-brand-img h-100" alt="main_logo">
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav " id="sidenav-main">
        @canany(['admin', 'professor'])
        <li class="nav-item">
          <a class="nav-link" href="/">
            <div class="icon icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="bi bi-house-fill text-secondary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Menu Principal</span>
          </a>
        </li>
        <li class="nav-item my-1 disabled">
          <a href="#dropdownA" class="nav-link" data-bs-toggle="collapse" aria-current="page">
            <div class="icon icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="bi bi-person-fill text-dark text-sm opacity-10"></i>
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
        <li class="nav-item my-1 disabled">
          <a href="#dropdownAdmin" class="nav-link" data-bs-toggle="collapse" aria-current="page">
            <div class="icon icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="bi bi-person-fill-gear text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Administradores</span>
          </a>
          <ul class="nav collapse ms-5 flex-column" id="dropdownAdmin" data-bs-parent="#sidenav-main">
            <li class="nav-item">
              <a class="nav-link text-xs" href="/administradores">Ver administradores</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-xs" href="/administradores/cadastrar">Cadastrar administrador</a>
            </li>
          </ul>
        </li>
        @endcan
        <li class="nav-item my-1 disabled">
          <a href="#dropdownT" class="nav-link" data-bs-toggle="collapse" aria-current="page">
            <div class="icon icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="bi bi-lightning-charge-fill text-warning text-sm opacity-10"></i>
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
            @can('professor')
              <a class="nav-link text-xs" href="/professor/treinos/{{auth()->user()->id}}">Meus treinos</a>
            @endcan
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
        @can('professor')
        <li class="nav-item">
          <a class="nav-link" href="/professores/perfil/{{auth()->user()->id}}">
            <div class="icon icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="bi bi-person-fill text-sm text-dark opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Meu Perfil</span>
          </a>
        </li>   
        @endcan
        @endcanany
        @can('aluno')
        <li class="nav-item">
          <a class="nav-link" href="/">
            <div class="icon icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="bi bi-house-fill text-secondary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Menu Principal</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/alunos/treinos/{{auth()->user()->id}}">
            <div class="icon icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="bi bi-lightning-charge-fill text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Meus Treinos</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/alunos/historico/{{auth()->user()->id}}">
            <div class="icon icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="bi bi-calendar4 text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Histórico de Treinos</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/alunos/perfil/{{auth()->user()->id}}">
            <div class="icon icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="bi bi-person-fill text-sm text-dark opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Meu Perfil</span>
          </a>
        </li>
        @endcan
      </ul>
    </div>
    <div class="sidenav-footer mx-3">
      <form action="/logout" method="POST">
        @csrf
        <button type="submit" class="btn btn-outline-danger shadow-danger btn-sm w-100 m-0"><i class="bi bi-box-arrow-left pe-2"></i>Sair</button>
      </form>
    </div>
  </aside>
  <!-- Navbar -->
  <main class="main-content position-relative border-radius-lg ">
  <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-0">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Página</a></li>
          <li class="breadcrumb-item text-sm text-white active" aria-current="page">@yield('title')</li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">@yield('title')</h6>
      </nav>
      <ul class="navbar-nav justify-content-end gap-3">
        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
          <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
            <div class="sidenav-toggler-inner" id="navBarIcon">
              <i class="sidenav-toggler-line bg-white"></i>
              <i class="sidenav-toggler-line bg-white"></i>
              <i class="sidenav-toggler-line bg-white"></i>
            </div>
          </a>
        </li>
      </ul>
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

    let x = 0

    $('#navBarIcon').click(function (e) { 
      e.preventDefault();

      if(x==0){
        $('.sidenav').css('transform', 'translateX(0)');
        $('main, #img-header').css('filter', 'brightness(70%)');
        x=1
      } else {
        $('.sidenav').css('transform', 'translateX(-17.125rem)');
        $('main, #img-header').css('filter', 'brightness(100%)');
        x=0
      }
      
    });

    $('#iconSidenav').click(function (e) { 
      e.preventDefault();
      $('.sidenav').css('transform', 'translateX(-17.125rem)');
        $('main, #img-header').css('filter', 'brightness(100%)');
        x=0
    });

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

    $('#iconNavbarSidenav').click(function (e) { 
      e.preventDefault();
      const aside = document.getElementById('aside')
      aside.style.right = '3000px'
    });
  </script>
  </body>
  </html>