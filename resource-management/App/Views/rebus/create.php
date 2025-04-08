<div class="container mt-5">
        <h2>Créer un matériel mis au rebut</h2>
        <form action="/rebus/store" method="post">
            <div class="mb-3">
                <label for="reference" class="form-label">Référence</label>
                <input type="text" class="form-control" id="reference" name="reference" required>
            </div>
            <div class="mb-3">
                <label for="id_materiel" class="form-label">Matériel</label>
                <select class="form-select" id="id_materiel" name="id_materiel" required>
                    <?php foreach ($materials as $material): ?>
                        <option value="<?= $material['id_materiel'] ?>"><?= $material['nom'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="panne" class="form-label">Panne</label>
                <input type="text" class="form-control" id="panne" name="panne" required>
            </div>
            <div class="mb-3">
                <label for="description_panne" class="form-label">Description de la panne</label>
                <textarea class="form-control" id="description_panne" name="description_panne"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Créer</button>
            <a href="/rebus" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
