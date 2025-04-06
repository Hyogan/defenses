<div class="container mt-5">
        <h2>Détails de la ligne</h2>
        
        <table class="table">
            <tbody>
                <tr>
                    <th>ID</th>
                    <td><?php echo $ligne['id']; ?></td>
                </tr>
                <tr>
                    <th>Type de ligne</th>
                    <td><?php echo $ligne['type_ligne']; ?></td>
                </tr>
                <tr>
                    <th>Numéro de ligne</th>
                    <td><?php echo $ligne['numero_ligne']; ?></td>
                </tr>
                <tr>
                    <th>Marque du poste</th>
                    <td><?php echo $ligne['marque_poste']; ?></td>
                </tr>
                <tr>
                    <th>Nom du propriétaire</th>
                    <td><?php echo $ligne['nom_proprietaire']; ?></td>
                </tr>
                <tr>
                    <th>Numéro de port</th>
                    <td><?php echo $ligne['numero_port']; ?></td>
                </tr>
                <tr>
                    <th>Numéro de bandeau</th>
                    <td><?php echo $ligne['numero_bandeau']; ?></td>
                </tr>
                <tr>
                    <th>Numéro de fusible</th>
                    <td><?php echo $ligne['numero_fusible']; ?></td>
                </tr>
                <tr>
                    <th>Numéro de jarretière</th>
                    <td><?php echo $ligne['numero_jarretiere']; ?></td>
                </tr>
            </tbody>
        </table>

        <div class="mt-4">
            <a href="/lignes/modifier/<?php echo $ligne['id']; ?>" class="btn btn-warning">Modifier</a>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Supprimer</button>
            <a href="/ligne/export/<?= $ligne['id']?>" class="btn btn-info">Exporter la ligne</a>
            <a href="/lignes" class="btn btn-secondary">Retour à la liste</a>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmation de suppression</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer cette ligne ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <a href="/lignes/supprimer/<?php echo $ligne['id']; ?>" class="btn btn-danger">Supprimer</a>
                </div>
            </div>
        </div>
    </div>
