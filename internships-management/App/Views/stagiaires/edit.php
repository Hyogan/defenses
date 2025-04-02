<div class="container mt-5">
    <h2>Modifier un Stagiaire</h2>
    <?php if (isset($errors['general'])) : ?>
        <div class="alert alert-danger"><?= $errors['general'] ?></div>
    <?php endif; ?>
    <form action="/stagiaire/update/<?= $data['id'] ?>" method="post">
        <div class="form-group">
            <label for="nom">Nom:</label>
            <input type="text" class="form-control <?= isset($errors['nom']) ? 'is-invalid' : '' ?>" id="nom" name="nom" value="<?= isset($data['nom']) ? $data['nom'] : '' ?>" required>
            <?php if (isset($errors['nom'])) : ?>
                <div class="invalid-feedback"><?= $errors['nom'] ?></div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="prenom">Prénom:</label>
            <input type="text" class="form-control <?= isset($errors['prenom']) ? 'is-invalid' : '' ?>" id="prenom" name="prenom" value="<?= isset($data['prenom']) ? $data['prenom'] : '' ?>" required>
            <?php if (isset($errors['prenom'])) : ?>
                <div class="invalid-feedback"><?= $errors['prenom'] ?></div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= isset($data['email']) ? $data['email'] : '' ?>" required>
            <?php if (isset($errors['email'])) : ?>
                <div class="invalid-feedback"><?= $errors['email'] ?></div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="formation">Formation:</label>
            <input type="text" class="form-control <?= isset($errors['formation']) ? 'is-invalid' : '' ?>" id="formation" name="formation" value="<?= isset($data['formation']) ? $data['formation'] : '' ?>" required>
            <?php if (isset($errors['formation'])) : ?>
                <div class="invalid-feedback"><?= $errors['formation'] ?></div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="date_debut">Date de début:</label>
            <input type="date" class="form-control <?= isset($errors['date_debut']) ? 'is-invalid' : '' ?>" id="date_debut" name="date_debut" value="<?= isset($data['date_debut']) ? $data['date_debut'] : '' ?>" required>
            <?php if (isset($errors['date_debut'])) : ?>
                <div class="invalid-feedback"><?= $errors['date_debut'] ?></div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="date_fin">Date de fin:</label>
            <input type="date" class="form-control <?= isset($errors['date_fin']) ? 'is-invalid' : '' ?>" id="date_fin" name="date_fin" value="<?= isset($data['date_fin']) ? $data['date_fin'] : '' ?>" required>
            <?php if (isset($errors['date_fin'])) : ?>
                <div class="invalid-feedback"><?= $errors['date_fin'] ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="date_fin">Date de fin:</label>
            <select class="form-control id="statut" name="statut" value="<?= isset($data['statut']) ? $data['statut'] : '' ?>" required>
                  <option value="active">Actif</option>
                  <option value="inactive">Inactif</option>
            </select>
            <?php if (isset($errors['statut'])) : ?>
                <div class="invalid-feedback"><?= $errors['statut'] ?></div>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
