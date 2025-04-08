<div class="container mt-5">
        <h2>Créer une catégorie</h2>
        <form action="/categories/store" method="post">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Créer</button>
            <a href="/categories" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
