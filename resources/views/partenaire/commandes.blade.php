@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-success">📋 Mes commandes</h2>
        <a href="{{ route('partenaire.dashboard') }}" class="btn btn-secondary">↩️ Retour au tableau de bord</a>
    </div>

    @if($commandes->isEmpty())
        <p>Aucune commande enregistrée pour le moment.</p>
    @else
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Quantité</th>
                        <th>Prix unitaire</th>
                        <th>Montant total</th>
                        <th>Adresse de livraison</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($commandes as $commande)
                        <tr>
                            <td>{{ $commande->produit->nom ?? 'Produit supprimé' }}</td>
                            <td>{{ $commande->quantite }}</td>
                            <td>{{ $commande->produit->prix ?? '-' }} FCFA</td>
                            <td>{{ ($commande->produit->prix ?? 0) * $commande->quantite }} FCFA</td>
                            <td>{{ $commande->adresse_livraison }}</td>
                            <td>
                                @if($commande->status === 'valide')
                                    <span class="badge bg-success">Validée</span>
                                @elseif($commande->status === 'rejetée')
                                    <span class="badge bg-danger">Rejetée</span>
                                @else
                                    <span class="badge bg-warning text-dark">En attente</span>
                                @endif
                            </td>
                            <td>
                                @if($commande->status === 'en_attente')
                                    <form action="{{ route('partenaire.commandes.valider', $commande->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-success">Valider</button>
                                    </form>

                                    <a href="{{ route('partenaire.commandes.edit', $commande->id) }}" class="btn btn-sm btn-warning">Modifier</a>

                                    <form action="{{ route('partenaire.commandes.annuler', $commande->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Annuler</button>
                                    </form>
                                @else
                                    <span class="text-muted">Aucune action</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection