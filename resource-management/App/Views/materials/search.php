<div class="container mt-5">
        <h2>Rechercher des matériels</h2>
        <form action="/materials/search" method="get">
            <div class="mb-3">
                <label for="search" class="form-label">Rechercher</label>
                <input type="text" class="form-control" id="search" name="search" placeholder="Nom ou modèle">
            </div>
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>
        <?php if (!empty($results)): ?>
            <table class="table table-bordered mt-3">
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
                    <?php foreach ($results as $material): ?>
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
        <?php endif; ?>
    </div>
