@extends('layouts.app')
@section('title', 'Liste des employés')

@section('content')
<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">👤 Liste des employés</h4>
            <p class="text-muted mb-0 small">{{ $employees->total() }} employé(s) enregistré(s)</p>
        </div>
        <div class="d-flex gap-2 align-items-center">
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">← Dashboard</a>
            {{ $employees->links() }}
            <a href="{{ route('employees.create') }}" class="btn btn-primary">+ Ajouter un employé</a>
        </div>
    </div>

    {{-- Filtre --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-light fw-semibold text-muted">
            🔍 Filtres de recherche
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('employees.index') }}">
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Recherche par nom</label>
                        <input type="text" name="search" class="form-control"
                               placeholder="Nom de l'employé..."
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Date début</label>
                        <input type="date" name="start_date" class="form-control"
                               value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Date fin</label>
                        <input type="date" name="end_date" class="form-control"
                               value="{{ request('end_date') }}">
                    </div>
                    <div class="col-md-2 d-grid gap-2">
                        <button type="submit" class="btn btn-primary">🔍 Rechercher</button>
                        <a href="{{ route('employees.index') }}" class="btn btn-outline-secondary">↺ Réinitialiser</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Message succès --}}
    @if(session('success'))
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
                            <th class="ps-3">Nom</th>
                            <th>Matricule</th>
                            <th>Poste</th>
                            <th>Département</th>
                            <th>Salaire</th>
                            <th>Date d'embauche</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($employees as $employee)
                        <tr>
                            <td class="ps-3 fw-semibold">{{ $employee->name }}</td>
                            <td><span class="badge bg-secondary">{{ $employee->matricule }}</span></td>
                            <td>{{ $employee->poste }}</td>
                            <td>{{ $employee->department }}</td>
                            <td class="text-success fw-semibold">{{ number_format($employee->salaire_base, 0, ',', ' ') }} Ar</td>
                            <td>{{ $employee->date_embauche }}</td>
                            <td class="text-center text-nowrap">
                                <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-warning">
                                    ✏️ Modifier
                                </a>
                                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Voulez-vous vraiment supprimer cet employé ?')">
                                        🗑️ Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                Aucun employé trouvé.
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
