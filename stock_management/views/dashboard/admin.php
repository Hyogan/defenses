<?php
$pageTitle = 'Tableau de bord Administrateur';
ob_start();
?>

<style>
    .container-fluid {
        padding: 2rem;
    }

    .h3.mb-0.text-gray-800 {
        color: var(--secondary-color);
    }

    .card {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border: 1px solid #e0e0e0;
    }

    .card-header {
        background-color: #f8f8f8;
        border-bottom: 1px solid #e0e0e0;
    }

    .card-header .text-primary {
        color: var(--primary-color);
    }

    .card-body {
        padding: 1.5rem;
    }

    .text-xs.font-weight-bold {
        font-size: 0.8rem;
        text-transform: uppercase;
        margin-bottom: 0.5rem;
    }

    .text-primary {
        color: var(--primary-color);
    }

    .text-success {
        color: #28a745;
    }

    .text-warning {
        color: #ffc107;
    }

    .text-info {
        color: #17a2b8;
    }

    .text-gray-800 {
        color: var(--text-color);
    }

    .text-gray-300 {
        color: #d1d1d1;
    }

    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .btn-primary:hover {
        background-color: #e65a5a; /* Darker Coral Red on hover */
        border-color: #e65a5a;
    }

    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .table {
        margin-top: 1rem;
    }

    .table th, .table td {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 1px solid #e0e0e0;
    }

    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #e0e0e0;
    }

    .table tbody + tbody {
        border-top: 2px solid #e0e0e0;
    }

    .text-center {
        text-align: center;
    }

    .text-danger {
        color: var(--error-text-color);
    }
</style>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tableau de bord Administrateur</h1>
    </div>

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Produits</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $stats['products'] ?? 0 ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Commandes</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $stats['orders'] ?? 0  ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Commandes en attente</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $stats['pending_orders'] ?? 0 ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Utilisateurs</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $stats['users'] ?? 0   ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Commandes en attente d'approbation</h6>
                </div>
                <div class="card-body">
                    <?php if (!empty($pendingOrders)): ?>
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>Client</th>
                                        <th>Montant</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pendingOrders as $order): ?>
                                    <tr>
                                        <td><?= $order['id'] ?></td>
                                        <td><?= date('d/m/Y', strtotime($order['created_at'])) ?></td>
                                        <td><?= htmlspecialchars($order['client_name']) ?></td>
                                        <td><?= number_format($order['total_amount'], 2, ',', ' ') ?> fcfa</td>
                                        <td>
                                            <a href="/orders/view/<?= $order['id'] ?>" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="/orders/approve/<?= $order['id'] ?>" class="btn btn-success btn-sm">
                                                <i class="fas fa-check"></i>
                                            </a>
                                            <a href="/orders/reject/<?= $order['id'] ?>" class="btn btn-danger btn-sm">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-center">Aucune commande en attente d'approbation.</p>
                    <?php endif; ?>
                    <div class="mt-3 text-center">
                        <a href="/orders" class="btn btn-primary">Voir toutes les commandes</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Alertes de stock</h6>
                </div>
                <div class="card-body">
                    <?php if (!empty($lowStockProducts)): ?>
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Produit</th>
                                        <th>Catégorie</th>
                                        <th>Stock actuel</th>
                                        <th>Stock minimum</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($lowStockProducts as $product): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($product['designation']) ?></td>
                                        <td><?= htmlspecialchars($product['category_name']) ?></td>
                                        <td class="text-danger"><?= $product['quantity'] ?></td>
                                        <td><?= $product['min_stock'] ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-center">Aucune alerte de stock.</p>
                    <?php endif; ?>
                    <div class="mt-3 text-center">
                        <a href="/products" class="btn btn-primary">Gérer les produits</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Activité récente</h6>
                </div>
                <div class="card-body">
                    <?php if (!empty($recentActivity)): ?>
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Utilisateur</th>
                                        <th>Action</th>
                                        <th>Détails</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recentActivity as $activity): ?>
                                    <tr>
                                        <td><?= date('d/m/Y H:i', strtotime($activity['created_at'])) ?></td>
                                        <td><?= htmlspecialchars($activity['user_name']) ?></td>
                                        <td><?= htmlspecialchars($activity['action']) ?></td>
                                        <td><?= htmlspecialchars($activity['details']) ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-center">Aucune activité récente.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include BASE_PATH . '/views/layouts/admin.php';
?>
