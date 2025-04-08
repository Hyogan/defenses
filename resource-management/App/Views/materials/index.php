<div class="container mt-5">
        <h2>Liste des matériels</h2>
        <a href="/materials/create" class="btn btn-primary mb-3">Ajouter un matériel</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Modèle</th>
                    <th>Catégorie</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($materials as $material): ?>
                    <tr>
                        <td><?= $material['id_materiel'] ?></td>
                        <td><?= $material['nom'] ?></td>
                        <td><?= $material['description'] ?></td>
                        <td><?= $material['model'] ?></td>
                        <td><?= $material['id_categorie'] ?></td>
                        <td>
                            <a href="/materials/edit/<?= $material['id_materiel'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                            <a href="/materials/delete/<?= $material['id_materiel'] ?>" class="btn btn-sm btn-danger">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
