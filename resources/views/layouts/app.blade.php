<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Agenda de Eventos')</title>

    <!-- Bootstrap 5.3.3 CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Estilos da aplicação -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('events.index') }}">Agenda de Eventos</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Alternar navegação">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="{{ route('events.index') }}">Eventos</a></li>

                    @auth
                        <li class="nav-item"><a class="nav-link" href="{{ route('events.create') }}">Criar Evento</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('events.dashboard') }}">Dashboard</a></li>

                        <!-- Dropdown do usuário -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                                <li><a class="dropdown-item" href="{{ route('events.create') }}"><i class="bi bi-plus-circle me-1"></i> Criar Evento</a></li>
                                <li><a class="dropdown-item" href="{{ route('events.dashboard') }}"><i class="bi bi-calendar-check me-1"></i> Meus Eventos</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right me-1"></i> Sair
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth

                    @guest
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Registrar</a></li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

   <main class="container my-5">
        @yield('content')

        <!-- Toast: Mensagem  -->
        @if(session('msg'))
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 1055">
            <div id="toastMsg" class="toast align-items-center text-bg-success border-0 shadow" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('msg') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
        @endif
    </main>

    <footer class="bg-light text-center py-3 mt-4">
        &copy; {{ date('Y') }} Graciano André. Todos os direitos reservados
    </footer>

    <!-- Bootstrap 5.3.3 JS (bundle com Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
     <!-- Toast: Script  -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        var toastEl = document.getElementById('toastMsg');
            if (toastEl) {
                var toast = new bootstrap.Toast(toastEl, { delay: 3000 });
                toast.show();
            }
        });
    </script>
</body>
</html>
