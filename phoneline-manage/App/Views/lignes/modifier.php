<?php include 'views/layout/template.php'; ?>

<?php ob_start(); ?>
<h2>Modifier une ligne</h2>
<form method="post">
    <div class="form-group">
        <label for="type_ligne">Type de ligne:</label>
        <input type="text" name="type_ligne" id="type_ligne" class="form-control" value="<?php echo $ligne->type_ligne; ?>" required>
    </div>
    <div class="form-group">
        <label for="numero_ligne">Numéro de ligne:</label>
        <input type="text" name="numero_ligne" id="numero_ligne" class="form-control" value="<?php echo $ligne->numero_ligne; ?>" required>
    </div>
    <div class="form-group">
        <label for="marque_poste">Marque du poste:</label>
        <input type="text" name="marque_poste" id="marque_poste" class="form-control" value="<?php echo $ligne->marque_poste; ?>">
    </div>
    <div class="form-group">
        <label for="nom_proprietaire">Nom du propriétaire:</label>
        <input type="text" name="nom_proprietaire" id="nom_proprietaire" class="form-control" value="<?php echo $ligne->nom_proprietaire; ?>">
    </div>
    <div class="form-group">
        <label for="numero_port">Numéro de port:</label>
        <input type="text" name="numero_port" id="numero_port" class="form-control" value="<?php echo $ligne->numero_port; ?>">
    </div>
    <div class="form-group">
        <label for="numero_bandeau">Numéro du bandeau:</label>
        <input type="text" name="numero_bandeau" id="numero_bandeau" class="form-control" value="<?php echo $ligne->numero_bandeau; ?>">
    </div>
    <div class="form-group">
        <label for="numero_fusible">Numéro du fusible:</label>
        <input type="text" name="numero_fusible" id="numero_fusible" class="form-control" value="<?php echo $ligne->numero_fusible; ?>">
    </div>
    <div class="form-group">
        <label for="numero_jarretiere">Numéro de la jarretière:</label>
        <input type="text" name="numero_jarretiere" id="numero_jarretiere" class="form-control" value="<?php echo $ligne->numero_jarretiere; ?>">
    </div>
    <button type="submit" class="btn btn-primary">Modifier</button>
</form>
<?php $content = ob_get_clean(); ?>