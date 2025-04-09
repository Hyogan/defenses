<div class="container my-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Modifier la Demande de Changement</h5>
        </div>
        <div class="card-body">
            <form action="/demandes_changement/update/<?= $demande['id_demande'] ?>" method="post">
                <div class="mb-3">
                    <label for="id_materiel" class="form-label">Matériel</label>
                    <select name="id_materiel" id="id_materiel" class="form-select" required>
                        <?php foreach ($materials as $material): ?>
                            <option value="<?= $material['id_materiel'] ?>" <?= $demande['id_materiel'] === $material['id_materiel'] ? 'selected' : '' ?>>
                                <?= $material['nom'] ?> (<?= $material['model'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" name="nom" id="nom" class="form-control" value="<?= $demande['nom'] ?>" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="3"><?= $demande['description'] ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="model" class="form-label">Modèle</label>
                    <input type="text" name="model" id="model" class="form-control" value="<?= $demande['model'] ?>">
                </div>

                <div class="mb-3">
                    <label for="raison" class="form-label">Raison</label>
                    <input type="text" name="raison" id="raison" class="form-control" value="<?= $demande['raison'] ?>" required>
                </div>

                <div class="mb-3">
                    <label for="id_categorie" class="form-label">Catégorie</label>
                    <select name="id_categorie" id="id_categorie" class="form-select" required>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['id_categorie'] ?>" <?= $demande['id_categorie'] === $category['id_categorie'] ? 'selected' : '' ?>>
                                <?= $category['nom'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle"></i> Mettre à jour la demande
                </button>
            </form>
        </div>
    </div>
</div>
