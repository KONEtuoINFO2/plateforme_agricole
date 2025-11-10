@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Ajouter un nouveau produit</h2>

    <div class="card shadow-lg p-4">

        <!-- Boutons de navigation -->
        <div class="mb-4 d-flex justify-content-between">
                   <a href="{{ route('agriculteur.dashboard') }}" class="btn btn-primary px-4">🏠 Tableau de bord</a>

               <a href="{{ route('products.index') }}" class="btn btn-info px-4 text-white">📋 Voir la liste</a>
           </a>
        </div>

        <!-- Formulaire -->
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Nom du produit -->
            <div class="mb-3">
                <label for="nom" class="form-label">Nom du produit</label>
                <input type="text" name="nom" class="form-control" placeholder="Ex: Maïs jaune" value="{{ old('nom') }}" required>
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3" placeholder="Décrivez le produit (facultatif)">{{ old('description') }}</textarea>
            </div>

            <!-- Localité -->
             <!-- Localité -->
<div class="mb-3">
    <label for="region" class="form-label">Région</label>
    <select id="region" class="form-select">
        <option value="">-- Sélectionnez une région --</option>
        <option value="Savanes">Savanes</option>
        <option value="Woroba">Woroba</option>
        <option value="Lacs">Lacs</option>
        <option value="Lagunes">Lagunes</option>
        <option value="Bas-Sassandra">Bas-Sassandra</option>
        <option value="Gôh-Djiboua">Gôh-Djiboua</option>
        <option value="Montagnes">Montagnes</option>
        <option value="Vallée du Bandama">Vallée du Bandama</option>
        <option value="Zanzan">Zanzan</option>
        <option value="Denguélé">Denguélé</option>
    </select>
</div>

<div class="mb-3">
    <label for="departement" class="form-label">Département</label>
    <select id="departement" name="localite" class="form-select">
        <option value="">-- Sélectionnez un département --</option>
    </select>
    <small class="text-muted">Ou saisissez manuellement si non listé :</small>
    <input type="text" id="autre_localite" name="autre_localite" class="form-control mt-2" placeholder="Saisir un autre lieu">
</div>

<!-- Script dynamique -->
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

    regionSelect.addEventListener('change', function() {
        const region = this.value;
        departementSelect.innerHTML = '<option value="">-- Sélectionnez un département --</option>';

        if (region && localites[region]) {
            localites[region].forEach(dep => {
                const opt = document.createElement('option');
                opt.value = dep;
                opt.textContent = dep;
                departementSelect.appendChild(opt);
            });
        }
    });
</script>

            

            <!-- Prix -->
            <div class="mb-3">
                <label for="prix" class="form-label">Prix (en FCFA)</label>
                <input type="number" step="0.01" name="prix" class="form-control" placeholder="Ex: 2500" value="{{ old('prix') }}" required>
            </div>

            <!-- Quantité -->
            <div class="mb-3">
                <label for="quantite" class="form-label">Quantité</label>
                <input type="text" name="quantite" class="form-control" placeholder="Ex: 10 kg ou 2 tonnes" value="{{ old('quantite') }}" required>
            </div>

            <!-- Image du produit (facultative) -->
            <div class="mb-3">
                <label for="image" class="form-label">Image du produit (facultative)</label>
                <input type="file" name="image" class="form-control" accept="image/*">
                <small class="text-muted">Formats acceptés : JPG, PNG, WEBP (max. 2 Mo)</small>
            </div>

            <!-- Agriculteur connecté -->
            <div class="mb-3">
                <label class="form-label">Agriculteur</label>
                <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
            </div>

            <!-- Boutons d’action -->
            <div class="text-center d-flex justify-content-center gap-3">
                <button type="submit" class="btn btn-success px-4">💾 Enregistrer</button>
                <a href="{{ route('agriculteur.dashboard') }}" class="btn btn-danger px-4">❌ Annuler</a>
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
