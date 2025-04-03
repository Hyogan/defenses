<?php
// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id']) && !in_array($_SERVER['REQUEST_URI'], ['/auth/login', '/auth/forgot-password'])) {
    header('Location: ' . APP_URL . '/auth/login');
    exit;
}

// Définir la page courante si elle n'est pas définie
$currentPage = $currentPage ?? '';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Tableau de bord' ?> - Gestion de stocks - Produits electroniques</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/style.css">
    <?php if (isset($additionalCss)): ?>
        <?php foreach ($additionalCss as $css): ?>
            <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/<?= $css ?>">
        <?php endforeach; ?>
    <?php endif; ?>
    <style>
         header.navbar {
            background-color: var(--secondary-color); 
        }

        /* header.navbar .navbar-brand {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            font-weight: 600;
        } */

        /* header.navbar .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.5);
        }

        header.navbar .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 0.5)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        } */

        /* header.navbar .nav-link {
            color: white;
        }

        header.navbar .nav-item a {
            margin-left: 5px;
        } */
    </style>
</head>
<body>
    <header class="navbar navbar-dark sticky-top flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="<?= APP_URL ?>/dashboard">
           Gestion de stocks - Produits electroniques
        </a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="w-100"></div>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap d-flex align-items-center">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <span class="nav-link px-3 text-white">
                        <i class="fas fa-user me-2"></i><?= $_SESSION['user_name'] ?? 'Utilisateur' ?>
                    </span>
                    <a class="nav-link px-3" href="<?= APP_URL ?>/auth/logout">
                        <i class="fas fa-sign-out-alt"></i> Déconnexion
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </header>
</body>
</html>
