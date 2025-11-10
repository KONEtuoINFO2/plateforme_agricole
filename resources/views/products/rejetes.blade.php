@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="card shadow-lg border-0">
        <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center flex-wrap">
            <h4 class="mb-2 mb-md-0">Produits rejetés 🚫</h4>
            <a href="{{ route('agriculteur.dashboard') }}" class="btn btn-light btn-sm">
                ← Retour au tableau de bord
            </a>
        </div>

        <div class="card-body">
            @if($produits->isEmpty())
                <p class="text-center">Aucun produit rejeté pour le moment.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle text-center">
                        <thead class="table-danger">
                            <tr>
                                <th>Image</th>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Prix</th>
                                <th>Date</th>
                                <th>Commentaire</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produits as $produit)
                                <tr>
                                    <td>
<img src="{{ asset('storage/' . $produit->image) }}" 
     alt="{{ $produit->nom }}" 
     class="img-fluid rounded-circle" 
     style="max-height: 100px; width: 100px; object-fit: cover;">
                                    </td>
                                    <td>{{ $produit->nom }}</td>
                                    <td>{{ $produit->description }}</td>
                                    <td>{{ $produit->prix }} FCFA</td>
                                    <td>{{ $produit->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $produit->commentaire_rejet }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
<script>
function toggleComment(id) {
    const form = document.getElementById('reject-form-' + id);
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}
</script>
@endsection