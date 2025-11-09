@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-success">Liste des agriculteurs</h2>
        <a href="{{ route('entreprise.dashboard') }}" class="btn btn-outline-success">
            ← Retour au tableau de bord
        </a>
    </div>
<form method="GET" action="{{ route('entreprise.agriculteurs') }}" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="🔍 Rechercher par nom, email ou région" value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Rechercher</button>
        @if(request()->has('search'))
            <a href="{{ route('entreprise.agriculteurs') }}" class="btn btn-outline-secondary">Réinitialiser</a>
        @endif
    </div>
</form>
    @if($agriculteurs->isEmpty())
        <div class="alert alert-info">Aucun agriculteur enregistré pour le moment.</div>
        
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Photo</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Sexe</th>
                        <th>Région</th>
                        <th>Localité</th>
                        <th>Date d'ajout</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($agriculteurs as $user)
                        <tr>
                            <td>
                                @if($user->photo)
                                    <img src="{{ asset('storage/' . $user->photo) }}" alt="photo" width="60" height="60" class="rounded-circle">
                                @else
                                    <span class="text-muted">Aucune</span>
                                @endif
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->contact }}</td>
                            <td>{{ $user->sexe }}</td>
                            <td>{{ $user->region }}</td>
                            <td>{{ $user->localite }}</td>
                            <td>{{ $user->created_at->format('d/m/Y à H:i') }}</td>
                            <td>
                                <a href="{{ route('entreprise.agriculteur.edit', $user->id) }}" class="btn btn-sm btn-warning">Modifier</a>

                                <form action="{{ route('entreprise.agriculteur.destroy', $user->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Supprimer cet agriculteur ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection