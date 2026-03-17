<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Fiche de Paie</title>
    <link rel="stylesheet" href="{{ public_path('css/pdf.css') }}">
</head>

<body>
    <h2>Fiche de paie - {{ optional($paySlip->employee)->name ?? 'Employé supprimé' }}</h2>
    <table>
        <tr>
            <th>Mois</th>
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
            <td>{{ $moisNom[$paySlip->mois] }}</td>
        </tr>
        <tr>
            <th>Année</th>
            <td>{{ $paySlip->annee }}</td>
        </tr>
        <tr>
            <th>Salaire de base</th>
            <td>{{ number_format($paySlip->salaire_base, 2) }} Ar</td>
        </tr>
        <tr>
            <th>Total Primes</th>
            <td>{{ number_format($paySlip->total_primes, 2) }} Ar</td>
        </tr>
        <tr>
            <th>Total Retenues</th>
            <td>{{ number_format($paySlip->total_retenues, 2) }} Ar</td>
        </tr>
        <tr>
            <th>Salaire Brut</th>
            <td>{{ number_format($paySlip->salaire_brut, 2) }} Ar</td>
        </tr>
        <tr>
            <th>Salaire Net</th>
            <td>{{ number_format($paySlip->salaire_net, 2) }} Ar</td>
        </tr>
    </table>
</body>

</html>
