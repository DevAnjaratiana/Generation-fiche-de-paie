@extends('layouts.app')
@section('title', 'Liste des primes')

@section('content')
    <div class="container-fluid py-4">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">🏆 Liste des Primes</h4>
                <p class="text-muted mb-0 small">{{ $primes->count() }} prime(s) enregistrée(s)</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">← Dashboard</a>
                <a href="{{ route('primes.create') }}" class="btn btn-primary">+ Ajouter une prime</a>
            </div>
        </div>

        {{-- Message succès --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Tableau --}}
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th class="ps-3">Employé</th>
                                <th>Libellé</th>
                                <th>Montant</th>
                                <th>Mois</th>
                                <th>Année</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $moisNom = [
                                    1 => 'Janvier',
                                    2 => 'Février',
                                    3 => 'Mars',
                                    4 => 'Avril',
                                    5 => 'Mai',
                                    6 => 'Juin',
                                    7 => 'Juillet',
                                    8 => 'Août',
                                    9 => 'Septembre',
                                    10 => 'Octobre',
                                    11 => 'Novembre',
                                    12 => 'Décembre',
                                ];
                            @endphp
                            @forelse($primes as $prime)
                                @if ($prime->employee)
                                    <tr>
                                        <td class="ps-3 fw-semibold">{{ $prime->employee->name }}</td>
                                        <td>{{ $prime->libelle }}</td>
                                        <td class="text-success fw-semibold">{{ number_format($prime->montant, 2) }} Ar</td>
                                        <td>{{ $moisNom[$prime->mois] }}</td>
                                        <td>{{ $prime->annee }}</td>
                                        <td class="text-center text-nowrap">
                                            <a href="{{ route('primes.edit', $prime->id) }}" class="btn btn-warning btn-sm">
                                                ✏️ Modifier
                                            </a>
                                            <form action="{{ route('primes.destroy', $prime->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Supprimer cette prime ?')">
                                                    🗑️ Supprimer
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        Aucune prime enregistrée.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
