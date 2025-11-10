@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-success">✅ Produits validés</h2>
        <a href="{{ route('entreprise.dashboard') }}" class="btn btn-outline-success">
            ← Retour au tableau de bord
        </a>
    </div>
    @if($produits->isEmpty())
        <p>Aucun produit validé pour le moment.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Catégorie</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Agriculteur</th>
                    <th>Localité</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produits as $produit)
                    <tr>
                    <td>
                <img src="{{ asset('storage/' . $produit->image) }}" alt="Image du produit"
                     style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;">
            </td>
                        <td>{{ $produit->nom }}</td>
                        <td>{{ $produit->prix }} FCFA</td>
                        <td>{{ $produit->quantite }}</td>
                        <td>{{ $produit->user->name }}</td>
                        <td>{{ $produit->localite }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
