<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AgriculteurController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'agriculteur');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('region', 'like', "%$search%");
            });
        }

        $agriculteurs = $query->latest()->get();

        return view('entreprise.agriculteurs', compact('agriculteurs'));
    }

    public function create()
    {
        $regions = ['Savanes', 'Denguélé', 'Woroba', 'Zanzan'];
        return view('entreprise.ajouterAgriculteur', compact('regions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'contact' => 'required|string|max:20',
            'sexe' => 'required|in:Homme,Femme',
            'region' => 'required|string',
            'localite' => 'required|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        $user = new User();
        $user->name = $validated['nom'];
        $user->email = $validated['email'];
        $user->password = bcrypt('defaultpassword');
        $user->role = 'agriculteur';
        $user->contact = $validated['contact'];
        $user->sexe = $validated['sexe'];
        $user->region = $validated['region'];
        $user->localite = $validated['localite'];

        if ($request->hasFile('photo')) {
            $user->photo = $request->file('photo')->store('users', 'public');
        }

        $user->save();

        return redirect()->route('entreprise.dashboard')->with('success', 'Agriculteur ajouté avec succès.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $regions = ['Savanes', 'Denguélé', 'Woroba', 'Zanzan'];
        return view('entreprise.editAgriculteur', compact('user', 'regions'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'contact' => 'required|string|max:20',
            'sexe' => 'required|in:Homme,Femme',
            'region' => 'required|string',
            'localite' => 'required|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        $user->name = $validated['nom'];
        $user->email = $validated['email'];
        $user->contact = $validated['contact'];
        $user->sexe = $validated['sexe'];
        $user->region = $validated['region'];
        $user->localite = $validated['localite'];

        if ($request->hasFile('photo')) {
            $user->photo = $request->file('photo')->store('users', 'public');
        }

        $user->save();

        return redirect()->route('entreprise.agriculteurs')->with('success', 'Agriculteur modifié avec succès.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('entreprise.agriculteurs')->with('success', 'Agriculteur supprimé.');
    }
}