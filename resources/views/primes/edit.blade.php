@extends('layouts.app')
@section('title', 'Modifier une prime')

@section('content')
<div class="container py-4 d-flex justify-content-center">
    <div class="w-100" style="max-width: 720px;">

        {{-- Header --}}
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class="fw-bold mb-1">✏️ Modifier une prime</h4>
                <p class="text-muted mb-0 small">Modifiez les informations de la prime</p>
            </div>
            <a href="{{ route('primes.index') }}" class="btn btn-outline-secondary">
                ← Retour
            </a>
        </div>

        {{-- Erreurs --}}
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Veuillez corriger les erreurs suivantes :</strong>
                <ul class="mb-0 mt-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Formulaire --}}
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-warning text-dark fw-semibold">
                Modifier les informations de la prime
            </div>
            <div class="card-body p-4">
                <form action="{{ route('primes.update', $prime->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    @php
                    $moisNom = [
                        1 => 'Janvier', 2 => 'Février', 3 => 'Mars', 4 => 'Avril',
                        5 => 'Mai', 6 => 'Juin', 7 => 'Juillet', 8 => 'Août',
                        9 => 'Septembre', 10 => 'Octobre', 11 => 'Novembre', 12 => 'Décembre',
                    ];
                    @endphp

                    <div class="row g-3">

                        {{-- Employé --}}
                        <div class="col-12">
                            <label for="employee_id" class="form-label fw-semibold">Employé <span class="text-danger">*</span></label>
                            <select name="employee_id" id="employee_id"
                                    class="form-select @error('employee_id') is-invalid @enderror" required>
                                <option value="">-- Sélectionnez un employé --</option>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}"
                                        {{ old('employee_id', $prime->employee_id) == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('employee_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Libellé --}}
                        <div class="col-12">
                            <label for="libelle" class="form-label fw-semibold">Libellé <span class="text-danger">*</span></label>
                            <input type="text" name="libelle" id="libelle"
                                   class="form-control @error('libelle') is-invalid @enderror"
                                   value="{{ old('libelle', $prime->libelle) }}"
                                   placeholder="Ex: Prime de rendement" required>
                            @error('libelle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Montant --}}
                        <div class="col-md-6">
                            <label for="montant" class="form-label fw-semibold">Montant <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" step="0.01" name="montant" id="montant"
                                       class="form-control @error('montant') is-invalid @enderror"
                                       value="{{ old('montant', $prime->montant) }}"
                                       placeholder="0.00" required>
                                <span class="input-group-text">Ar</span>
                                @error('montant')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Mois --}}
                        <div class="col-md-6">
                            <label for="mois" class="form-label fw-semibold">Mois <span class="text-danger">*</span></label>
                            <select name="mois" id="mois"
                                    class="form-select @error('mois') is-invalid @enderror" required>
                                @foreach($moisNom as $num => $nom)
                                    <option value="{{ $num }}"
                                        {{ old('mois', $prime->mois) == $num ? 'selected' : '' }}>
                                        {{ $nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('mois')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Année --}}
                        <div class="col-md-6">
                            <label for="annee" class="form-label fw-semibold">Année <span class="text-danger">*</span></label>
                            <input type="number" name="annee" id="annee"
                                   class="form-control @error('annee') is-invalid @enderror"
                                   value="{{ old('annee', $prime->annee) }}"
                                   min="1900" max="{{ date('Y') }}" required>
                            @error('annee')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    {{-- Boutons --}}
                    <div class="d-flex justify-content-between mt-4">
                        <button type="submit" class="btn btn-warning px-4">
                            💾 Mettre à jour
                        </button>
                        <a href="{{ route('primes.index') }}" class="btn btn-outline-secondary px-4">
                            Annuler
                        </a>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
@endsection
