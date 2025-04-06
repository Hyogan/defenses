<div class="container mt-4">
    <h1 class="mb-4"><?= $pageTitle ?? 'Liste des employés' ?></h1>

    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $_SESSION['error_message'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_SESSION['success_message'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    <div class="card mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0">Recherche</h5>
        </div>
        <div class="card-body">
            <form action="/employes/search" method="POST" class="row g-3">
                <div class="col-md-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" value="<?= $searchCriteria['nom'] ?? '' ?>">
                </div>
                <div class="col-md-3">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" value="<?= $searchCriteria['prenom'] ?? '' ?>">
                </div>
                <div class="col-md-3">
                    <label for="matricule" class="form-label">Matricule</label>
                    <input type="text" class="form-control" id="matricule" name="matricule" value="<?= $searchCriteria['matricule'] ?? '' ?>">
                </div>
                <div class="col-md-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= $searchCriteria['email'] ?? '' ?>">
                </div>
                <div class="col-md-3">
                    <label for="id_departement" class="form-label">Département</label>
                    <select class="form-select" id="id_departement" name="id_departement">
                        <option value="">Tous les départements</option>
                        <?php if (isset($departements) && is_array($departements)): ?>
                            <?php foreach ($departements as $departement): ?>
                                <option value="<?= $departement['id_departement'] ?>" <?= (isset($searchCriteria['id_departement']) && $searchCriteria['id_departement'] == $departement['id_departement']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($departement['nom_departement']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="id_poste" class="form-label">Poste</label>
                    <select class="form-select" id="id_poste" name="id_poste">
                        <option value="">Tous les postes</option>
                        <?php if (isset($postes) && is_array($postes)): ?>
                            <?php foreach ($postes as $poste): ?>
                                <option value="<?= $poste['id_poste'] ?>" <?= (isset($searchCriteria['id_poste']) && $searchCriteria['id_poste'] == $poste['id_poste']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($poste['titre_poste']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="statut" class="form-label">Statut</label>
                    <select class="form-select" id="statut" name="statut">
                        <option value="">Tous les statuts</option>
                        <option value="actif" <?= (isset($searchCriteria['statut']) && $searchCriteria['statut'] == 'actif') ? 'selected' : '' ?>>Actif</option>
                        <option value="inactif" <?= (isset($searchCriteria['statut']) && $searchCriteria['statut'] == 'inactif') ? 'selected' : '' ?>>Inactif</option>
                        <option value="conge" <?= (isset($searchCriteria['statut']) && $searchCriteria['statut'] == 'conge') ? 'selected' : '' ?>>En congé</option>
                        <option value="suspendu" <?= (isset($searchCriteria['statut']) && $searchCriteria['statut'] == 'suspendu') ? 'selected' : '' ?>>Suspendu</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">Rechercher</button>
                    <a href="/employes" class="btn btn-secondary">Réinitialiser</a>
                </div>
            </form>
        </div>
    </div>

    <div class="d-flex justify-content-between mb-3">
        <a href="/employes/create" class="btn btn-success">
            <i class="bi bi-plus-circle me-1"></i> Ajouter un employé
        </a>
        <div>
            <a href="/employes/export" class="btn btn-outline-primary">
                <i class="bi bi-download me-1"></i> Exporter
            </a>
            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#importModal">
                <i class="bi bi-upload me-1"></i> Importer
            </button>
        </div>
    </div>

    <?php if (empty($employes)): ?>
        <div class="alert alert-info">
            Aucun employé trouvé.
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Matricule</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Département</th>
                        <th>Poste</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($employes as $employe): ?>
                        <tr>
                            <td><?= htmlspecialchars($employe['matricule'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($employe['nom']) ?></td>
                            <td><?= htmlspecialchars($employe['prenom']) ?></td>
                            <td><?= htmlspecialchars($employe['nom_departement'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($employe['titre_poste'] ?? 'N/A') ?></td>
                            <td>
                                <?php
                                $statusClass = '';
                                $statusText = '';
                                switch ($employe['statut'] ?? 'actif') {
                                    case 'actif':
                                        $statusClass = 'bg-success';
                                        $statusText = 'Actif';
                                        break;
                                    case 'inactif':
                                        $statusClass = 'bg-secondary';
                                        $statusText = 'Inactif';
                                        break;
                                    case 'conge':
                                        $statusClass = 'bg-info';
                                        $statusText = 'En congé';
                                        break;
                                    case 'suspendu':
                                        $statusClass = 'bg-warning';
                                        $statusText = 'Suspendu';
                                        break;
                                    default:
                                        $statusClass = 'bg-secondary';
                                        $statusText = 'Inconnu';
                                }
                                ?>
                                <span class="badge <?= $statusClass ?>"><?= $statusText ?></span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="/employes/show/<?= $employe['id_employe'] ?>" class="btn btn-sm btn-info" title="Détails">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="/employes/edit/<?= $employe['id_employe'] ?>" class="btn btn-sm btn-warning" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="/employes/materiel/<?= $employe['id_employe'] ?>" class="btn btn-sm btn-primary" title="Matériel">
                                        <i class="bi bi-pc-display"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger" title="Supprimer" 
                                            data-bs-toggle="modal" data-bs-target="#deleteModal<?= $employe['id_employe'] ?>">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>

                                <!-- Modal de confirmation de suppression -->
                                <div class="modal fade" id="deleteModal<?= $employe['id_employe'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $employe['id_employe'] ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel<?= $employe['id_employe'] ?>">Confirmation de suppression</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Êtes-vous sûr de vouloir supprimer l'employé <strong><?= htmlspecialchars($employe['prenom'] . ' ' . $employe['nom']) ?></strong> ?
                                                <p class="text-danger mt-2">Cette action est irréversible.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                <a href="/employes/delete/<?= $employe['id_employe'] ?>" class="btn btn-danger">Supprimer</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination (si nécessaire) -->
        <?php if (isset($pagination) && $pagination['totalPages'] > 1): ?>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?= ($pagination['currentPage'] <= 1) ? 'disabled' : '' ?>">
                        <a class="page-link" href="/employes?page=<?= $pagination['currentPage'] - 1 ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    
                    <?php for ($i = 1; $i <= $pagination['totalPages']; $i++): ?>
                        <li class="page-item <?= ($pagination['currentPage'] == $i) ? 'active' : '' ?>">
                            <a class="page-link" href="/employes?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                    
                    <li class="page-item <?= ($pagination['currentPage'] >= $pagination['totalPages']) ? 'disabled' : '' ?>">
                        <a class="page-link" href="/employes?page=<?= $pagination['currentPage'] + 1 ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>
    <?php endif; ?>
</div>

<!-- Modal d'importation -->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Importer des employés</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/employes/import" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="importFile" class="form-label">Fichier CSV</label>
                        <input class="form-control" type="file" id="importFile" name="importFile" accept=".csv" required>
                    </div>
                    <div class="alert alert-info">
                        <small>
                            <i class="bi bi-info-circle me-1"></i> Le fichier CSV doit contenir les colonnes suivantes : nom, prenom, email, matricule, id_departement, id_poste, statut
                        </small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Importer</button>
                </div>
            </form>
        </div>
    </div>
</div>
