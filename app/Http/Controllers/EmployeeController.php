<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = Employee::query();

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('date_embauche', [$request->start_date, $request->end_date]);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%$search%");
        }

        $employees = $query->latest()->paginate(10);
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'matricule'     => 'required|string|unique:employees,matricule',
            'poste'         => 'required|string|max:255',
            'department'    => 'required|string|max:255',
            'salaire_base'  => [
                'required',
                'numeric',
                'min:' . config('salaire.smig', 250000),
            ],
            'date_embauche' => [
                'required',
                'date',
                'before_or_equal:today',
            ],
        ], [
            'matricule.unique'              => 'Ce matricule est déjà utilisé.',
            'date_embauche.required'        => 'La date d\'embauche est obligatoire.',
            'date_embauche.before_or_equal' => 'La date d\'embauche ne peut pas être une date future.',
            'salaire_base.min'              => 'Le salaire de base ne peut pas être inférieur au SMIG (' . number_format(config('salaire.smig', 250000), 0, ',', ' ') . ' Ar).',
        ]);

        Employee::create($validated);
        return redirect()->route('employees.index')->with('success', 'Employé ajouté avec succès !');
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'matricule'     => 'required|string|unique:employees,matricule,' . $employee->id,
            'poste'         => 'required|string|max:255',
            'department'    => 'required|string|max:255',
            'salaire_base'  => [
                'required',
                'numeric',
                'min:' . config('salaire.smig', 250000),
            ],
            'date_embauche' => [
                'required',
                'date',
                'before_or_equal:today',
            ],
        ], [
            'matricule.unique'              => 'Ce matricule est déjà utilisé.',
            'date_embauche.required'        => 'La date d\'embauche est obligatoire.',
            'date_embauche.before_or_equal' => 'La date d\'embauche ne peut pas être une date future.',
            'salaire_base.min'              => 'Le salaire de base ne peut pas être inférieur au SMIG (' . number_format(config('salaire.smig', 250000), 0, ',', ' ') . ' Ar).',
        ]);

        $employee->update($validated);
        return redirect()->route('employees.index')->with('success', 'Employé mis à jour avec succès !');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employé supprimé avec succès !');
    }
}
