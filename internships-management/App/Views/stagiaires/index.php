<?php include_once __DIR__ . '/../partials/header.php'; ?>

<div class="container mt-5">
    <h2>Liste des Stagiaires</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Formation</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($stagiaires as $stagiaire): ?>
                <tr>
                    <td><?= htmlspecialchars($stagiaire['nom']); ?></td>
                    <td><?= htmlspecialchars($stagiaire['prenom']); ?></td>
                    <td><?= htmlspecialchars($stagiaire['formation']); ?></td>
                    <td>
                        <a href="/stagiaire/show/<?= $stagiaire['id']; ?>" class="btn btn-info btn-sm">Voir</a>
                        <a href="/stagiaire/modifier/<?= $stagiaire['id']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="/stagiaire/supprimer/<?= $stagiaire['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Confirmer la suppression ?')">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="/stagiaire/ajouter" class="btn btn-primary">Ajouter un Stagiaire</a>
</div>

<?php include_once __DIR__ . '/../partials/footer.php'; ?>
