<nav id="sidebarMenu" style="height: 100%; height: 100vh;" class="sticky col-md-3 col-lg-2 d-md-block sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?= $currentPage === 'dashboard' ? 'active' : '' ?>" href="<?= APP_URL ?>/dashboard">
                    <i class="fas fa-tachometer-alt me-2"></i>
                    Tableau de bord
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?= $currentPage === 'products' ? 'active' : '' ?>" href="<?= APP_URL ?>/products">
                    <i class="fas fa-box me-2"></i>
                    Produits
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?= $currentPage === 'categories' ? 'active' : '' ?>" href="<?= APP_URL ?>/categories">
                    <i class="fas fa-tags me-2"></i>
                    Catégories
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?= $currentPage === 'suppliers' ? 'active' : '' ?>" href="<?= APP_URL ?>/suppliers">
                    <i class="fas fa-truck me-2"></i>
                    Fournisseurs
                </a>
            </li>

            
        <?php if($_SESSION['user_role'] != 'magasinier') :?>
              <li class="nav-item">
              <a class="nav-link <?= $currentPage === 'clients' ? 'active' : '' ; ?>" href="<?= APP_URL ?>/clients">
                  <i class="fas fa-users me-2"></i>
                  Clients
              </a>
          </li>
          <?php endif; ?>
            
            <li class="nav-item">
                <a class="nav-link <?= $currentPage === 'orders' ? 'active' : '' ?>" href="<?= APP_URL ?>/orders">
                    <i class="fas fa-shopping-cart me-2"></i>
                    Commandes
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?= $currentPage === 'stock-entries' ? 'active' : '' ?>" href="<?= APP_URL ?>/stock-entries">
                    <i class="fas fa-arrow-circle-down me-2"></i>
                    Entrées de stock
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?= $currentPage === 'stock-exits' ? 'active' : '' ?>" href="<?= APP_URL ?>/stock-exits">
                    <i class="fas fa-arrow-circle-up me-2"></i>
                    Sorties de stock
                </a>
            </li>
            
            <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
            <li class="nav-item">
                <a class="nav-link <?= $currentPage === 'users' ? 'active' : '' ?>" href="<?= APP_URL ?>/users">
                    <i class="fas fa-user-cog me-2"></i>
                    Utilisateurs
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?= $currentPage === 'reports' ? 'active' : '' ?>" href="<?= APP_URL ?>/products/stats">
                    <i class="fas fa-chart-bar me-2"></i>
                    statistiques
                </a>
            </li>
            <?php endif; ?>
            <li class="nav-item">
                <a class="nav-link <?= $currentPage === 'settings' ? 'active' : '' ?>" href="/users/profile/">
                    <i class="fas fa-user me-2"></i>
                    Profil
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= APP_URL ?>/auth/logout">
                    <i class="fas fa-sign-out"></i>
                   Deconnexion
                </a>
            </li>
        </ul>
        
        </div>
    <style>
        #sidebarMenu {
            background-color: var(--secondary-color);
            color: white;
        }

        #sidebarMenu .nav-link {
            color: white;
        }

        #sidebarMenu .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        #sidebarMenu .nav-link.active {
            background-color: var(--primary-color);
            color: white;
        }

        #sidebarMenu .nav-link i {
            color: white;
        }
    </style>
</nav>
