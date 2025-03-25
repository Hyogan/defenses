<?php include_once __DIR__ . '/../partials/header.php'; ?>

<div class="container mt-5">
    <h2>Liste des Tuteurs</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Département</th>
                <th>Poste</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tuteurs as $tuteur): ?>
                <tr>
                    <td><?= htmlspecialchars($tuteur['nom']); ?></td>
                    <td><?= htmlspecialchars($tuteur['departement']); ?></td>
                    <td><?= htmlspecialchars($tuteur['poste']); ?></td>
                    <td>
                        <a href="/tuteur/modifier/<?= $tuteur['id']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="/tuteur/supprimer/<?= $tuteur['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Confirmer la suppression ?')">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="/tuteur/ajouter" class="btn btn-primary">Ajouter un Tuteur</a>
</div>

<?php include_once __DIR__ . '/../partials/footer.php'; ?>
