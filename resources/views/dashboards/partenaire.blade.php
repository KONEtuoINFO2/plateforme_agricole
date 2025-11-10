@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">👋 Bienvenue {{ Auth::user()->name }}</h2>
    <p>Gérez vos collaborations et suivez les produits validés par l’entreprise.</p>
<p class="mt-3">👉 Pour commander un produit, cliquez sur “📦 Voir les produits validés” et utilisez le bouton “🛒 Commander” dans la ligne du produit.</p>
    <div class="row g-4">
        <div class="col-md-4">
            <a href="{{ route('partenaire.produits') }}" class="btn btn-outline-success w-100">📦 Voir les produits validés</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('partenaire.commandes.create') }}" class="btn btn-outline-primary w-100">🛒 Passer une commande</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('partenaire.commandes.index') }}" class="btn btn-outline-info w-100">📋 Voir mes commandes</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('partenaire.collaborations.create') }}" class="btn btn-outline-warning w-100">🤝 Créer une collaboration</a>
        </div>
    </div>
</div>
@endsection