<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Liste des Fournisseurs</h6>
            <a href="/suppliers/create" class="btn text-white bgx-primary">
                <i class="fas fa-plus"></i> Ajouter un fournisseur
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="suppliers-table" class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Téléphone</th>
                            <th>Email</th>
                            <th>Statut</th>
                            <th>Date de création</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($suppliers as $supplier): ?>
                        <tr>
                            <td><?= $supplier['id'] ?></td>
                            <td><?= htmlspecialchars($supplier['nom']) ?></td>
                            <td><?= htmlspecialchars($supplier['telephone'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($supplier['email'] ?? '-') ?></td>
                            <td>
                                <span class="badge bg-<?= $supplier['statut'] === 'actif' ? 'success' : 'danger' ?>">
                                    <?= ucfirst($supplier['statut']) ?>
                                </span>
                            </td>
                            <td><?= date('d/m/Y', strtotime($supplier['date_creation'])) ?></td>
                            <td>
                                <div class="btn-group">
                                    <a href="/suppliers/show/<?= $supplier['id'] ?>" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="/suppliers/edit/<?= $supplier['id'] ?>" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="/suppliers/change-status/<?= $supplier['id'] ?>" class="btn btn-<?= $supplier['statut'] === 'actif' ? 'danger' : 'success' ?> btn-sm">
                                        <i class="fas fa-<?= $supplier['statut'] === 'actif' ? 'times' : 'check'?>"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm delete-btn" data-toggle="modal" data-target="#deleteModal" data-id="<?= $supplier['id'] ?>" data-name="<?= htmlspecialchars($supplier['nom']) ?>">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
