@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-success">Produits en attente</h2>
        <a href="{{ route('entreprise.dashboard') }}" class="btn btn-outline-success">
            ← Retour au tableau de bord
        </a>
    </div>

    @if ($produits->isEmpty())
        <div class="alert alert-info text-center">
            Aucun produit en attente pour le moment.
        </div>
    @else
        <div class="row">
            @foreach ($produits as $produit)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-success">
                        
                        {{-- 🖼️ Image du produit --}}
                        @if ($produit->image)
                            <img src="{{ asset('storage/' . $produit->image) }}" 
                                 alt="{{ $produit->nom }}" 
                                 class="card-img-top" 
                                 style="height: 200px; object-fit: cover;">
                        @else
                            <img src="{{ asset('images/default-produit.jpg') }}" 
                                 alt="Image par défaut" 
                                 class="card-img-top" 
                                 style="height: 200px; object-fit: cover;">
                        @endif

                        <div class="card-body">
                            <h5 class="card-title text-success">{{ $produit->nom }}</h5>
                            <p class="card-text">
                                <strong>Agriculteur:</strong> {{ $produit->user->name }}<br>
                                <strong>Localité:</strong> {{ $produit->localite }}<br>
                                <strong>Catégorie:</strong> {{ $produit->nom }}<br>
                                <strong>Quantité:</strong> {{ $produit->quantite }} en kg ou en tone<br>
                                <strong>Prix:</strong> {{ number_format($produit->prix, 0, ',', ' ') }} FCFA<br>
                            </p>

                            <form action="{{ route('products.valider', $produit->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success me-2">✅ Valider</button>
                            </form>

                            <!-- Bouton pour rejeter -->
                            <button class="btn btn-danger" type="button" onclick="toggleComment({{ $produit->id }})">
                                ❌ Rejeter
                            </button>

                            <!-- Champ commentaire (caché par défaut) -->
                            <form id="reject-form-{{ $produit->id }}" 
                                  action="{{ route('products.rejeter', $produit->id) }}" 
                                  method="POST" 
                                  class="mt-3" 
                                  style="display: none;">
                                @csrf
                                <div class="mb-2">
                                    <textarea name="commentaire" 
                                              class="form-control" 
                                              rows="2" 
                                              placeholder="Ajouter un commentaire (facultatif)"></textarea>
                                </div>
                                <button type="submit" class="btn btn-outline-danger btn-sm">Confirmer le rejet</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<script>
function toggleComment(id) {
    const form = document.getElementById('reject-form-' + id);
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}
</script>
@endsection
