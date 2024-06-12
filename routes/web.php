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

    // Route::middleware('users')->group(function () {
    //     Route::get('/index', [UserController::class, 'index'])->name('users.index');

    //     Route::get('/show/{id}', [UserController::class, 'show'])->name('users.show');

    //     // Ruta para mostrar el formulario de creación
    //     Route::get('/create', [UserController::class, 'create'])->name('users.create');
        
    //     // Ruta para almacenar un nuevo usuario
    //     Route::post('/store', [UserController::class, 'store'])->name('users.store');
    
    //     // Ruta para mostrar el formulario de edición
    //     Route::get('/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    
    //     // Ruta para actualizar un usuario existente
    //     Route::patch('/update/{id}', [UserController::class, 'update'])->name('users.update');
    
    //     // Ruta para eliminar un usuario
    //     Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    // });

    Route::middleware('users')->resource('users', UserController::class);
    // Route::middleware('users')->resource('users', UserController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']); //solamente para
    // Route::middleware('users')->resource('users', UserController::class)->except(['show']); //excluir metodos
    
});


require __DIR__.'/auth.php';