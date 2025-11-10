@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">✏️ Modifier le produit</h2>

    <div class="card shadow-lg p-4">

        <!-- Boutons de navigation -->
        <div class="mb-4 d-flex justify-content-between">
            <a href="{{ route('agriculteur.dashboard') }}" class="btn btn-primary px-4">🏠 Tableau de bord</a>
            <a href="{{ route('products.index') }}" class="btn btn-info px-4 text-white">📋 Liste des produits</a>
        </div>

        <!-- Formulaire d’édition -->
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Nom du produit -->
            <div class="mb-3">
                <label for="nom" class="form-label">Nom du produit</label>
                <input type="text" name="nom" class="form-control" value="{{ old('nom', $product->nom) }}" required>
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description) }}</textarea>
            </div>

            <!-- Localité -->
            <div class="mb-3">
                <label for="region" class="form-label">Région</label>
                <select id="region" class="form-select">
                    <option value="">-- Sélectionnez une région --</option>
                    @foreach(["Savanes","Woroba","Lacs","Lagunes","Bas-Sassandra","Gôh-Djiboua","Montagnes","Vallée du Bandama","Zanzan","Denguélé"] as $region)
                        <option value="{{ $region }}" {{ Str::contains($product->localite, $region) ? 'selected' : '' }}>
                            {{ $region }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="departement" class="form-label">Département</label>
                <select id="departement" name="localite" class="form-select">
                    <option value="{{ $product->localite }}">{{ $product->localite }}</option>
                </select>
                <small class="text-muted">Ou saisissez manuellement si non listé :</small>
                <input type="text" id="autre_localite" name="autre_localite" class="form-control mt-2" placeholder="Saisir un autre lieu">
            </div>

            <script>
                const localites = {
                    "Savanes": ["Korhogo", "Boundiali", "Ferkessédougou", "Tengrela"],
                    "Woroba": ["Séguéla", "Mankono", "Kani"],
                    "Lacs": ["Yamoussoukro", "Toumodi", "Tiébissou"],
                    "Lagunes": ["Abidjan", "Alépé", "Dabou", "Jacqueville"],
                    "Bas-Sassandra": ["San-Pédro", "Sassandra", "Tabou"],
                    "Gôh-Djiboua": ["Gagnoa", "Divo", "Lakota"],
                    "Montagnes": ["Man", "Danané", "Guiglo"],
                    "Vallée du Bandama": ["Bouaké", "Katiola", "Béoumi"],
                    "Zanzan": ["Bondoukou", "Bouna", "Tanda"],
                    "Denguélé": ["Odienné", "Madinani", "Minignan"]
                };

                const regionSelect = document.getElementById('region');
                const departementSelect = document.getElementById('departement');
                const oldLocalite = "{{ $product->localite }}";

                regionSelect.addEventListener('change', function() {
                    const region = this.value;
                    departementSelect.innerHTML = '<option value="">-- Sélectionnez un département --</option>';
                    if (region && localites[region]) {
                        localites[region].forEach(dep => {
                            const opt = document.createElement('option');
                            opt.value = dep;
                            opt.textContent = dep;
                            if (dep === oldLocalite) opt.selected = true;
                            departementSelect.appendChild(opt);
                        });
                    }
                });
            </script>

            <!-- Prix -->
            <div class="mb-3">
                <label for="prix" class="form-label">Prix (en FCFA)</label>
                <input type="number" step="0.01" name="prix" class="form-control" value="{{ old('prix', $product->prix) }}" required>
            </div>

            <!-- Quantité -->
            <div class="mb-3">
                <label for="quantite" class="form-label">Quantité</label>
                <input type="text" name="quantite" class="form-control" value="{{ old('quantite', $product->quantite) }}" required>
            </div>

            <!-- Image -->
            <div class="mb-3">
                <label for="image" class="form-label">Changer l’image (facultatif)</label>
                <input type="file" name="image" class="form-control" accept="image/*">
                @if($product->image)
                    <div class="mt-3">
                        <p>Image actuelle :</p>
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Image du produit" class="img-thumbnail" width="200">
                    </div>
                @endif
            </div>

            <!-- Boutons -->
            <div class="text-center d-flex justify-content-center gap-3">
                <button type="submit" class="btn btn-success px-4">💾 Enregistrer les modifications</button>
                <a href="{{ route('products.index') }}" class="btn btn-danger px-4">❌ Annuler</a>
            </div>
        </form>
    </div>
</div>
<script>
function toggleComment(id) {
    const form = document.getElementById('reject-form-' + id);
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}
</script>
@endsection
