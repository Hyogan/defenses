<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Assigner des tuteurs à <?= htmlspecialchars($stagiaire[0]['nom'] . ' ' . $stagiaire[0]['prenom']) ?></h4>
                </div>
                <div class="card-body">
                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success">
                            <?= $_SESSION['success'] ?>
                            <?php unset($_SESSION['success']); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger">
                            <?= $_SESSION['error'] ?>
                            <?php unset($_SESSION['error']); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5 class="card-title mb-0">Informations du stagiaire</h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>Nom:</strong> <?= htmlspecialchars($stagiaire[0]['nom']) ?></p>
                                    <p><strong>Prénom:</strong> <?= htmlspecialchars($stagiaire[0]['prenom']) ?></p>
                                    <p><strong>Email:</strong> <?= htmlspecialchars($stagiaire[0]['email']) ?></p>
                                    <p><strong>Formation:</strong> <?= htmlspecialchars($stagiaire[0]['formation']) ?></p>
                                    <p><strong>Période:</strong> Du <?= htmlspecialchars(date('d/m/Y', strtotime($stagiaire[0]['date_debut']))) ?> 
                                        au <?= htmlspecialchars(date('d/m/Y', strtotime($stagiaire[0]['date_fin']))) ?></p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5 class="card-title mb-0">Tuteurs actuellement assignés</h5>
                                </div>
                                <div class="card-body">
                                    <?php if (empty($assignedTuteurs)): ?>
                                        <p class="text-muted">Aucun tuteur assigné pour le moment.</p>
                                    <?php else: ?>
                                        <ul class="list-group">
                                            <?php foreach ($assignedTuteurs as $tuteur): ?>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <strong><?= htmlspecialchars($tuteur['nom'] . ' ' . $tuteur['prenom']) ?></strong>
                                                        <br>
                                                        <small><?= htmlspecialchars($tuteur['departement'] . ' - ' . $tuteur['poste']) ?></small>
                                                    </div>
                                                    <a href="/stagiaires/remove-tuteur/<?= $stagiaire[0]['id'] ?>/<?= $tuteur['id'] ?>" 
                                                       class="btn btn-sm btn-danger" 
                                                       onclick="return confirm('Êtes-vous sûr de vouloir retirer ce tuteur?')">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <form action="/stagiaire/process-assign-tuteurs/<?= $stagiaire[0]['id'] ?>" method="POST">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0">Sélectionner des tuteurs</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" name="replace_existing" value="1" id="replace_existing">
                                    <label class="form-check-label" for="replace_existing">
                                        Remplacer les assignations existantes
                                    </label>
                                    <small class="form-text text-muted">
                                        Si coché, tous les tuteurs actuellement assignés seront remplacés par cette nouvelle sélection.
                                    </small>
                                </div>
                                
                                <div class="row">
                                    <?php foreach ($tuteurs as $tuteur): ?>
                                        <div class="col-md-6 col-lg-4 mb-3">
                                            <div class="card h-100">
                                                <div class="card-body">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" 
                                                               name="tuteur_ids[]" 
                                                               value="<?= $tuteur['id'] ?>" 
                                                               id="tuteur_<?= $tuteur['id'] ?>"
                                                               <?= in_array($tuteur['id'], $assignedTuteurIds) ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="tuteur_<?= $tuteur['id'] ?>">
                                                            <strong><?= htmlspecialchars($tuteur['nom'] . ' ' . $tuteur['prenom']) ?></strong>
                                                        </label>
                                                    </div>
                                                    <div class="mt-2 ps-4">
                                                        <p class="mb-1"><i class="fas fa-building me-2"></i> <?= htmlspecialchars($tuteur['departement']) ?></p>
                                                        <p class="mb-1"><i class="fas fa-briefcase me-2"></i> <?= htmlspecialchars($tuteur['poste']) ?></p>
                                                        <p class="mb-0"><i class="fas fa-envelope me-2"></i> <?= htmlspecialchars($tuteur['email']) ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Enregistrer les assignations</button>
                                <a href="/dashboard/stagiaires" class="btn btn-secondary">Retour à la liste</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</qodoArtifact>
