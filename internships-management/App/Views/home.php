<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Gestion des Stagiaires</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">Gestion Stagiaires</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/auth/login">Se connecter</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/auth/register">S'inscrire</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container mt-5 text-center">
        <h1 class="fw-bold">Bienvenue sur la plateforme de gestion des stagiaires</h1>
        <p class="lead">Utilisez le menu pour naviguer.</p>
        <div class="mt-4">
            <a href="/auth/login" class="btn btn-primary me-2">Se connecter</a>
            <!-- <a href="/auth/register" class="btn btn-outline-primary">S'inscrire</a> -->
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
