
<h2>Modifier un utilisateur</h2>

<?php if (isset($errors) && !empty($errors)): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="post" action="/user/update/<?=$user['id']?>">
    <div class="form-group">
        <label for="nom">Nom:</label>
        <input type="text" name="nom" id="nom" class="form-control" value="<?php echo htmlspecialchars($user['nom']); ?>" required>
    </div>
    <div class="form-group">
        <label for="prenom">Prénom:</label>
        <input type="text" name="prenom" id="prenom" class="form-control" value="<?php echo htmlspecialchars($user['prenom']); ?>" required>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
    </div>
    <div class="form-group">
        <label for="mot_de_passe">Mot de passe (laissez vide pour ne pas changer):</label>
        <input type="password" name="mot_de_passe" id="mot_de_passe" class="form-control">
    </div>
    <div class="form-group">
        <label for="role">Rôle:</label>
        <select name="role" id="role" class="form-control">
            <option value="classic" <?php if ($user['role'] === 'classic') echo 'selected'; ?>>Classic</option>
            <option value="admin" <?php if ($user['role'] === 'admin') echo 'selected'; ?>>Admin</option>
        </select>
    </div>
    <div class="form-group">
        <label for="statut">Statut:</label>
        <select name="statut" id="statut" class="form-control">
            <option value="actif" <?php if ($user['statut'] === 'actif') echo 'selected'; ?>>Actif</option>
            <option value="inactif" <?php if ($user['statut'] === 'inactif') echo 'selected'; ?>>Inactif</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Modifier</button>
</form>
