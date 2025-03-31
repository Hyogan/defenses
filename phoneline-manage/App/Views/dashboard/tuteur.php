<style>
        .card-header {
            background-color: #f8f9fa; /* Light gray background for headers */
            border-bottom: 1px solid #dee2e6;
        }
        .list-group-item {
          display: flex;
          justify-content: space-between;
          align-items: center;
        }
    </style>
     <div class="container mt-4">
        <h1 class="mb-4">Tableau de Bord du Tuteur</h1>

        <div class="row">
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex align-items-center">
                        <i class="bi bi-check-square me-2"></i> Tâches Assignées
                    </div>
                    <div class="card-body">
                        <?php if (empty($taches)) : ?>
                            <p class="text-muted">Aucune tâche assignée.</p>
                        <?php else : ?>
                            <ul class="list-group list-group-flush">
                                <?php foreach ($taches as $tache) : ?>
                                    <li class="list-group-item">
                                        <span><?= htmlspecialchars($tache['titre']) ?></span>
                                        <span class="badge rounded-pill <?= $tache['statut'] === 'terminée' ? 'bg-success' : ($tache['statut'] === 'en cours' ? 'bg-warning' : 'bg-secondary') ?>">
                                            <?= htmlspecialchars($tache['statut']) ?>
                                        </span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex align-items-center">
                        <i class="bi bi-people me-2"></i> Stagiaires Supervisés
                    </div>
                    <div class="card-body">
                        <?php if (empty($stagiaires)) : ?>
                            <p class="text-muted">Aucun stagiaire supervisé.</p>
                        <?php else : ?>
                            <ul class="list-group list-group-flush">
                                <?php foreach ($stagiaires as $stagiaire) : ?>
                                    <li class="list-group-item">
                                        <?= htmlspecialchars($stagiaire['nom'] . ' ' . $stagiaire['prenom']) ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex align-items-center">
                        <i class="bi bi-clipboard-data me-2"></i> Évaluations
                    </div>
                    <div class="card-body">
                        <?php if (empty($evaluations)) : ?>
                            <p class="text-muted">Aucune évaluation disponible.</p>
                        <?php else : ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Stagiaire</th>
                                            <th>Note</th>
                                            <th>Commentaires</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($evaluations as $evaluation) : ?>
                                            <tr>
                                                <td><?= htmlspecialchars($evaluation['stagiaire_nom'] . ' ' . $evaluation['stagiaire_prenom']) ?></td>
                                                <td><?= htmlspecialchars($evaluation['note']) ?></td>
                                                <td><?= htmlspecialchars($evaluation['commentaires']) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
