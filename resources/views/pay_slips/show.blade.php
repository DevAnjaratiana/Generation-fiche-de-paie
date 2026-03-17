@extends('layouts.app')
@section('content')
    <div class="container py-4 d-flex justify-content-center">
        <div class="w-100" style="max-width: 720px;">

            {{-- Header --}}
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="fw-bold mb-1">💰 Fiche de paie</h4>
                    <p class="text-muted mb-0 small">{{ optional($paySlip->employee)->name ?? 'Employé supprimé' }}</p>
                </div>
            </div>

            {{-- Tableau --}}
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-success text-white fw-semibold">
                    Détails de la fiche de paie
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered mb-0">
                        <tr>
                            <th class="bg-light w-50">Mois</th>
                            <td>
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
                                {{ $moisNom[$paySlip->mois] }}
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light">Année</th>
                            <td>{{ $paySlip->annee }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Salaire de base</th>
                            <td>{{ number_format($paySlip->salaire_base, 2) }} Ar</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Total Primes</th>
                            <td class="text-success fw-semibold">{{ number_format($paySlip->total_primes, 2) }} Ar</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Total Retenues</th>
                            <td class="text-danger fw-semibold">{{ number_format($paySlip->total_retenues, 2) }} Ar</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Salaire Brut</th>
                            <td>{{ number_format($paySlip->salaire_brut, 2) }} Ar</td>
                        </tr>
                        <tr class="table-success">
                            <th>Salaire Net</th>
                            <td class="fw-bold fs-5">{{ number_format($paySlip->salaire_net, 2) }} Ar</td>
                        </tr>
                    </table>
                </div>
            </div>

            {{-- Boutons --}}
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('pay_slips.pdf', $paySlip->id) }}" class="btn btn-primary px-4" target="_blank">
                    🖨️ Imprimer PDF
                </a>
                <a href="{{ route('pay_slips.create') }}" class="btn btn-outline-secondary px-4">
                    Retour
                </a>
            </div>

        </div>
    </div>
@endsection
