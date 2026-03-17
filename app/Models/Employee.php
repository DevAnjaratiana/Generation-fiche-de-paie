<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    // Champs autorisés pour l'insertion en masse
    protected $fillable = [
        'name',
        'matricule',
        'poste',
        'department',
        'salaire_base',
        'date_embauche',
    ];

    // Relations
    public function primes()
    {
        return $this->hasMany(Prime::class);
    }

    public function retenues()
    {
        return $this->hasMany(Retenue::class);
    }

    public function paySlips()
    {
        return $this->hasMany(PaySlip::class);
    }

}
