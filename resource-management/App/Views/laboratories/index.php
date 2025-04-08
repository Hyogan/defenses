<div class="container mt-5">
        <h2>Liste des laboratoires</h2>
        <a href="/laboratories/create" class="btn btn-primary mb-3">Ajouter un laboratoire</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Numéro</th>
                    <th>Localisation</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($laboratories as $laboratory): ?>
                    <tr>
                        <td><?= $laboratory['id_laboratoire'] ?></td>
                        <td><?= $laboratory['nom'] ?></td>
                        <td><?= $laboratory['numero'] ?></td>
                        <td><?= $laboratory['localisation'] ?></td>
                        <td><?= $laboratory['description'] ?></td>
                        <td>
                            <a href="/laboratories/edit/<?= $laboratory['id_laboratoire'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                            <a href="/laboratories/delete/<?= $laboratory['id_laboratoire'] ?>" class="btn btn-sm btn-danger">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
