<div class="container mt-5">
        <h2>Liste des catégories</h2>
        <a href="/categories/create" class="btn btn-primary mb-3">Ajouter une catégorie</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category): ?>
                    <tr>
                        <td><?= $category['id_categorie'] ?></td>
                        <td><?= $category['nom'] ?></td>
                        <td><?= $category['description'] ?></td>
                        <td>
                            <a href="/categories/edit/<?= $category['id_categorie'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                            <a href="/categories/delete/<?= $category['id_categorie'] ?>" class="btn btn-sm btn-danger">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
