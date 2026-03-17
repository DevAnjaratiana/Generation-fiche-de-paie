<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaySlip;
use App\Models\Employee;
use App\Models\Prime;
use App\Models\Retenue;
use Barryvdh\DomPDF\Facade\Pdf;

class PaySlipController extends Controller
{
    // Affiche le formulaire de création
    public function create()
    {
        $employees = Employee::all();
        return view('pay_slips.create', compact('employees'));
    }

    // Enregistre une nouvelle fiche de paie
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'mois' => 'required|integer|min:1|max:12',
            'annee' => 'required|integer',
        ]);

        $employee = Employee::findOrFail($request->employee_id);

        $totalPrimes = Prime::where('employee_id', $employee->id)
            ->where('mois', $request->mois)
            ->where('annee', $request->annee)
            ->sum('montant');

        $totalRetenues = Retenue::where('employee_id', $employee->id)
            ->where('mois', $request->mois)
            ->where('annee', $request->annee)
            ->sum('montant');

        $salaireBrut = $employee->salaire_base + $totalPrimes;
        $salaireNet = $salaireBrut - $totalRetenues;

        $paySlip = PaySlip::create([
            'employee_id' => $employee->id,
            'mois' => $request->mois,
            'annee' => $request->annee,
            'salaire_base' => $employee->salaire_base,
            'total_primes' => $totalPrimes,
            'total_retenues' => $totalRetenues,
            'salaire_brut' => $salaireBrut,
            'salaire_net' => $salaireNet,
        ]);

        return redirect()->route('pay_slips.show', $paySlip->id);
    }

    // Affiche une fiche de paie
    public function show($id)
    {
        $paySlip = PaySlip::findOrFail($id);
        return view('pay_slips.show', compact('paySlip'));
    }

    public function pdf($id) {
        $paySlip = PaySlip::with('employee')->findOrFail($id);
        $pdf = Pdf::loadView('pay_slips.pdf', compact('paySlip'));
        return $pdf->download('Fiche_Paie_' . $paySlip->id . '.pdf');
    }
    public function getEmployeeData(Request $request)
{
    $employee = Employee::findOrFail($request->employee_id);

    // Récupère le dernier mois/année depuis primes ou retenues
    $dernierePrime = Prime::where('employee_id', $employee->id)
                    ->orderBy('annee', 'desc')
                    ->orderBy('mois', 'desc')
                    ->first();

    $derniereRetenue = Retenue::where('employee_id', $employee->id)
                    ->orderBy('annee', 'desc')
                    ->orderBy('mois', 'desc')
                    ->first();

    // Prend le mois/année de la prime ou retenue la plus récente
    $mois  = $dernierePrime->mois  ?? $derniereRetenue->mois  ?? now()->month;
    $annee = $dernierePrime->annee ?? $derniereRetenue->annee ?? now()->year;

    $totalPrimes = Prime::where('employee_id', $employee->id)
                    ->where('mois', $mois)->where('annee', $annee)
                    ->sum('montant');

    $totalRetenues = Retenue::where('employee_id', $employee->id)
                    ->where('mois', $mois)->where('annee', $annee)
                    ->sum('montant');

    $salaireBrut = $employee->salaire_base + $totalPrimes;
    $salaireNet  = $salaireBrut - $totalRetenues;

    $alreadyExists = PaySlip::where('employee_id', $employee->id)
                    ->where('mois', $mois)->where('annee', $annee)
                    ->exists();

    return response()->json([
        'mois'           => $mois,
        'annee'          => $annee,
        'salaire_base'   => $employee->salaire_base,
        'total_primes'   => $totalPrimes,
        'total_retenues' => $totalRetenues,
        'salaire_brut'   => $salaireBrut,
        'salaire_net'    => $salaireNet,
        'already_exists' => $alreadyExists,
    ]);
}

public function index()
{
    return redirect()->route('pay_slips.create');
}

}
