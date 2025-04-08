<div class="container mt-5">
        <h2>Liste des affectations</h2>
        <a href="/affectations/create" class="btn btn-primary mb-3">Ajouter une affectation</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Matériel</th>
                    <th>Laboratoire</th>
                    <th>Service</th>
                    <th>Date d'affectation</th>
                    <th>Date de fin d'affectation</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($affectations as $affectation): ?>
                    <tr>
                        <td><?= $affectation['id_affectation'] ?></td>
                        <td><?= $affectation['id_materiel'] ?></td>
                        <td><?= $affectation['id_laboratoire'] ?></td>
                        <td><?= $affectation['id_service'] ?></td>
                        <td><?= $affectation['date_affectation'] ?></td>
                        <td><?= $affectation['date_fin_affectation'] ?></td>
                        <td>
                            <a href="/affectations/edit/<?= $affectation['id_affectation'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                            <a href="/affectations/delete/<?= $affectation['id_affectation'] ?>" class="btn btn-sm btn-danger">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
