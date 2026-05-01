<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\TeamMemberController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('incidents', IncidentController::class);
    Route::post('incidents/{incident}/assign-members', [IncidentController::class, 'assignMembers'])->name('incidents.assign-members');
    Route::resource('team-members', TeamMemberController::class);

    // Reports
    Route::get('/reports', [\App\Http\Controllers\ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/incidents/csv', [\App\Http\Controllers\ReportController::class, 'exportIncidentsCsv'])->name('reports.incidents.csv');
    Route::get('/reports/incidents/pdf', [\App\Http\Controllers\ReportController::class, 'exportIncidentsPdf'])->name('reports.incidents.pdf');
});

require __DIR__.'/auth.php';
