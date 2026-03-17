@extends('layouts.app')

@section('content')

<h2>Détail de la Prime</h2>

<div>
    <p><strong>Employé :</strong> {{ $prime->employee->nom }}</p>
    <p><strong>Libellé :</strong> {{ $prime->libelle }}</p>
    <p><strong>Montant :</strong> {{ $prime->montant }} FCFA</p>
    <p><strong>Mois :</strong> {{ $prime->mois }}</p>
    <p><strong>Année :</strong> {{ $prime->annee }}</p>
    <p><strong>Créé le :</strong> {{ $prime->created_at }}</p>
    <p><strong>Modifié le :</strong> {{ $prime->updated_at }}</p>
</div>

<a href="{{ route('primes.index') }}">Retour</a>

@endsection
