<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Commande;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{
    // ✅ Formulaire de commande
    public function create(Request $request)
    {
        $produitId = $request->input('produit_id');
        $produit = Product::findOrFail($produitId);

        return view('partenaire.commandeForm', compact('produit'));
    }

    // ✅ Enregistrement de la commande
    public function store(Request $request)
    {
        $request->validate([
            'produit_id' => 'required|exists:products,id',
            'quantite' => 'required|numeric|min:1',
            'adresse_livraison' => 'required|string|max:255',
        ]);

        Commande::create([
            'user_id' => Auth::id(),
            'produit_id' => $request->produit_id,
            'quantite' => $request->quantite,
            'adresse_livraison' => $request->adresse_livraison,
            'status' => 'en_attente',
        ]);

        return redirect()->route('partenaire.dashboard')->with('success', '🛒 Commande envoyée avec succès !');
    }

    // ✅ Liste des commandes du partenaire
    public function index()
    {
        $commandes = Commande::with('produit')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('partenaire.commandes', compact('commandes'));
    }

    // ✅ Valider une commande
    public function valider($id)
    {
        $commande = Commande::findOrFail($id);

        if ($commande->user_id !== auth()->id()) {
            abort(403);
        }

        $commande->status = 'valide';
        $commande->save();

        return back()->with('success', '✅ Commande validée avec succès.');
    }

    // ✅ Modifier une commande
    public function edit($id)
    {
        $commande = Commande::findOrFail($id);

        if ($commande->user_id !== auth()->id()) {
            abort(403);
        }

        return view('partenaire.commandeEdit', compact('commande'));
    }

    // ✅ Mettre à jour une commande
    public function update(Request $request, $id)
    {
        $commande = Commande::findOrFail($id);

        if ($commande->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'quantite' => 'required|numeric|min:1',
            'adresse_livraison' => 'required|string|max:255',
        ]);

        $commande->update([
            'quantite' => $request->quantite,
            'adresse_livraison' => $request->adresse_livraison,
        ]);

        return redirect()->route('partenaire.commandes.index')->with('success', '✏️ Commande mise à jour.');
    }

    // ✅ Annuler une commande
    public function annuler($id)
    {
        $commande = Commande::findOrFail($id);

        if ($commande->user_id !== auth()->id()) {
            abort(403);
        }

        $commande->delete();

        return back()->with('error', '❌ Commande annulée.');
    }
}