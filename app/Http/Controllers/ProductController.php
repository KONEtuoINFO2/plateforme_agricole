<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // ✅ Liste des produits de l'agriculteur connecté
    public function index(Request $request)
    {
        $query = Product::where('user_id', Auth::id());

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                  ->orWhere('localite', 'like', "%{$search}%");
            });
        }

        $products = $query->orderBy('created_at', 'desc')->paginate(6);

        return view('products.listproduct', compact('products'));
    }

    // ✅ Formulaire de création
    public function create()
    {
        return view('products.ajoutproduct');
    }

    // ✅ Enregistrement
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'quantite' => 'required|string|max:50',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'localite' => 'nullable|string',
            'autre_localite' => 'nullable|string',
        ]);

        $localite = $request->localite ?: $request->autre_localite;
        $path = $request->hasFile('image') ? $request->file('image')->store('produits', 'public') : null;

        Product::create([
            'nom' => $request->nom,
            'description' => $request->description,
            'prix' => $request->prix,
            'quantite' => $request->quantite,
            'localite' => $localite,
            'image' => $path,
            'user_id' => Auth::id(),
            'status' => 'en_attente',
        ]);

        return redirect()->route('products.index')->with('success', '✅ Produit ajouté avec succès !');
    }

    // ✅ Formulaire d’édition
    public function edit(Product $product)
    {
        if ($product->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé');
        }

        return view('products.edit', compact('product'));
    }

    // ✅ Mise à jour
    public function update(Request $request, Product $product)
    {
        if ($product->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé');
        }

        $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'quantite' => 'required|string|max:50',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'localite' => 'nullable|string',
            'autre_localite' => 'nullable|string',
        ]);

        $localite = $request->localite ?: $request->autre_localite;

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $product->image = $request->file('image')->store('produits', 'public');
        }

        $product->update([
            'nom' => $request->nom,
            'description' => $request->description,
            'prix' => $request->prix,
            'quantite' => $request->quantite,
            'localite' => $localite,
            'image' => $product->image,
        ]);

        return redirect()->route('products.index')->with('success', '✅ Produit mis à jour avec succès !');
    }

    // ✅ Suppression
    public function destroy(Product $product)
    {
        if ($product->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé');
        }

        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', '🗑️ Produit supprimé avec succès !');
    }

    // ✅ Validation par l’entreprise
    public function valider($id)
    {
        $produit = Product::findOrFail($id);
        $produit->status = 'valide';
        $produit->save();

        return redirect()->back()->with('success', '✅ Produit validé avec succès.');
    }

    // ✅ Rejet simple
    public function rejectProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->status = 'rejeté';
        $product->save();

        return back()->with('error', '❌ Produit rejeté.');
    }

    // ✅ Rejet avec commentaire
    public function rejeter(Request $request, $id)
    {
        $produit = Product::findOrFail($id);
        $produit->status = 'rejeté';
        $produit->commentaire_rejet = $request->input('commentaire');
        $produit->save();

        return redirect()->back()->with('error', '❌ Produit rejeté avec succès.');
    }

    // ✅ Produits rejetés pour l’agriculteur connecté
    public function produitsRejetes()
    {
        $produits = auth()->user()->products()->where('status', 'rejeté')->get();
        return view('products.rejetes', compact('produits'));
    }

    // ✅ Produits validés pour le partenaire
    public function produitsValidesPourPartenaire()
    {
        if (Auth::user()->role !== 'partenaire') {
            abort(403, 'Accès réservé aux partenaires.');
        }

        $produits = Product::where('status', 'valide')->latest()->get();
        return view('partenaire.produitsValides', compact('produits'));
    }
}