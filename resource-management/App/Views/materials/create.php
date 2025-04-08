<div class="container mt-5">
        <h2>Créer un matériel</h2>
        <form action="/materials/store" method="post">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <div class="mb-3">
                <label for="model" class="form-label">Modèle</label>
                <input type="text" class="form-control" id="model" name="model" required>
            </div>
            <div class="mb-3">
                <label for="id_categorie" class="form-label">Catégorie</label>
                <select class="form-select" id="id_categorie" name="id_categorie" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id_categorie'] ?>"><?= $category['nom'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Créer</button>
            <a href="/materials" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
