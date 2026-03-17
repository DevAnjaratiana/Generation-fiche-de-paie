<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

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
        $request->validate([
            'name'          => 'required',
            'matricule'     => 'required|unique:employees',
            'poste'         => 'required',
            'department'    => 'required',
            'salaire_base'  => 'required|numeric',
            'date_embauche' => 'required|date|before_or_equal:today',
        ], [
            'matricule.unique'              => 'Le matricule est une clé unique.',
            'date_embauche.required'        => "La date d'embauche est obligatoire.",
            'date_embauche.before_or_equal' => "La date d'embauche ne peut pas être une date future.",
        ]);

        Employee::create($request->all());
        return redirect()->route('employees.index')->with('success', 'Employé ajouté !');
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name'          => 'required',
            'matricule'     => 'required|unique:employees,matricule,' . $employee->id,
            'poste'         => 'required',
            'department'    => 'required',
            'salaire_base'  => 'required|numeric',
             'date_embauche' => 'required|date|before_or_equal:' . now()->format('Y-m-d'), // ✅ ici
        ], [
            'matricule.unique'              => 'Le matricule est une clé unique.',
            'date_embauche.required'        => "La date d'embauche est obligatoire.",
            'date_embauche.before_or_equal' => "La date d'embauche ne peut pas être une date future.",
        ]);

        $employee->update($request->all());
        return redirect()->route('employees.index')->with('success', 'Employé mis à jour !');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employé supprimé !');
    }
}
