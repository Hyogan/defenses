<div class="container mt-4">
    <h1>Liste des tâches</h1>

    <div class="mb-3">
        <a href="/taches/create" class="btn btn-primary">Créer une nouvelle tâche</a>
    </div>

    <?php if (empty($taches)) : ?>
        <div class="alert alert-info">Aucune tâche disponible.</div>
    <?php else : ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Stagiaire</th>
                        <th>Statut</th>
                        <th>Progression</th>
                        <th>Date d'échéance</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($taches as $tache) : ?>
                        <tr>
                            <td><?= $tache['id'] ?></td>
                            <td><?= htmlspecialchars($tache['titre']) ?></td>
                            <td>
                                <?= htmlspecialchars($tache['stagiaire_nom'] . ' ' . $tache['stagiaire_prenom']) ?>
                            </td>
                            <td>
                                <span class="badge <?= $tache['statut'] === 'terminée' ? 'bg-success' : ($tache['statut'] === 'en cours' ? 'bg-warning' : 'bg-secondary') ?>">
                                    <?= htmlspecialchars($tache['statut']) ?>
                                </span>
                            </td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: <?= $tache['nouveau_pourcentage'] ?>%;"
                                         aria-valuenow="<?= $tache['nouveau_pourcentage'] ?>" aria-valuemin="0" aria-valuemax="100">
                                        <?= $tache['nouveau_pourcentage'] ?>%
                                    </div>
                                </div>
                            </td>
                            <td><?= htmlspecialchars($tache['date_limite'] ?? 'Non définie') ?></td>
                            <td>
                                <div class="btn-group">
                                    <a href="/taches/show/<?= $tache['id'] ?>" class="btn btn-sm btn-info">Voir</a>
                                    <a href="/taches/edit/<?= $tache['id'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                                    <a href="/taches/delete/<?= $tache['id'] ?>" class="btn btn-sm btn-danger">Supprimer</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
