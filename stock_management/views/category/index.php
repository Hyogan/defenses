<style>
    .container.mt-4 {
        margin-top: 2rem;
    }

    .d-flex.justify-content-between.mb-3 {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1.5rem;
    }

    .form-control.me-2 {
        margin-right: 0.5rem;
        border-radius: 5px;
        border: 1px solid #e0e0e0;
    }

    .form-control.me-2:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(var(--primary-color-rgb), 0.25);
    }

    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .btn-primary:hover {
        background-color: #e65a5a;
        border-color: #e65a5a;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
    }

    .btn-warning:hover {
        background-color: #e0a800;
        border-color: #d39e00;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }

    .alert {
        border-radius: 5px;
        padding: 1rem;
        margin-bottom: 1rem;
    }

    .alert-success {
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
    }

    .alert-danger {
        background-color: #f8d7da;
        border-color: #f5c6cb;
        color: #721c24;
    }

    .table {
        margin-top: 1rem;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        overflow: hidden;
    }

    .table th, .table td {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 1px solid #e0e0e0;
    }

    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #e0e0e0;
        background-color: #f8f8f8;
    }

    .table tbody + tbody {
        border-top: 2px solid #e0e0e0;
    }
</style>

<div class="container mt-4">
    <h2><?= $pageTitle ?? 'Gestion des Catégories' ?></h2>

    <div class="d-flex justify-content-between mb-3">
        <form method="GET" action="/categories" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Rechercher..." value="<?= htmlspecialchars($search ?? '') ?>">
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>
        <a href="/categories/create" class="btn btn-success">+ Ajouter une catégorie</a>
    </div>

    <?php if (!empty($_SESSION['success'])) : ?>
        <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <?php if (!empty($_SESSION['error'])) : ?>
        <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category) : ?>
                <tr>
                    <td><?= $category['id']; ?></td>
                    <td><?= htmlspecialchars($category['nom']); ?></td>
                    <td><?= htmlspecialchars($category['description']);  ?></td>
                    <td><?= htmlspecialchars($category['statut']); ?></td>
                    <td>
                        <a href="/categories/edit/<?= $category['id']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="/categories/delete/<?= $category['id']; ?>" onclick="return confirm('Confirmer la suppression ?');" class="btn btn-danger btn-sm">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
