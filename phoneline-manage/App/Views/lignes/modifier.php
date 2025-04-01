<div class="container mt-5">
        <h2>Modifier une ligne</h2>
        <form action="/lignes/update/<?php echo $ligne['id']; ?>" method="post">
            <div class="form-group">
                <label for="type_ligne">Type de ligne</label>
                <input type="text" class="form-control" id="type_ligne" name="type_ligne" value="<?php echo $ligne['type_ligne']; ?>" required>
            </div>
            <div class="form-group">
                <label for="numero_ligne">Numéro de ligne</label>
                <input type="text" class="form-control" id="numero_ligne" name="numero_ligne" value="<?php echo $ligne['numero_ligne']; ?>" required>
            </div>
            <div class="form-group">
                <label for="marque_poste">Marque du poste</label>
                <input type="text" class="form-control" id="marque_poste" name="marque_poste" value="<?php echo $ligne['marque_poste']; ?>" required>
            </div>
            <div class="form-group">
                <label for="nom_proprietaire">Nom du propriétaire</label>
                <input type="text" class="form-control" id="nom_proprietaire" name="nom_proprietaire" value="<?php echo $ligne['nom_proprietaire']; ?>" required>
            </div>
            <div class="form-group">
                <label for="numero_port">Numéro de port</label>
                <input type="text" class="form-control" id="numero_port" name="numero_port" value="<?php echo $ligne['numero_port']; ?>" required>
            </div>
            <div class="form-group">
                <label for="numero_bandeau">Numéro de bandeau</label>
                <input type="text" class="form-control" id="numero_bandeau" name="numero_bandeau" value="<?php echo $ligne['numero_bandeau']; ?>" required>
            </div>
            <div class="form-group">
                <label for="numero_fusible">Numéro de fusible</label>
                <input type="text" class="form-control" id="numero_fusible" name="numero_fusible" value="<?php echo $ligne['numero_fusible']; ?>" required>
            </div>
            <div class="form-group">
                <label for="numero_jarretiere">Numéro de jarretière</label>
                <input type="text" class="form-control" id="numero_jarretiere" name="numero_jarretiere" value="<?php echo $ligne['numero_jarretiere']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
            <a href="/lignes/details/<?php echo $ligne['id']; ?>" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
