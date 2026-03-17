@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2>Détail de la Retenue</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Employé :</strong> {{ $retenue->employee?->name }}</p>
            <p><strong>Libellé :</strong> {{ $retenue->libelle }}</p>
            <p><strong>Montant :</strong> {{ number_format($retenue->montant, 2) }}</p>
            <p><strong>Mois :</strong> {{ $retenue->mois }}</p>
            <p><strong>Année :</strong> {{ $retenue->annee }}</p>
        </div>
    </div>

    <a href="{{ route('retenues.index') }}" class="btn btn-secondary mt-3">
        Retour
    </a>

</div>
@endsection
