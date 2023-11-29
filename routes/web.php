<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


use App\Http\Controllers\Auth\LoginController;

// Routes accessibles à tous les utilisateurs
// Routes nécessitant une authentification
Route::middleware(['auth'])->group(function () {
    // Routes pour les produits

    Route::resource('products',ProductController::class);

    Route::get('/', function () {
        return view('welcome');
    })->name('index');
    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('delete');



    Route::get('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



});

// Routes accessibles uniquement aux utilisateurs non authentifiés
    Route::middleware(['guest'])->group(function () {
    // Route pour l'affichage du formulaire de connexion
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

    // Route pour la soumission du formulaire de connexion
    Route::post('/login', [LoginController::class, 'login']);
});
