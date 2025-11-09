<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - Plateforme Agricole</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="#">Plateforme Agricole</a>
            <form action="{{ route('logout') }}" method="POST" class="d-flex">
                @csrf
                <button type="submit" class="btn btn-outline-light">Déconnexion</button>
            </form>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white text-center">
                <h4>Bienvenue sur votre tableau de bord</h4>
            </div>
            <div class="card-body text-center">
                <h5>Bonjour, <strong>{{ auth()->user()->name }}</strong> 👋</h5>

                @if(session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif

                <p class="mt-4">Vous êtes maintenant connecté à la plateforme agricole.</p>

                <a href="#" class="btn btn-outline-success">Voir mes produits</a>
                <a href="#" class="btn btn-outline-primary">Ajouter un produit</a>
            </div>
        </div>
    </div>
<script>
function toggleComment(id) {
    const form = document.getElementById('reject-form-' + id);
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}
</script>
</body>
</html>
