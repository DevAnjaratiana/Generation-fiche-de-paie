<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Gestion Paie')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<script>
    // Empêche le bouton retour dès le chargement
    history.pushState(null, null, location.href);

    // Empêche aussi après chaque navigation
    window.onpageshow = function(event) {
        if (event.persisted) {
            history.pushState(null, null, location.href);
        }
    };

    window.addEventListener('popstate', function () {
        history.pushState(null, null, location.href);
    });
</script>
<body class="bg-light">

<div class="d-flex">

    {{-- SIDEBAR --}}
    <div class="d-flex flex-column flex-shrink-0 bg-dark text-white vh-100 position-fixed" style="width: 220px;">

        {{-- Brand --}}
        <a href="{{ route('dashboard') }}"
           class="d-flex align-items-center text-white text-decoration-none px-3 py-3 border-bottom border-secondary">
            <span class="fw-bold fs-6">💼 Gestion Paie</span>
        </a>

        {{-- Navigation --}}
        <ul class="nav nav-pills flex-column mb-auto p-2 mt-1">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}"
                   class="nav-link text-white {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    📊 Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('employees.index') }}"
                   class="nav-link text-white {{ request()->routeIs('employees.*') ? 'active' : '' }}">
                    👤 Employés
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('primes.index') }}"
                   class="nav-link text-white {{ request()->routeIs('primes.*') ? 'active' : '' }}">
                    🏆 Primes
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('retenues.index') }}"
                   class="nav-link text-white {{ request()->routeIs('retenues.*') ? 'active' : '' }}">
                    📉 Retenues
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('pay_slips.index') }}"
                   class="nav-link text-white {{ request()->routeIs('pay_slips.*') ? 'active' : '' }}">
                    💰 Fiches de paie
                </a>
            </li>
            {{-- Logout --}}
    <div class="p-2 mt-auto border-top border-secondary">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-light w-100 btn-sm">
                🚪 Se déconnecter
            </button>
        </form>
    </div>
        </ul>
    </div>

    {{-- CONTENU PRINCIPAL --}}
    <div class="flex-grow-1 p-4" style="margin-left: 220px;">
        @yield('content')
    </div>



</div>
{{--
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
@stack('scripts')
</body>
</html>
