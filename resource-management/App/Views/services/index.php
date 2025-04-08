<div class="container mt-5">
        <h2>Liste des services</h2>
        <a href="/services/create" class="btn btn-primary mb-3">Ajouter un service</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Localisation</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($services as $service): ?>
                    <tr>
                        <td><?= $service['id_service'] ?></td>
                        <td><?= $service['nom'] ?></td>
                        <td><?= $service['localisation'] ?></td>
                        <td><?= $service['description'] ?></td>
                        <td>
                            <a href="/services/edit/<?= $service['id_service'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                            <a href="/services/delete/<?= $service['id_service'] ?>" class="btn btn-sm btn-danger">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
