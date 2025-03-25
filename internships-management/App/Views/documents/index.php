<?php include_once __DIR__ . '/../partials/header.php'; ?>

<div class="container mt-5">
    <h2>Documents des Stagiaires</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nom du fichier</th>
                <th>Date d'upload</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($documents as $document): ?>
                <tr>
                    <td><?= htmlspecialchars($document['nom_fichier']); ?></td>
                    <td><?= htmlspecialchars($document['date_upload']); ?></td>
                    <td>
                        <a href="/document/download/<?= $document['id']; ?>" class="btn btn-info btn-sm">Télécharger</a>
                        <a href="/document/supprimer/<?= $document['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Confirmer la suppression ?')">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="/document/ajouter" class="btn btn-primary">Ajouter un Document</a>
</div>

<?php include_once __DIR__ . '/../partials/footer.php'; ?>
