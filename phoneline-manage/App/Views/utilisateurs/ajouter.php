<?php include 'views/layout/template.php'; ?>

<?php ob_start(); ?>
<h2>Ajouter un utilisateur</h2>
<form method="post">
    <div class="form-group">
        <label for="nom">Nom:</label>
        <input type="text" name="nom" id="nom" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="mot_de_passe">Mot de passe:</label>
        <input type="password" name="mot_de_passe" id="mot_de_passe" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="role">Rôle:</label>
        <select name="role" id="role" class="form-control">
            <option value="classic">Classic</option>
            <option value="admin">Admin</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>
<?php $content = ob_get_clean(); ?>