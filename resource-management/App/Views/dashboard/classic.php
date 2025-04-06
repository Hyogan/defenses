<div class="container mt-5">
        <h2>Tableau de bord utilisateur classique</h2>

        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Nombre d'utilisateurs</h5>
                        <p class="card-text"><?php echo $userCount; ?></p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Nombre de lignes</h5>
                        <p class="card-text"><?php echo $lignesCount; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <h3>Lignes récentes</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Type de ligne</th>
                    <th>Numéro de ligne</th>
                    <th>Propriétaire</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($lignesRecentes)): ?>
                    <?php foreach ($lignesRecentes as $ligne): ?>
                        <tr>
                            <td><?php echo $ligne['id']; ?></td>
                            <td><?php echo $ligne['type_ligne']; ?></td>
                            <td><?php echo $ligne['numero_ligne']; ?></td>
                            <td><?php echo $ligne['nom_proprietaire']; ?></td>
                            <td>
                                <a href="/lignes/details/<?php echo $ligne['id']; ?>" class="btn btn-info btn-sm">Détails</a>
                                <a href="/lignes/modifier/<?php echo $ligne['id']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?php echo $ligne['id']; ?>">Supprimer</button>

                                <div class="modal fade" id="deleteModal<?php echo $ligne['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?php echo $ligne['id']; ?>" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel<?php echo $ligne['id']; ?>">Confirmation de suppression</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Êtes-vous sûr de vouloir supprimer la ligne <?php echo $ligne['numero_ligne']; ?> ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                <a href="/lignes/supprimer/<?php echo $ligne['id']; ?>" class="btn btn-danger">Supprimer</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">Aucune ligne récente trouvée.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
