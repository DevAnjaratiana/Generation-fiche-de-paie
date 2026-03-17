@extends('layouts.app')

@section('content')
<h1>Détail de l'employé</h1>

<p><strong>Nom :</strong> {{ $employee->name }}</p>
<p><strong>Matricule :</strong> {{ $employee->matricule }}</p>
<p><strong>Poste :</strong> {{ $employee->poste }}</p>
<p><strong>Département :</strong> {{ $employee->department }}</p>
<p><strong>Salaire de base :</strong> {{ $employee->salaire_base }}</p>
<p><strong>Date d'embauche :</strong> {{ $employee->date_embauche }}</p>

<a href="{{ route('employees.index') }}">Retour à la liste</a>
@endsection
