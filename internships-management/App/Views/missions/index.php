<?php include_once __DIR__ . '/../partials/header.php'; ?>

<div class="container mt-5">
    <h2>Liste des Missions/Tâches</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Stagiaire Assigné</th>
                <th>Date d'échéance</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($missions as $mission): ?>
                <tr>
                    <td><?= htmlspecialchars($mission['titre']); ?></td>
                    <td><?= htmlspecialchars($mission['stagiaire_nom']); ?></td>
                    <td><?= htmlspecialchars($mission['date_echeance']); ?></td>
                    <td><?= htmlspecialchars($mission['statut']); ?></td>
                    <td>
                        <a href="/mission/modifier/<?= $mission['id']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="/mission/supprimer/<?= $mission['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Confirmer la suppression ?')">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="/mission/ajouter" class="btn btn-primary">Ajouter une Mission</a>
</div>

<?php include_once __DIR__ . '/../partials/footer.php'; ?>
