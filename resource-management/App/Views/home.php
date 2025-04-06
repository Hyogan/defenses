<style>
        /* Personnalisation des couleurs */
        .navbar {
            background-color: #f30f20; /* Couleur rouge */
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
                <img src="logo-camrail.jpeg" alt="Logo Camrails">
                Gestion des Lignes Camrails
            </a>
        </div>
    </nav>
    
    <div class="container mt-5">
        <h1 class="text-center">Bienvenue sur la plateforme de gestion des lignes de Camrails</h1>
        <p class="text-center">Utilisez le menu pour gérer les lignes, les activités et les utilisateurs de Camrails.</p>
        <div class="text-center">
            <a href="/auth/login" class="btn btn-custom">Login</a>
            <!-- <a href="/auth/register" class="btn btn-outline-custom ms-3">Register</a> -->
        </div>
    </div>
