<?php

namespace App\Http\Controllers;

use App\Models\Retenue;
use App\Models\Employee;
use Illuminate\Http\Request;

class RetenueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $retenues = Retenue::with('employee')
            ->orderBy('annee', 'desc')
            ->orderBy('mois', 'desc')
            ->get();

        return view('retenues.index', compact('retenues'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::orderBy('name')->get();
        return view('retenues.create', compact('employees'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'employee_id' => 'required|exists:employees,id',
        'libelle' => 'required',
        'montant' => 'required|numeric',
        'mois' => 'required|integer',
        'annee' => 'required|integer|max:' . date('Y'),
    ]);

    Retenue::create($request->all());

    return redirect()->route('retenues.index')
        ->with('success', 'Retenue ajoutée avec succès');
}


    /**
     * Display the specified resource.
     */
    public function show(Retenue $retenue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Retenue $retenue)
{
    $employees = Employee::orderBy('name')->get();
    return view('retenues.edit', compact('retenue', 'employees'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Retenue $retenue)
{
    $request->validate([
        'employee_id' => 'required|exists:employees,id',
        'libelle' => 'required',
        'montant' => 'required|numeric',
        'mois' => 'required|integer',
        'annee' => 'required|integer|max:' . date('Y'),
    ]);

    $retenue->update($request->all());

    return redirect()->route('retenues.index')
        ->with('success', 'Retenue mise à jour avec succès');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Retenue $retenue)
{
    $retenue->delete();

    return redirect()->route('retenues.index')
        ->with('success', 'Retenue supprimée');
}

}
