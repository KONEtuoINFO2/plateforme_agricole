<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collaboration;

class CollaborationController extends Controller
{
    // ✅ Affiche le formulaire de création
    public function create()
    {
        return view('partenaire.collaborationForm');
    }

    // ✅ Enregistre une nouvelle collaboration
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:achat,vente,partage',
        ]);

        Collaboration::create([
            'user_id' => auth()->id(),
            'titre' => $request->titre,
            'description' => $request->description,
            'type' => $request->type,
        ]);

        return redirect()->route('partenaire.dashboard')->with('success', '🤝 Collaboration créée avec succès.');
    }
}