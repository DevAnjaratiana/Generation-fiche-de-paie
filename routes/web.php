<?php
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PrimeController;
use App\Http\Controllers\RetenueController;
use App\Http\Controllers\PaySlipController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Redirection vers login
Route::get('/', function () {
    return redirect()->route('login');
});

// Auth routes (publiques)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes protégées
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/pay_slips/employee-data', [PaySlipController::class, 'getEmployeeData'])->name('pay_slips.employee_data');
    Route::get('/pay_slips/{id}/pdf', [PaySlipController::class, 'pdf'])->name('pay_slips.pdf');
    Route::get('/pay_slips', function() { return redirect()->route('pay_slips.create'); })->name('pay_slips.index');
    Route::resource('pay_slips', PaySlipController::class)->except('index');
    Route::resource('employees', EmployeeController::class);
    Route::resource('primes', PrimeController::class);
    Route::resource('retenues', RetenueController::class);
});
