<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Retenue extends Model
{
    public function employee() {
        return $this->belongsTo(Employee::class);
    }
    
    protected $fillable = [
    'employee_id',
    'libelle',
    'montant',
    'mois',
    'annee',
];


}
