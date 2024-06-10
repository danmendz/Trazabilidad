<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Models\User;


Route::get('/', function () {
    return view('welcome');
})->name('paginaPrincipal');;

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

Route::middleware('can:acceder-trabajador')->group(function () {
    Route::get('/trabajador', [UserController::class, 'trabajador'])->name('trabajador.index');
});

Route::middleware('can:acceder-admin')->group(function () {
    Route::get('/admin', [UserController::class, 'admin'])->name('admin.index');
});

require __DIR__.'/auth.php';
