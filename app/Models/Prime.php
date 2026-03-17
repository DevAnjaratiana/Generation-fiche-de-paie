<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prime extends Model
{
    protected $fillable = [
    'employee_id',
    'libelle',
    'montant',
    'mois',
    'annee'
];

public function employee()
{
    return $this->belongsTo(Employee::class);
}
}
