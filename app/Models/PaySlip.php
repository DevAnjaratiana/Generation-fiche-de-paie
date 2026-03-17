<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaySlip extends Model
{
    use HasFactory;

    public function employee() {
    return $this->belongsTo(Employee::class);
}

    // Ajoute ici tous les champs que tu veux remplir via create() ou fill()
    protected $fillable = [
        'employee_id',
        'mois',
        'annee',
        'salaire_base',
        'total_primes',
        'total_retenues',
        'salaire_brut',
        'salaire_net',
    ];
}


