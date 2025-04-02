<div class="container mt-4">
    <h1 class="mb-4">Tableau de bord Stagiaire</h1>
    <h2 class="mb-3">Tâches en cours</h2>

    <?php if (empty($tachesEnCours)): ?>
        <p class="alert alert-info">Aucune tâche en cours.</p>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Date Limite</th>
                        <th>Statut</th>
                        <th>Pourcentage</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tachesEnCours as $tache): ?>
                        <tr>
                            <td><?= htmlspecialchars($tache['titre']) ?></td>
                            <td><?= htmlspecialchars($tache['description']) ?></td>
                            <td><?= htmlspecialchars($tache['date_limite']) ?></td>
                            <td class="status-<?= htmlspecialchars(strtolower($tache['statut'])) ?>">
                                <?= htmlspecialchars($tache['statut']) ?>
                            </td>
                            <td><?= htmlspecialchars($tache['nouveau_pourcentage']) ?>%</td>
                            <td class="d-flex justify-content-around">
                                <form method="post" action="/tache/update_status/<?= $tache['id'] ?>" class="mb-0">
                                    <div class="input-group">
                                        <select name="status" class="form-control form-control-sm">
                                            <option value="en attente" <?= $tache['statut'] == 'en attente' ? 'selected' : '' ?>>En attente</option>
                                            <option value="en cours" <?= $tache['statut'] == 'en cours' ? 'selected' : '' ?>>En cours</option>
                                            <option value="terminée" <?= $tache['statut'] == 'terminée' ? 'selected' : '' ?>>Terminée</option>
                                        </select>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-sm btn-primary">Statut</button>
                                        </div>
                                    </div>
                                </form>
                                <form method="post" action="/tache/update_percentage/<?= $tache['id'] ?>" class="mb-0">
                                    <div class="input-group">
                                        <input type="text" name="percentage" class="form-control form-control-sm" placeholder="%" value="<?= htmlspecialchars($tache['nouveau_pourcentage']) ?>">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-sm btn-success">Avancement</button>
                                        </div>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
