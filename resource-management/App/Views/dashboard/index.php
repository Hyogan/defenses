<?php include_once __DIR__ . '/../partials/header.php'; ?>

<div class="container mt-5">
    <h2>Tableau de Bord</h2>
    <p>Bienvenue, <?= htmlspecialchars($_SESSION['user']['nom']); ?> !</p>

    <div class="row">
        <div class="col-md-4">
            <a href="/stagiaires" class="btn btn-primary">Gérer les Stagiaires</a>
        </div>
        <div class="col-md-4">
            <a href="/tuteurs" class="btn btn-secondary">Gérer les Tuteurs</a>
        </div>
        <div class="col-md-4">
            <a href="/documents" class="btn btn-warning">Gérer les Documents</a>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../partials/footer.php'; ?>
