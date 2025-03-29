<div class="container mt-5">
    <h2>Liste des Stagiaires</h2>
    <a href="/stagiaire/ajouter" class="btn btn-primary">Ajouter un Stagiaire</a>
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
                        <a href="/stagiaire/show/<?= $stagiaire['utilisateur_id']; ?>" class="btn btn-info btn-sm">Voir</a>
                        <a href="/stagiaire/modifier/<?= $stagiaire['utilisateur_id']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="/stagiaire/assign-tuteurs/<?= $stagiaire['id'] ?>" class="btn btn-primary">
                          <i class="fas fa-user-plus"></i> Assigner des tuteurs
                        </a>
                        <a href="/stagiaire/supprimer/<?= $stagiaire['utilisateur_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Confirmer la suppression ?')">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

