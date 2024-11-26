<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EvaluacionController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\SalarioController;
use Illuminate\Support\Facades\Route;

// Redirigir al login si acceden al root
Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rutas de perfil de usuario
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    // Rutas de recursos (Departamentos, Roles, Empleados, Salarios, Evaluaciones)
    Route::resources([
        'departamentos' => DepartamentoController::class,
        'roles' => RolController::class,
        'empleados' => EmpleadoController::class,
        'salarios' => SalarioController::class,
        'evaluaciones' => EvaluacionController::class,
    ]);
});

// Rutas de autenticación
require __DIR__ . '/auth.php';
