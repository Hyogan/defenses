<div class="container my-4">
<a href="/demandes_changement/create" class="btn btn-success">Ajouter une demande</a>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Liste des Demandes de Changement</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Materiel</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Description</th>
                            <th scope="col">Modèle</th>
                            <th scope="col">Raison</th>
                            <th scope="col">Catégorie</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($demandes as $demande): ?>
                            <tr>
                                <td><?= $demande['id_demande'] ?></td>
                                <td><?= $demande['nom_materiel_actuel'] ?></td>
                                <td><?= $demande['nom'] ?></td>
                                <td><?= $demande['description'] ?></td>
                                <td><?= $demande['model'] ?></td>
                                <td><?= $demande['raison'] ?></td>
                                <td><?= $demande['id_categorie'] ?></td>
                                <td>
                                    <a href="/demandes_changement/edit/<?= $demande['id_demande'] ?>" class="btn btn-sm btn-warning me-1">
                                        <i class="bi bi-pencil-square"></i> Modifier
                                    </a>
                                    <a href="/demandes_changement/delete/<?= $demande['id_demande'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette demande ?');">
                                        <i class="bi bi-trash"></i> Supprimer
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
