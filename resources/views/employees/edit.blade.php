@extends('layouts.app')
@section('title', 'Modifier un employé')

@section('content')
<div class="container py-4 d-flex justify-content-center">
    <div class="w-100" style="max-width: 720px;">

        {{-- Header --}}
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class="fw-bold mb-1">✏️ Modifier un employé</h4>
                <p class="text-muted mb-0 small">Modifiez les informations de {{ $employee->name }}</p>
            </div>
            <a href="{{ route('employees.index') }}" class="btn btn-outline-secondary">
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
                Modifier les informations de l'employé
            </div>
            <div class="card-body p-4">
                <form action="{{ route('employees.update', $employee->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">

                        {{-- Nom --}}
                        <div class="col-md-6">
                            <label for="name" class="form-label fw-semibold">Nom <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $employee->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Matricule --}}
                        <div class="col-md-6">
                            <label for="matricule" class="form-label fw-semibold">Matricule <span class="text-danger">*</span></label>
                            <input type="text" name="matricule" id="matricule"
                                   class="form-control @error('matricule') is-invalid @enderror"
                                   value="{{ old('matricule', $employee->matricule) }}" required>
                            @error('matricule')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Poste --}}
                        <div class="col-md-6">
                            <label for="poste" class="form-label fw-semibold">Poste <span class="text-danger">*</span></label>
                            <input type="text" name="poste" id="poste"
                                   class="form-control @error('poste') is-invalid @enderror"
                                   value="{{ old('poste', $employee->poste) }}" required>
                            @error('poste')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Département --}}
                        <div class="col-md-6">
                            <label for="department" class="form-label fw-semibold">Département <span class="text-danger">*</span></label>
                            <input type="text" name="department" id="department"
                                   class="form-control @error('department') is-invalid @enderror"
                                   value="{{ old('department', $employee->department) }}" required>
                            @error('department')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Salaire --}}
                        <div class="col-md-6">
                            <label for="salaire_base" class="form-label fw-semibold">Salaire de base <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" step="0.01" name="salaire_base" id="salaire_base"
                                       class="form-control @error('salaire_base') is-invalid @enderror"
                                       value="{{ old('salaire_base', $employee->salaire_base) }}" required>
                                <span class="input-group-text">Ar</span>
                                @error('salaire_base')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Date d'embauche --}}
                        <div class="col-md-6">
                            <label for="date_embauche" class="form-label fw-semibold">Date d'embauche <span class="text-danger">*</span></label>
                            <input type="date" name="date_embauche" id="date_embauche"
                                   class="form-control @error('date_embauche') is-invalid @enderror"
                                   value="{{ old('date_embauche', $employee->date_embauche) }}"
                                   max="{{ now()->format('Y-m-d') }}" required>
                            @error('date_embauche')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    {{-- Boutons --}}
                    <div class="d-flex justify-content-between mt-4">
                        <button type="submit" class="btn btn-warning px-4">
                            💾 Mettre à jour
                        </button>
                        <a href="{{ route('employees.index') }}" class="btn btn-outline-secondary px-4">
                            Annuler
                        </a>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
@endsection
