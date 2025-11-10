@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">🛒 Passer une commande</h3>

    <div class="card mb-4">
        <div class="card-body">
            <h5>{{ $produit->nom }}</h5>
            <p><strong>Description :</strong> {{ $produit->description ?? '-' }}</p>
            <p><strong>Prix :</strong> {{ $produit->prix }} FCFA</p>
            <p><strong>Quantité disponible :</strong> {{ $produit->quantite }}</p>
            <p><strong>Localité :</strong> {{ $produit->localite ?? '-' }}</p>
            @if($produit->image)
                <img src="{{ asset('storage/' . $produit->image) }}" alt="Image du produit" width="120">
            @endif
        </div>
    </div>

    <form method="POST" action="{{ route('partenaire.commandes.store') }}">
        @csrf
        <input type="hidden" name="produit_id" value="{{ $produit->id }}">

        <div class="mb-3">
            <label for="quantite" class="form-label">Quantité souhaitée</label>
            <input type="number" name="quantite" id="quantite" class="form-control" required min="1">
        </div>

        <div class="mb-3">
            <label for="adresse_livraison" class="form-label">Adresse de livraison</label>
            <input type="text" name="adresse_livraison" id="adresse_livraison" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">✅ Valider la commande</button>
        <a href="{{ route('partenaire.produits') }}" class="btn btn-secondary">↩️ Retour aux produits</a>
    </form>
</div>
@endsection