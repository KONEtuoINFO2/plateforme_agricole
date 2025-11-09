@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-success">➕ Ajouter un partenaire</h2>
        <a href="{{ route('entreprise.dashboard') }}" class="btn btn-outline-success">
            ← Retour au tableau de bord
        </a>
    </div>
    <form action="{{ route('entreprise.storePartenaire') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Nom --}}
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control" required>
        </div>
        {{-- Email --}}
<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" name="email" id="email" class="form-control" required>
</div>

        {{-- Contact WhatsApp --}}
        <div class="mb-3">
            <label for="contact" class="form-label">Contact WhatsApp</label>
            <input type="text" name="contact" id="contact" class="form-control" placeholder="+2250700000000" required>
        </div>

        {{-- Sexe --}}
        <div class="mb-3">
            <label for="sexe" class="form-label">Sexe</label>
            <select name="sexe" id="sexe" class="form-select" required>
                <option value="">-- Choisir le sexe --</option>
                <option value="Homme">Homme</option>
                <option value="Femme">Femme</option>
            </select>
        </div>

        {{-- Région --}}
        <div class="mb-3">
            <label for="region" class="form-label">Région</label>
            <select name="region" id="region" class="form-select" required>
                <option value="">-- Choisir une région --</option>
                @foreach($regions as $region)
                    <option value="{{ $region }}">{{ $region }}</option>
                @endforeach
            </select>
        </div>

        {{-- Localité (dynamique) --}}
        <div class="mb-3">
            <label for="localite" class="form-label">Localité</label>
            <select name="localite" id="localite" class="form-select" required>
                <option value="">-- Choisir une localité --</option>
            </select>
        </div>

        {{-- Photo --}}
        <div class="mb-3">
            <label for="photo" class="form-label">Photo (facultatif)</label>
            <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-success">Ajouter le partenaire</button>
    </form>
</div>

{{-- Script JS pour localités dynamiques --}}
<script>
    const localitesParRegion = {
        "Savanes": ["Sinématiali", "Korhogo", "Ferkessédougou"],
        "Denguélé": ["Odienné", "Minignan"],
        "Woroba": ["Séguéla", "Kani", "Mankono"],
        "Zanzan": ["Bondoukou", "Bouna", "Tanda"]
    };

    document.getElementById('region').addEventListener('change', function () {
        const region = this.value;
        const localiteSelect = document.getElementById('localite');
        localiteSelect.innerHTML = '<option value="">-- Choisir une localité --</option>';

        if (localitesParRegion[region]) {
            localitesParRegion[region].forEach(localite => {
                const option = document.createElement('option');
                option.value = localite;
                option.textContent = localite;
                localiteSelect.appendChild(option);
            });
        }
    });
</script>
@endsection