@extends('layouts.app')

@section('content')
<div class="container">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-success">📦 Produits validés par l’entreprise</h2>
            <a href="{{ route('partenaire.dashboard') }}" class="btn btn-secondary mt-3">↩️ Retour au tableau de bord</a>

    </div>

    @if($produits->isEmpty())
        <p>Aucun produit validé pour le moment.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                    <th>Localité</th>
                    <th>Producteur</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produits as $produit)
                    <tr>
                        <td>
                            @if($produit->image)
                                <img src="{{ asset('storage/' . $produit->image) }}" alt="Image du produit" width="80">
                            @else
                                <span class="text-muted">Aucune image</span>
                            @endif
                        </td>
                        <td>{{ $produit->nom }}</td>
                        <td>{{ $produit->description ?? '-' }}</td>
                        <td>{{ $produit->quantite }}</td>
                        <td>{{ $produit->prix }} FCFA</td>
                        <td>{{ $produit->localite ?? '-' }}</td>
                        <td>{{ $produit->user->name ?? 'N/A' }}</td>
                        <td>
                            <form method="GET" action="{{ route('partenaire.commandes.create') }}">
                                <input type="hidden" name="produit_id" value="{{ $produit->id }}">
                                <button type="submit" class="btn btn-sm btn-primary">🛒 Commander</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</div>
@endsection