<div class="container mt-5">
        <h2>Créer une affectation</h2>
        <form action="/affectations/store" method="post">
            <div class="mb-3">
                <label for="id_materiel" class="form-label">Matériel</label>
                <select class="form-select" id="id_materiel" name="id_materiel" required>
                    <?php foreach ($materials as $material): ?>
                        <option value="<?= $material['id_materiel'] ?>"><?= $material['nom'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_laboratoire" class="form-label">Laboratoire</label>
                <select class="form-select" id="id_laboratoire" name="id_laboratoire">
                    <option value="">Sélectionner un laboratoire (optionnel)</option>
                    <?php foreach ($laboratories as $laboratory): ?>
                        <option value="<?= $laboratory['id_laboratoire'] ?>"><?= $laboratory['nom'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_service" class="form-label">Service</label>
                <select class="form-select" id="id_service" name="id_service">
                    <option value="">Sélectionner un service (optionnel)</option>
                    <?php foreach ($services as $service): ?>
                        <option value="<?= $service['id_service'] ?>"><?= $service['nom'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="date_fin_affectation" class="form-label">Date de fin d'affectation</label>
                <input type="date" class="form-control" id="date_fin_affectation" name="date_fin_affectation">
            </div>
            <button type="submit" class="btn btn-primary">Créer</button>
            <a href="/affectations" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
