@extends('layouts.app')
@section('title', 'Tableau de bord')

@section('content')

<div class="container-fluid min-vh-100 px-4 py-3 bg-light">

    {{-- HEADER --}}
    <div class="bg-dark text-white rounded-4 p-4 mb-4 shadow-sm">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h2 class="fw-bold mb-1">📊 Tableau de bord</h2>
                <p class="mb-0 text-white-50">
                    Gestion de la paie & ressources humaines
                </p>
            </div>
            <div class="mt-3 mt-md-0">
                <span class="badge bg-primary fs-6 px-3 py-2">
                    {{ now()->translatedFormat('l d F Y') }}
                </span>
            </div>
        </div>
    </div>

    {{-- KPI CARDS --}}
    <div class="row g-4 mb-4">

        {{-- Employés --}}
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow h-100 rounded-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-3 fs-4">
                            👤
                        </div>
                        <span class="badge bg-primary">Actifs</span>
                    </div>
                    <h6 class="text-muted text-uppercase small">Employés</h6>
                    <h2 class="fw-bold text-primary">{{ $totalEmployees }}</h2>
                </div>
                <div class="card-footer bg-transparent border-0">
                    <a href="{{ route('employees.index') }}" class="btn btn-primary w-100 rounded-pill">
                        Voir les employés →
                    </a>
                </div>
            </div>
        </div>

        {{-- Primes --}}
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow h-100 rounded-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="bg-success bg-opacity-10 text-success rounded-circle p-3 fs-4">
                            🏆
                        </div>
                        <span class="badge bg-success">Actives</span>
                    </div>
                    <h6 class="text-muted text-uppercase small">Primes</h6>
                    <h2 class="fw-bold text-success">{{ $totalPrimes }}</h2>
                </div>
                <div class="card-footer bg-transparent border-0">
                    <a href="{{ route('primes.index') }}" class="btn btn-success w-100 rounded-pill">
                        Voir les primes →
                    </a>
                </div>
            </div>
        </div>

        {{-- Retenues --}}
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow h-100 rounded-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="bg-danger bg-opacity-10 text-danger rounded-circle p-3 fs-4">
                            📉
                        </div>
                        <span class="badge bg-danger">Actives</span>
                    </div>
                    <h6 class="text-muted text-uppercase small">Retenues</h6>
                    <h2 class="fw-bold text-danger">{{ $totalRetenues }}</h2>
                </div>
                <div class="card-footer bg-transparent border-0">
                    <a href="{{ route('retenues.index') }}" class="btn btn-danger w-100 rounded-pill">
                        Voir les retenues →
                    </a>
                </div>
            </div>
        </div>

        {{-- Action rapide --}}
        <div class="col-sm-6 col-xl-3">
            <div class="card text-white bg-primary border-0 shadow h-100 rounded-4">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <div class="fs-1 mb-3">💰</div>
                        <h6 class="text-uppercase small text-white-50">Action rapide</h6>
                        <h5 class="fw-bold">Fiches de paie</h5>
                        <p class="small text-white-50">
                            Générez les bulletins du mois en cours.
                        </p>
                    </div>
                    <a href="{{ route('pay_slips.create') }}" class="btn btn-light fw-semibold rounded-pill">
                        ⚡ Générer une fiche
                    </a>
                </div>
            </div>
        </div>

    </div>

    {{-- RÉSUMÉ --}}
    <div class="card border-0 shadow rounded-4">
        <div class="card-body">
            <h6 class="text-muted text-uppercase small fw-semibold mb-4">
                📅 Résumé du mois — {{ now()->translatedFormat('F Y') }}
            </h6>

            <div class="row text-center">

                <div class="col-md-4 border-end">
                    <div class="py-3">
                        <div class="display-6 fw-bold text-primary">
                            {{ $totalEmployees }}
                        </div>
                        <div class="text-muted">Employés</div>
                    </div>
                </div>

                <div class="col-md-4 border-end">
                    <div class="py-3">
                        <div class="display-6 fw-bold text-success">
                            {{ $totalPrimes }}
                        </div>
                        <div class="text-muted">Primes</div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="py-3">
                        <div class="display-6 fw-bold text-danger">
                            {{ $totalRetenues }}
                        </div>
                        <div class="text-muted">Retenues</div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

@endsection
