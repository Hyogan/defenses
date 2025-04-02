<div class="container mt-5">
    <h2>Évaluations de <?= htmlspecialchars($stagiaire['nom'] . ' ' . $stagiaire['prenom']); ?></h2>
  <!-- <a class="btn btn-primary" href="/evaluation/ajouter">Ajouter evaluation</a> -->
    <!-- Affichage des évaluations -->
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Note</th>
                <th>Commentaires</th>
                <th>Date</th>
                <?php if ($_SESSION['user_role'] === 'tuteur'): ?>
                    <th>Actions</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($evaluations)): ?>
                <tr><td colspan="4">Aucune évaluation disponible.</td></tr>
            <?php else: ?>
                <?php foreach ($evaluations as $evaluation): ?>
                    <tr>
                        <td><?= htmlspecialchars($evaluation['stagiaire_nom']); ?></td>
                        <td><?= htmlspecialchars($evaluation['stagiaire_prenom']); ?></td>
                        <td><?= htmlspecialchars($evaluation['note']); ?></td>
                        <td><?= htmlspecialchars($evaluation['commentaires']); ?></td>
                        <td><?= htmlspecialchars($evaluation['date_evaluation']); ?></td>
                        <?php if ($_SESSION['user_role'] === 'tuteur'): ?>
                            <td>
                                <a href="/evaluation/modifier/<?= $evaluation['id']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                                <a href="/evaluation/supprimer/<?= $evaluation['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Confirmer la suppression ?')">Supprimer</a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <?php if ($_SESSION['user_role'] === 'tuteur'): ?>
        <a href="/stagiaire/<?= $stagiaire['id']; ?>/evaluation/ajouter" class="btn btn-primary">Ajouter une évaluation</a>
    <?php endif; ?>
</div>

