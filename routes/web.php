<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\AdminLocationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminCategoryController; 
use App\Http\Controllers\AdminGrafikController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| LANDING
|--------------------------------------------------------------------------
*/
Route::get('/', [LandingController::class, 'index'])->name('landing');

/*
|--------------------------------------------------------------------------
| AUTH (LOGIN / REGISTER)
|--------------------------------------------------------------------------
*/
Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');

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
        return redirect('/dashboard'); 
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
    Route::get('/dashboard', [ReportController::class, 'index'])->name('dashboard');
    Route::get('/laporan/create', [ReportController::class, 'create'])->name('laporan.create');
    Route::post('/laporan', [ReportController::class, 'store'])->name('laporan.store');
    Route::get('/laporan', [ReportController::class, 'index'])->name('laporan.index');
    Route::get('/detail', function () { return view('detail'); });
});

/*
|--------------------------------------------------------------------------
| ROUTES UNTUK ADMIN
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->middleware(['auth', 'role.admin'])
    ->group(function () {

        Route::post('/users/delete-all-students', [UserController::class, 'deleteAllStudents'])->name('admin.users.deleteAllStudents');
        Route::get('/dashboard', [AdminReportController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/laporan', [AdminReportController::class, 'index'])->name('admin.laporan.index');
        Route::post('/laporan/{report}/status', [AdminReportController::class, 'updateStatus'])->name('admin.laporan.updateStatus');
        Route::delete('/laporan/{report}', [AdminReportController::class, 'destroy'])->name('admin.laporan.destroy');
        Route::get('/laporan/{report}', [AdminReportController::class, 'show'])->name('admin.laporan.show');
        
        Route::get('/locations', [AdminLocationController::class, 'index'])->name('admin.locations.index');
        Route::post('/locations', [AdminLocationController::class, 'store'])->name('admin.locations.store');
        Route::put('/locations/{location}', [AdminLocationController::class, 'update'])->name('admin.locations.update');
        Route::delete('/locations/{location}', [AdminLocationController::class, 'destroy'])->name('admin.locations.destroy');

        Route::get('/categories', [AdminCategoryController::class, 'index'])->name('admin.categories.index');
        Route::post('/categories', [AdminCategoryController::class, 'store'])->name('admin.categories.store');
        Route::put('/categories/{category}', [AdminCategoryController::class, 'update'])->name('admin.categories.update');
        Route::delete('/categories/{category}', [AdminCategoryController::class, 'destroy'])->name('admin.categories.destroy');

        // Manajemen User Resources & Impor Excel Terintegrasi
        Route::resource('users', UserController::class)->names('admin.users');
        Route::post('/users/import', [UserController::class, 'importExcel'])->name('admin.users.import');
        
        Route::get('/admin/grafik', [AdminGrafikController::class, 'index'])->name('admin.grafik.index');
    });