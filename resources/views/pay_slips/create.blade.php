@extends('layouts.app')

@section('title', 'Générer une fiche de paie')

@section('content')

<div class="container py-4 d-flex justify-content-center">
    <div class="w-100" style="max-width: 720px;">

        {{-- Header --}}
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class="fw-bold mb-1">💰 Générer une fiche de paie</h4>
                <p class="text-muted mb-0 small">Sélectionnez un employé pour charger automatiquement les données</p>
            </div>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                ← Dashboard
            </a>
        </div>

        {{-- Formulaire --}}
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-success text-white fw-semibold">
                Informations de la fiche
            </div>
            <div class="card-body p-4">
                <form action="{{ route('pay_slips.store') }}" method="POST">
                    @csrf

                    <div class="row g-3">

                        {{-- Employé --}}
                        <div class="col-12">
                            <label for="employee_id" class="form-label fw-semibold">Employé <span class="text-danger">*</span></label>
                            <select name="employee_id" id="employee_id" class="form-select" required>
                                <option value="">-- Sélectionnez un employé --</option>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Mois --}}
                        <div class="col-md-6">
                            <label for="mois" class="form-label fw-semibold">Mois <span class="text-danger">*</span></label>
                            <select name="mois" id="mois" class="form-select" required>
                                @php
                                $moisNom = [
                                    1 => 'Janvier', 2 => 'Février', 3 => 'Mars', 4 => 'Avril',
                                    5 => 'Mai', 6 => 'Juin', 7 => 'Juillet', 8 => 'Août',
                                    9 => 'Septembre', 10 => 'Octobre', 11 => 'Novembre', 12 => 'Décembre',
                                ];
                                @endphp
                                @foreach($moisNom as $num => $nom)
                                    <option value="{{ $num }}">{{ $nom }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Année --}}
                        <div class="col-md-6">
                            <label for="annee" class="form-label fw-semibold">Année <span class="text-danger">*</span></label>
                            <input type="number" name="annee" id="annee" class="form-control" required>
                        </div>

                    </div>

                    {{-- Récapitulatif (masqué jusqu'au chargement) --}}
                    <div id="recap" class="d-none mt-4">
                        <hr>
                        <h6 class="fw-bold text-muted mb-3">📊 Récapitulatif</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small text-muted">Salaire de base</label>
                                <div class="input-group">
                                    <input type="number" step="0.01" name="salaire_base" id="salaire_base" class="form-control" readonly>
                                    <span class="input-group-text">Ar</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small text-muted">Total primes</label>
                                <div class="input-group">
                                    <input type="number" step="0.01" name="total_primes" id="total_primes" class="form-control text-success" readonly>
                                    <span class="input-group-text">Ar</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small text-muted">Total retenues</label>
                                <div class="input-group">
                                    <input type="number" step="0.01" name="total_retenues" id="total_retenues" class="form-control text-danger" readonly>
                                    <span class="input-group-text">Ar</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small text-muted">Salaire brut</label>
                                <div class="input-group">
                                    <input type="number" step="0.01" name="salaire_brut" id="salaire_brut" class="form-control" readonly>
                                    <span class="input-group-text">Ar</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Salaire net</label>
                                <div class="input-group">
                                    <input type="number" step="0.01" name="salaire_net" id="salaire_net" class="form-control fw-bold fs-5 text-primary" readonly>
                                    <span class="input-group-text fw-bold">Ar</span>
                                </div>
                            </div>
                        </div>
                        <div id="alerte-existante" class="alert alert-warning mt-3 mb-0 d-none">
                            ⚠️ Une fiche de paie existe déjà pour cet employé ce mois-ci.
                        </div>
                    </div>

                    {{-- Boutons --}}
                    <div class="d-flex justify-content-between mt-4">
                        <button type="submit" class="btn btn-success px-4">
                            ⚡ Générer
                        </button>
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary px-4">
                            Annuler
                        </a>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

<script src="{{ asset('js/pay_slips.js') }}"></script>

@endsection


