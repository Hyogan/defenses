<style>
    /* Personnalisation des couleurs */
    .navbar {
        background-color: #343a40; /* Gris foncé pour la barre de navigation */
    }

    .navbar-brand img {
        width: 100px; /* Taille de l'image du logo */
        height: auto; /* Garder la proportion de l'image */
    }

    .navbar-brand {
        color: white !important; /* Texte blanc */
    }

    .navbar-nav .nav-link {
        color: white !important; /* Liens en blanc */
    }

    .navbar-nav .nav-link:hover {
        color: #17a2b8 !important; /* Couleur cyan au survol des liens */
    }

    .btn-custom {
        background-color: #17a2b8; /* Couleur cyan pour le bouton */
        color: white;
    }

    .btn-custom:hover {
        background-color: white;
        color: #17a2b8;
        border: 1px solid #17a2b8; /* Ajout d'une bordure au survol */
    }
</style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="logo-iug.png" alt="Logo IUG">
                Gestion de Matériel et Laboratoires
            </a>
        </div>
    </nav>
    
    <div class="container mt-5">
        <h1 class="text-center">Bienvenue sur la plateforme de gestion de matériel et laboratoires</h1>
        <p class="text-center">Utilisez le menu pour gérer les matériels, les laboratoires, les services et les utilisateurs.</p>
        <div class="text-center">
            <a href="/auth/login" class="btn btn-custom">Login</a>
            </div>
    </div>
</body>
