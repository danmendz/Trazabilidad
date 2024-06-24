<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\MaquinaController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\EstanteController;
use App\Http\Controllers\OperadorController;
use App\Http\Controllers\ReportesEstanteController;
use App\Http\Controllers\ReportesMaquinadoController;
use App\Http\Controllers\LoginController;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
})->name('pagina-principal');;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('can:acceder-usuario')->group(function () {
    Route::get('/usuario', [UserController::class, 'usuario'])->name('usuario.index');
});

Route::middleware('can:acceder-ventas')->group(function () {
    Route::get('/ventas', [UserController::class, 'ventas'])->name('ventas.index');
});

Route::middleware('can:acceder-admin')->group(function () {
    Route::get('/admin', [UserController::class, 'admin'])->name('admin.index');
    Route::middleware('users')->resource('users', UserController::class);
    // Route::middleware('users')->resource('users', UserController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']); //solamente para
    // Route::middleware('users')->resource('users', UserController::class)->except(['show']); //excluir metodos
});

Route::resource('maquinas', MaquinaController::class);
Route::resource('areas', AreaController::class);
Route::resource('estantes', EstanteController::class);
Route::resource('reportes-estantes', ReportesEstanteController::class);
Route::resource('reportes-maquinados', ReportesMaquinadoController::class);

Route::middleware('check.admin.ventas')->group(function () {
    Route::resource('proyectos', ProyectoController::class);
    Route::resource('operadores', OperadorController::class);
});

require __DIR__.'/auth.php';