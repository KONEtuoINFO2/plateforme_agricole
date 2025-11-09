<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /** 🟢 Affiche le formulaire d'inscription */
    public function registerForm()
    {
        return view('auth.register');
    }

    /** 🟢 Enregistre un nouvel utilisateur */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'role' => 'required|in:agriculteur,entreprise,partenaire',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return $this->redirectByRole($user);
    }

    /** 🟡 Affiche le formulaire de connexion */
    public function loginForm()
    {
        return view('auth.login');
    }

    /** 🟡 Vérifie les identifiants et connecte l’utilisateur */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return $this->redirectByRole(Auth::user());
        }

        return back()->withErrors([
            'email' => 'Identifiants incorrects.',
        ])->onlyInput('email');
    }

    /** 🔴 Déconnexion */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('accueil')->with('success', 'Déconnexion réussie.');
    }

    /** 🔁 Redirection selon le rôle */
    private function redirectByRole($user)
    {
        return match ($user->role) {
            'agriculteur' => redirect()->route('agriculteur.dashboard')->with('success', 'Bienvenue, agriculteur 🌱 !'),
            'entreprise' => redirect()->route('entreprise.dashboard')->with('success', 'Bienvenue, entreprise 🏭 !'),
            'partenaire' => redirect()->route('partenaire.dashboard')->with('success', 'Bienvenue, partenaire 🤝 !'),
            default => redirect()->route('accueil')->with('success', 'Connexion réussie.'),
        };
    }
}