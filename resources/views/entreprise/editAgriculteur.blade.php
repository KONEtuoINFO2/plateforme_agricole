@extends('layouts.app')

@section('content')
<div class="container">
     <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-success">✏️ Modifier un agriculteur</h2>
        <a href="{{ route('entreprise.dashboard') }}" class="btn btn-outline-success">
            ← Retour au tableau de bord
        </a>
    </div>


    <form action="{{ route('entreprise.agriculteur.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Nom --}}
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', $user->name) }}" required>
        </div>

        {{-- Email --}}
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        {{-- Contact WhatsApp --}}
        <div class="mb-3">
            <label for="contact" class="form-label">Contact WhatsApp</label>
            <input type="text" name="contact" id="contact" class="form-control" value="{{ old('contact', $user->contact) }}" required>
        </div>

        {{-- Sexe --}}
        <div class="mb-3">
            <label for="sexe" class="form-label">Sexe</label>
            <select name="sexe" id="sexe" class="form-select" required>
                <option value="">-- Choisir le sexe --</option>
                <option value="Homme" {{ old('sexe', $user->sexe) == 'Homme' ? 'selected' : '' }}>Homme</option>
                <option value="Femme" {{ old('sexe', $user->sexe) == 'Femme' ? 'selected' : '' }}>Femme</option>
            </select>
        </div>

        {{-- Région --}}
        <div class="mb-3">
            <label for="region" class="form-label">Région</label>
            <select name="region" id="region" class="form-select" required>
                <option value="">-- Choisir une région --</option>
                @foreach($regions as $region)
                    <option value="{{ $region }}" {{ old('region', $user->region) == $region ? 'selected' : '' }}>{{ $region }}</option>
                @endforeach
            </select>
        </div>

        {{-- Localité --}}
        <div class="mb-3">
            <label for="localite" class="form-label">Localité</label>
            <input type="text" name="localite" id="localite" class="form-control" value="{{ old('localite', $user->localite) }}" required>
        </div>

        {{-- Photo --}}
        <div class="mb-3">
            <label for="photo" class="form-label">Photo (facultatif)</label>
            <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
            @if($user->photo)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $user->photo) }}" alt="photo actuelle" width="80" class="rounded">
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">💾 Enregistrer les modifications</button>
        <a href="{{ route('entreprise.agriculteurs') }}" class="btn btn-secondary">↩️ Retour</a>
    </form>
</div>
@endsection