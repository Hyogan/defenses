<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Gestion des Lignes Camrails</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Personnalisation des couleurs */
        .navbar {
            background-color: #f30f20; /* Couleur rouge */
        }

        .navbar-brand img {
            width: 50px; /* Taille de l'image du logo */
            height: auto; /* Garder la proportion de l'image */
        }

        .navbar-brand {
            color: white !important; /* Texte blanc */
        }

        .navbar-nav .nav-link {
            color: white !important; /* Liens en blanc */
        }

        .navbar-nav .nav-link:hover {
            color: #f30f20 !important; /* Couleur rouge au survol des liens */
        }

        .btn-custom {
            background-color: #f30f20;
            color: white;
        }

        .btn-custom:hover {
            background-color: white;
            color: #f30f20;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <!-- Logo ajouté ici -->
            <a class="navbar-brand" href="/">
                <img src="https://example.com/path-to-your-logo.png" alt="Logo Camrails">
                Gestion des Lignes Camrails
            </a>
        </div>
    </nav>
    
    <div class="container mt-5">
        <h1 class="text-center">Bienvenue sur la plateforme de gestion des lignes de Camrails</h1>
        <p class="text-center">Utilisez le menu pour gérer les lignes, les activités et les utilisateurs de Camrails.</p>
        <div class="text-center">
            <a href="/auth/login" class="btn btn-custom">Login</a>
            <a href="/auth/register" class="btn btn-outline-custom ms-3">Register</a>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

#f30f20
