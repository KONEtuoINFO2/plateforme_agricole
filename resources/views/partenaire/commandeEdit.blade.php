@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4 text-primary">✏️ Modifier la commande</h3>

    {{-- ✅ Message de succès --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- ✅ Affichage des erreurs de validation --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('partenaire.commandes.update', $commande->id) }}">
        @csrf
        @method('PUT')

        <input type="hidden" name="produit_id" value="{{ $commande->produit_id }}">

        <div class="mb-3">
            <label for="quantite" class="form-label">Quantité</label>
            <input type="number" name="quantite" id="quantite" class="form-control" value="{{ old('quantite', $commande->quantite) }}" required>
        </div>

        <div class="mb-3">
            <label for="adresse_livraison" class="form-label">Adresse de livraison</label>
            <input type="text" name="adresse_livraison" id="adresse_livraison" class="form-control" value="{{ old('adresse_livraison', $commande->adresse_livraison) }}" required>
        </div>

        <button type="submit" class="btn btn-success">💾 Mettre à jour</button>
        <a href="{{ route('partenaire.commandes.index') }}" class="btn btn-secondary">↩️ Retour</a>
    </form>
</div>
@endsection