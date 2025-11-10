<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PartenaireController;
use App\Http\Controllers\AgriculteurController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\CollaborationController;

/*
|--------------------------------------------------------------------------
| 🌍 Route d’accueil (redirige selon le rôle ou affiche la page publique)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    if (Auth::check()) {
        $role = Auth::user()->role;

        return match ($role) {
            'agriculteur' => redirect()->route('agriculteur.dashboard'),
            'partenaire' => redirect()->route('partenaire.dashboard'),
            'entreprise' => redirect()->route('entreprise.dashboard'),
            default => app(DashboardController::class)->accueil(),
        };
    }

    return app(DashboardController::class)->accueil();
})->name('accueil');

/*
|--------------------------------------------------------------------------
| 🧾 Formulaires d'inscription et de connexion
|--------------------------------------------------------------------------
*/
Route::get('/register', [AuthController::class, 'registerForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

/*
|--------------------------------------------------------------------------
| 🔒 Routes protégées (nécessitent une authentification)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // 🔴 Déconnexion
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    /*
    |--------------------------------------------------------------------------
    | 🌾 Tableaux de bord
    |--------------------------------------------------------------------------
    */
    Route::get('/agriculteur/dashboard', [DashboardController::class, 'agriculteur'])->name('agriculteur.dashboard');
    Route::get('/entreprise/dashboard', [DashboardController::class, 'entreprise'])->name('entreprise.dashboard');
    Route::get('/partenaire/dashboard', [DashboardController::class, 'partenaire'])->name('partenaire.dashboard');

    /*
    |--------------------------------------------------------------------------
    | 🌽 Gestion des produits (agriculteur)
    |--------------------------------------------------------------------------
    */
    Route::resource('products', ProductController::class)->except(['show']);
    Route::post('/products/{product}/valider', [ProductController::class, 'valider'])->name('products.valider');
    Route::post('/products/{product}/rejeter', [ProductController::class, 'rejeter'])->name('products.rejeter');
    Route::get('/produits-valides', [ProductController::class, 'produitsValides'])->name('products.valides');
    Route::get('/products/rejetes', [ProductController::class, 'produitsRejetes'])->name('products.rejetes');

    /*
    |--------------------------------------------------------------------------
    | 🏭 Tableau de bord entreprise
    |--------------------------------------------------------------------------
    */
    Route::prefix('entreprise')->name('entreprise.')->group(function () {

        // Produits
        Route::get('/produits/en-attente', [DashboardController::class, 'produitsEnAttente'])->name('produits.en_attente');
        Route::get('/produits/valides', [DashboardController::class, 'produitsValides'])->name('produits.valides');

        // Agriculteurs
        Route::get('/ajouter-agriculteur', [AgriculteurController::class, 'create'])->name('ajouterAgriculteur');
        Route::post('/ajouter-agriculteur', [AgriculteurController::class, 'store'])->name('storeAgriculteur');
        Route::get('/agriculteurs', [AgriculteurController::class, 'index'])->name('agriculteurs');
        Route::get('/agriculteur/{id}/edit', [AgriculteurController::class, 'edit'])->name('agriculteur.edit');
        Route::put('/agriculteur/{id}', [AgriculteurController::class, 'update'])->name('agriculteur.update');
        Route::delete('/agriculteur/{id}', [AgriculteurController::class, 'destroy'])->name('agriculteur.destroy');

        // Partenaires
        Route::get('/ajouter-partenaire', [PartenaireController::class, 'create'])->name('ajouterPartenaire');
        Route::post('/ajouter-partenaire', [PartenaireController::class, 'store'])->name('storePartenaire');
        Route::get('/partenaires', [PartenaireController::class, 'index'])->name('partenaires');
        Route::get('/partenaire/{id}/edit', [PartenaireController::class, 'edit'])->name('partenaire.edit');
        Route::put('/partenaire/{id}', [PartenaireController::class, 'update'])->name('partenaire.update');
        Route::delete('/partenaire/{id}', [PartenaireController::class, 'destroy'])->name('partenaire.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | 🤝 Tableau de bord partenaire
    |--------------------------------------------------------------------------
    */
    Route::prefix('partenaire')->name('partenaire.')->group(function () {
        Route::get('/dashboard', [PartenaireController::class, 'dashboard'])->name('dashboard');
        Route::get('/produits-valides', [ProductController::class, 'produitsValidesPourPartenaire'])->name('produits');

        // Commandes
        Route::get('/commandes/create', [CommandeController::class, 'create'])->name('commandes.create');
        Route::get('/mes-commandes', [CommandeController::class, 'index'])->name('commandes.index');
        Route::post('/commandes', [CommandeController::class, 'store'])->name('commandes.store');
        Route::put('/commandes/{id}/valider', [CommandeController::class, 'valider'])->name('commandes.valider');
        Route::get('/commandes/{id}/edit', [CommandeController::class, 'edit'])->name('commandes.edit');
        Route::put('/commandes/{id}', [CommandeController::class, 'update'])->name('commandes.update');
        Route::delete('/commandes/{id}/annuler', [CommandeController::class, 'annuler'])->name('commandes.annuler');

        // Collaborations
        Route::get('/collaborations/create', [CollaborationController::class, 'create'])->name('collaborations.create');
        Route::post('/collaborations', [CollaborationController::class, 'store'])->name('collaborations.store');

        // Export
        Route::get('/export/{format}', [PartenaireController::class, 'export'])->name('export');
    });
});