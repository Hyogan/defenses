<div class="container mt-5">
        <h2>Modifier une catégorie</h2>
        <form action="/categories/update/<?= $category['id_categorie'] ?>" method="post">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?= $category['nom'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description"><?= $category['description'] ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="/categories" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
