<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Prime;
use App\Models\Retenue;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
   public function index()
{
    // conmpteur
    $totalEmployees = Employee::count();
    $totalPrimes    = Prime::count();
    $totalRetenues  = Retenue::count();

    return response()->view('dashboard', compact('totalEmployees', 'totalPrimes', 'totalRetenues'))
        ->withHeaders([
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma'        => 'no-cache',
            'Expires'       => '0',
        ]);
}
}
