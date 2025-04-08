<div class="container mt-5">
        <h2>Liste des matériels mis au rebut</h2>
        <a href="/rebus/create" class="btn btn-primary mb-3">Ajouter un matériel mis au rebut</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Référence</th>
                    <th>Matériel</th>
                    <th>Panne</th>
                    <th>Description de la panne</th>
                    <th>Date de mise au rebut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rebus as $rebu): ?>
                    <tr>
                        <td><?= $rebu['id_rebus'] ?></td>
                        <td><?= $rebu['reference'] ?></td>
                        <td><?= $rebu['id_materiel'] ?></td>
                        <td><?= $rebu['panne'] ?></td>
                        <td><?= $rebu['description_panne'] ?></td>
                        <td><?= $rebu['date_mise_au_rebut'] ?></td>
                        <td>
                            <a href="/rebus/edit/<?= $rebu['id_rebus'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                            <a href="/rebus/delete/<?= $rebu['id_rebus'] ?>" class="btn btn-sm btn-danger">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
