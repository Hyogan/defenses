<div class="container mt-5">
        <h2>Filtrer les affectations</h2>
        <form action="/affectations/filter" method="get">
            <div class="mb-3">
                <label for="id_materiel" class="form-label">Matériel</label>
                <select class="form-select" id="id_materiel" name="id_materiel">
                    <option value="">Tous les matériels</option>
                    <?php foreach ($materials as $material): ?>
                        <option value="<?= $material['id_materiel'] ?>"><?= $material['nom'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_laboratoire" class="form-label">Laboratoire</label>
                <select class="form-select" id="id_laboratoire" name="id_laboratoire">
                    <option value="">Tous les laboratoires</option>
                    <?php foreach ($laboratories as $laboratory): ?>
                        <option value="<?= $laboratory['id_laboratoire'] ?>"><?= $laboratory['nom'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_service" class="form-label">Service</label>
                <select class="form-select" id="id_service" name="id_service">
                    <option value="">Tous les services</option>
                    <?php foreach ($services as $service): ?>
                        <option value="<?= $service['id_service'] ?>"><?= $service['nom'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Filtrer</button>
        </form>
        <?php if (!empty($results)): ?>
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Matériel</th>
                        <th>Laboratoire</th>
                        <th>Service</th>
                        <th>Date d'affectation</th>
                        <th>Date de fin d'affectation</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $affectation): ?>
                        <tr>
                            <td><?= $affectation['id_affectation'] ?></td>
                            <td><?= $affectation['id_materiel'] ?></td>
                            <td><?= $affectation['id_laboratoire'] ?></td>
                            <td><?= $affectation['id_service'] ?></td>
                            <td><?= $affectation['date_affectation'] ?></td>
                            <td><?= $affectation['date_fin_affectation'] ?></td>
                            <td>
                                <a href="/affectations/edit/<?= $affectation['id_affectation'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                                <a href="/affectations/delete/<?= $affectation['id_affectation'] ?>" class="btn btn-sm btn-danger">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
