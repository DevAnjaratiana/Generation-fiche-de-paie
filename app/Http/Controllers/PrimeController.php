<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prime;
use App\Models\Employee;

class PrimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
           $primes = Prime::with('employee')
                        ->orderByDesc('annee')
                        ->orderByDesc('mois')
                        ->get();

        return view('primes.index', compact('primes'));
    }

    /**
     * Show the form for creating a new resource.
     */
        public function create()
        {
            // Récupère tous les employés, triés par le nom
            $employees = Employee::orderBy('name')->get();

            // Passe la liste à la vue create de Prime
            return view('primes.create', compact('employees'));
        }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'libelle' => 'required|string|max:255',
            'montant' => 'required|numeric|min:0',
            'mois' => 'required|integer|between:1,12',
            'annee' => 'required|integer|max:' . date('Y'),

        ],
        );

        Prime::create($request->all());

        return redirect()->route('primes.index')
                         ->with('success', 'Prime ajoutée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prime $prime)
    {
        $employees = Employee::all();
        return view('primes.edit', compact('prime', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prime $prime)
    {
        $request->validate([
            'libelle' => 'required|string|max:255',
            'montant' => 'required|numeric|min:0',
            'mois' => 'required|integer|between:1,12',
            'annee' => 'required|integer|max:' . date('Y'),
        ],
        );

        $prime->update($request->all());

        return redirect()->route('primes.index')
                         ->with('success', 'Prime modifiée.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prime $prime)
    {
        $prime->delete();

        return redirect()->route('primes.index')
                         ->with('success', 'Prime supprimée.');
    }
}
