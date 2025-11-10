<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ETS MALICKA</title>

    {{-- ✅ Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    {{-- ✅ Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    {{-- ✅ AOS (Animations au scroll) --}}
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    {{-- ✅ Assets Laravel via Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    {{-- 🌿 Barre de navigation --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-success fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('accueil') }}">
                <img src="{{ asset('images/logoprogeagricole.jpeg') }}" alt="Logo" class="logo-rond me-2">
                <span>ETS MALICKA</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="{{ route('accueil') }}">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="#apropos">À propos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#processus">Processus</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>

                <div class="d-flex align-items-center gap-2 ms-3">
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-light btn-sm">🔓 Déconnexion</button>
                        </form>
                    @endauth

                    @guest
                        <a href="{{ route('login.form') }}" class="btn btn-light btn-sm">🔐 Se connecter</a>
                        <a href="{{ route('register.form') }}" class="btn btn-outline-light btn-sm">📝 S’inscrire</a>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    {{-- 💡 Contenu principal --}}
    <main class="pt-5" style="margin-top: 80px;">
        @yield('content')
    </main>

    {{-- 🌾 Footer --}}
    <footer class="bg-success text-white text-center py-3 mt-5">
        <p class="mb-0">&copy; {{ date('Y') }} ETS MALICKA — Tous droits réservés<br>
            Développé avec E2C-TICE pour l'école de la deuxième chance</p>
    </footer>

    {{-- 📦 Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });
    </script>
</body>
</html>