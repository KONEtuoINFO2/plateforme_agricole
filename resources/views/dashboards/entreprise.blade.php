@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <!-- En-tête avec logo + titre -->
        <div class="card-header bg-success text-white text-center d-flex align-items-center justify-content-center">
            <h4 class="m-0">🏭 Tableau de bord Entreprise</h4>
        </div>

        <!-- Contenu principal -->
        <div class="card-body text-center">
            <h5>Bonjour, <strong>{{ auth()->user()->name }}</strong> 👋</h5>
            <p class="mt-3">
                Gérez vos partenariats, vos agriculteurs et vos produits ici même.
            </p>

            <div class="d-grid gap-3 mt-4" style="max-width: 700px; margin: auto;">
                <div class="row g-3">
                    <div class="col-md-6">
                        <a href="{{ route('entreprise.produits.en_attente') }}" class="btn btn-outline-warning w-100 py-3 fw-bold">
                            🕓 Produits en attente
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('entreprise.produits.valides') }}" class="btn btn-outline-success w-100 py-3 fw-bold">
                            ✅ Produits validés
                        </a>
                    </div>
                    <div class="col-md-6">
                           <a href="{{ route('entreprise.partenaires') }}" class="btn btn-outline-primary px-4">🤝 Mes partenaires</a>
                    </div>
                    <div class="col-md-6">
                            <a href="{{ route('entreprise.agriculteurs') }}" class="btn btn-outline-primary px-4">🌾 Mes agriculteurs</a>
                    </div>
                    <div class="col-md-6">
<a href="{{ route('entreprise.ajouterAgriculteur') }}" class="btn btn-outline-secondary px-4">
    ➕ Ajouter un agriculteur
</a>                    </div>
                    <div class="col-md-6">
<a href="{{ route('entreprise.ajouterPartenaire') }}" class="btn btn-outline-success px-4">
    ➕ Ajouter un partenaire
</a>                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
