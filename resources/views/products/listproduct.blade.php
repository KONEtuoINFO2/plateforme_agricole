@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4 fw-bold text-success">🌾 Liste de vos produits</h2>

    <!-- ✅ Message de succès -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    <!-- ✅ Boutons de navigation -->
    <div class="d-flex justify-content-between mb-4">
        <a href="{{ route('agriculteur.dashboard') }}" class="btn btn-primary px-4">🏠 Tableau de bord</a>
        <a href="{{ route('products.create') }}" class="btn btn-success px-4">➕ Ajouter un produit</a>
    </div>

    <!-- ✅ Barre de recherche -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>🧺 Liste de mes produits</h3>

        <form action="{{ route('products.index') }}" method="GET" class="d-flex" style="gap:10px;">
            <input 
                type="text" 
                name="search" 
                class="form-control" 
                placeholder="Rechercher un produit (nom ou localité)..." 
                value="{{ request('search') }}"
            >

            <button type="submit" class="btn btn-primary">🔍 Rechercher</button>

            @if(request('search'))
                <a href="{{ route('products.index') }}" class="btn btn-secondary">♻️ Réinitialiser</a>
            @endif
        </form>
    </div>

    <!-- ✅ Liste des produits -->
    @if($products->count() > 0)
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-lg border-0 rounded-4 h-100">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" 
                                 class="card-img-top rounded-top-4" 
                                 alt="Image du produit" 
                                 style="height: 200px; object-fit: cover;">
                        @else
                            <img src="https://via.placeholder.com/400x200?text=Pas+d'image" 
                                 class="card-img-top rounded-top-4" 
                                 alt="Aucune image">
                        @endif

                        <div class="card-body">
                            <ul class="list-unstyled mb-3">
                                <li><strong>Nom :</strong> {{ $product->nom }}</li>
                                <li><strong>Description :</strong> {{ $product->description ?? 'Aucune description fournie.' }}</li>
                                <li><strong>Prix :</strong> {{ number_format($product->prix, 0, ',', ' ') }} FCFA</li>
                                <li><strong>Quantité :</strong> {{ $product->quantite }}</li>
                                <li><strong>Agriculteur :</strong> {{ $product->user->name ?? 'Non précisé' }}</li>
                                <li><strong>Localité :</strong> {{ $product->localite ?? 'Non précisée' }}</li>
                            </ul>
                        </div>

                        <div class="card-footer bg-white border-0 d-flex justify-content-between">
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">✏️ Modifier</a>

                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce produit ?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">🗑 Supprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- ✅ Pagination centrée -->
        <div class="mt-4 d-flex justify-content-center">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>

    @else
        <div class="text-center text-muted py-5">
            <h5>Aucun produit ajouté pour le moment.</h5>
            <a href="{{ route('products.create') }}" class="btn btn-success mt-3">➕ Ajouter un produit</a>
        </div>
    @endif
</div>
<style>
    /* ✅ Pagination stylisée */
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
        gap: 5px;
    }

    .pagination .page-item .page-link {
        color: #198754; /* Vert Bootstrap */
        border-radius: 10px;
        border: 1px solid #198754;
        transition: all 0.2s ease-in-out;
    }

    .pagination .page-item.active .page-link {
        background-color: #198754;
        color: white;
        border-color: #198754;
    }

    .pagination .page-item .page-link:hover {
        background-color: #157347;
        color: white;
        border-color: #157347;
    }

    .pagination .page-item.disabled .page-link {
        color: #ccc;
        border-color: #ccc;
        background-color: #f8f9fa;
    }
</style>
<script>
function toggleComment(id) {
    const form = document.getElementById('reject-form-' + id);
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}
</script>
@endsection

