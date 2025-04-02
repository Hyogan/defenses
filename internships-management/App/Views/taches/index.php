<div class="container mt-4">
        <h1 class="mb-4">Gestion des Tâches et Stagiaires</h1>
        <a class="btn btn-primary my-2" href="/tache/ajouter">Ajouter une tache</a>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex align-items-center">
                        <i class="bi bi-list-task me-2"></i> Liste des Tâches
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Tâche</th>
                                        <th>Stagiaire Assigné</th>
                                        <th>Statut</th>
                                        <th>Pourcentage</th>
                                        <th>Date limite</th>
                                        <!-- <th></th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($taches)) : ?>
                                        <tr>
                                            <td colspan="3" class="text-center text-muted">Aucune tâche trouvée.</td>
                                        </tr>
                                    <?php else : ?>
                                        <?php foreach ($taches as $tache) : ?>
                                            <tr>
                                                <td><?= htmlspecialchars($tache['titre']) ?></td>
                                                <td><?= htmlspecialchars($tache['stagiaire_nom'] . ' ' . $tache['stagiaire_prenom']) ?></td>
                                                <td>
                                                    <span class="badge rounded-pill <?= $tache['statut'] === 'terminée' ? 'bg-success' : ($tache['statut'] === 'en cours' ? 'bg-warning' : 'bg-secondary') ?>">
                                                        <?= htmlspecialchars($tache['statut']) ?>
                                                    </span>
                                                </td>
                                                <td><?= htmlspecialchars($tache['nouveau_pourcentage']) ?></td>
                                                <td><?= htmlspecialchars($tache['date_limite']) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-header d-flex align-items-center">
                        <i class="bi bi-person-plus me-2"></i> Assigner une Tâche
                    </div>
                    <div class="card-body">
                        <form method="post" action="assigner_tache">
                            <div class="mb-3">
                                <label for="tacheId" class="form-label">Tâche:</label>
                                <select class="form-select" id="tacheId" name="tacheId" required>
                                    <?php foreach ($taches as $tache) : ?>
                                        <option value="<?= $tache['id'] ?>"><?= htmlspecialchars($tache['titre']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="stagiaireId" class="form-label">Stagiaire:</label>
                                <select class="form-select" id="stagiaireId" name="stagiaireId" required>
                                    <?php foreach ($stagiaires as $stagiaire) : ?>
                                        <option value="<?= $stagiaire['id'] ?>"><?= htmlspecialchars($stagiaire['nom'] . ' ' . $stagiaire['prenom']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Assigner</button>
                        </form>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
