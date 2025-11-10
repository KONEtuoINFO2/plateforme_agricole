@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-success text-white text-center d-flex align-items-center justify-content-center">
            <h4 class="m-0">Bienvenue sur votre tableau de bord, Agriculteur</h4>
        </div>

        <div class="card-body text-center">
            <h5>Bonjour, <strong>{{ auth()->user()->name }}</strong></h5>
            <p class="mt-3">
                Gérez vos cultures, vos produits et vos ventes en un seul endroit.
            </p>

            <div class="d-flex justify-content-center gap-3 mt-4 flex-wrap">
                <a href="{{ route('products.index') }}" class="btn btn-outline-success px-4 py-2 fw-bold">
                    Voir mes produits
                </a>
                <a href="{{ route('products.rejetes') }}" class="btn btn-outline-danger px-4 py-2 fw-bold">
                    Produits rejetés
                </a>
                <a href="{{ route('products.create') }}" class="btn btn-outline-primary px-4 py-2 fw-bold">
                    Ajouter un produit
                </a>
            </div>
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
