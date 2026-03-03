<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| LANDING
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\LandingController;

Route::get('/', [LandingController::class, 'index'])->name('landing');

/*
|--------------------------------------------------------------------------
| AUTH (LOGIN / REGISTER)
|--------------------------------------------------------------------------
*/

// Tampilkan halaman
Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');

// Proses form
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| REDIRECT SETELAH LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/home', function () {
    $user = auth()->user();

    if (! $user) {
        return redirect('/');
    }

    if ($user->role === 'admin') {
        return redirect('/admin/dashboard');
    } elseif ($user->role === 'guru') {
        return redirect('/dashboard'); // sementara guru ke dashboard biasa
    } else {
        return redirect('/dashboard');
    }
})->middleware('auth');

/*
|--------------------------------------------------------------------------
| ROUTES UNTUK SISWA / GURU
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [ReportController::class, 'index'])
        ->name('dashboard');

    Route::get('/laporan/create', [ReportController::class, 'create'])
        ->name('laporan.create');

    Route::post('/laporan', [ReportController::class, 'store'])
        ->name('laporan.store');

    Route::get('/laporan', [ReportController::class, 'index'])
        ->name('laporan.index');
});

/*
|--------------------------------------------------------------------------
| ROUTES UNTUK ADMIN
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->middleware(['auth', 'role.admin'])
    ->group(function () {

        Route::get('/dashboard', [AdminReportController::class, 'dashboard'])
            ->name('admin.dashboard');

        Route::get('/laporan', [AdminReportController::class, 'index'])
            ->name('admin.laporan.index');

        Route::post('/laporan/{report}/status', [AdminReportController::class, 'updateStatus'])
            ->name('admin.laporan.updateStatus');
        
        Route::delete('/laporan/{report}', [AdminReportController::class, 'destroy'])
            ->name('admin.laporan.destroy');
        
        Route::prefix('admin')
             ->middleware(['auth', 'role.admin'])
                ->group(function () {

        Route::get('/locations', [AdminLocationController::class, 'index'])
         ->name('admin.locations.index');

        Route::post('/locations', [AdminLocationController::class, 'store'])
        ->name('admin.locations.store');

        Route::put('/locations/{location}', [AdminLocationController::class, 'update'])
        ->name('admin.locations.update');

        Route::delete('/locations/{location}', [AdminLocationController::class, 'destroy'])
        ->name('admin.locations.destroy');
    });
});