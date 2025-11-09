<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Plateforme Agricole</title>
    <!-- Lien vers CSS simple pour un style basique -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white text-center">
                    <h4>Créer un compte</h4>
                </div>
                <div class="card-body">

                    <!-- Affichage des erreurs -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Formulaire d'inscription -->
                    <form action="{{ route('register') }}" method="POST">
                        @csrf <!-- Protection contre CSRF -->

                        <div class="mb-3">
                            <label for="name" class="form-label">Nom complet</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Rôle</label>
                            <select name="role" id="role" class="form-select" required>
                                <option value="">Sélectionnez un rôle</option>
                                <option value="agriculteur" {{ old('role') == 'agriculteur' ? 'selected' : '' }}>Agriculteur</option>
                                <option value="entreprise" {{ old('role') == 'entreprise' ? 'selected' : '' }}>Entreprise</option>
                                <option value="partenaire" {{ old('role') == 'partenaire' ? 'selected' : '' }}>Partenaire</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">S’inscrire</button>
                        </div>
                    </form>

                    <div class="mt-3 text-center">
                        <a href="{{ route('login.form') }}">Déjà un compte ? Connectez-vous</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
