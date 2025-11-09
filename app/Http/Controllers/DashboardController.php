<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    // ✅ Page d'accueil publique
    public function accueil()
    {
        $produits = Product::where('status', 'valide')->latest()->take(6)->get();
        $partenaires = User::where('role', 'partenaire')->take(6)->get();
        $agriculteurs = User::where('role', 'agriculteur')->take(6)->get();

        return view('accueil', compact('produits', 'partenaires', 'agriculteurs'));
    }

    // ✅ Dashboard agriculteur
    public function agriculteur()
    {
        return view('dashboards.agriculteur');
    }

    // ✅ Dashboard entreprise
    public function entreprise()
    {
        $produitsEnAttente = Product::where('status', 'en_attente')->get();

        return view('dashboards.entreprise', compact('produitsEnAttente'));
    }

    // ✅ Dashboard partenaire
    public function partenaire()
    {
        return view('dashboards.partenaire');
    }

    // ✅ Produits en attente (entreprise)
    public function produitsEnAttente()
    {
        $produits = Product::with('user')->where('status', 'en_attente')->get();

        return view('dashboards.produits_en_attente', compact('produits'));
    }

    // ✅ Produits validés (entreprise)
    public function produitsValides()
    {
        $produits = Product::with('user')->where('status', 'valide')->get();

        return view('dashboards.produits_valides', compact('produits'));
    }
}