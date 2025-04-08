<div class="container mt-5">
        <h2>Modifier un utilisateur</h2>
        <form action="/users/update/<?= $user['id_utilisateur'] ?>" method="post">
            <div class="mb-3">
                <label for="nom_complet" class="form-label">Nom complet</label>
                <input type="text" class="form-control" id="nom_complet" name="nom_complet" value="<?= $user['nom_complet'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="mot_de_passe" class="form-label">Mot de passe (laisser vide pour ne pas changer)</label>
                <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe">
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Rôle</label>
                <select class="form-select" id="role" name="role" required>
                    <option value="technicien" <?= $user['role'] === 'technicien' ? 'selected' : '' ?>>Technicien</option>
                    <option value="classic" <?= $user['role'] === 'classic' ? 'selected' : '' ?>>Classic</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="/users" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
