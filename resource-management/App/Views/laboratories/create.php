<div class="container mt-5">
        <h2>Créer un laboratoire</h2>
        <form action="/laboratories/store" method="post">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="mb-3">
                <label for="numero" class="form-label">Numéro</label>
                <input type="text" class="form-control" id="numero" name="numero" required>
            </div>
            <div class="mb-3">
                <label for="localisation" class="form-label">Localisation</label>
                <input type="text" class="form-control" id="localisation" name="localisation" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Créer</button>
            <a href="/laboratories" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
