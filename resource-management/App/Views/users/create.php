<div class="container mt-5">
        <h2>Créer un utilisateur</h2>
        <form action="/users/store" method="post">
            <div class="mb-3">
                <label for="nom_complet" class="form-label">Nom complet</label>
                <input type="text" class="form-control" id="nom_complet" name="nom_complet" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="mot_de_passe" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Rôle</label>
                <select class="form-select" id="role" name="role" required>
                    <option value="technicien">Technicien</option>
                    <option value="responsable_laboratoire">responsable Laboratoire</option>
                    <option value="utilisateur">utilisateur classique</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Service</label>
                <select class="form-select" id="id_service" name="id_service" required>
                    <?php foreach ($services as $service): ?>
                        <option value="<?= $service['id_service'] ?>"><?= $service['nom'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Créer</button>
            <a href="/users" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
