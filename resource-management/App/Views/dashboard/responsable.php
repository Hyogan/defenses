<div class="container mt-5">
    <h1 class="mb-4 text-center text-primary">Tableau de Bord du Responsable de Laboratoire</h1>

    <div class="row row-cols-1 row-cols-md-3 g-4 mb-4">
        <div class="col">
            <div class="card h-100 shadow">
                <div class="card-body text-center">
                    <h5 class="card-title text-primary">Utilisateurs</h5>
                    <p class="card-text"><i class="bi bi-people me-2"></i>Nombre total: <?= $userCount ?></p>
                    <a href="/users" class="btn btn-outline-primary">Gérer</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 shadow">
                <div class="card-body text-success text-center">
                    <h5 class="card-title text-success">Matériels</h5>
                    <p class="card-text"><i class="bi bi-pc-display me-2"></i>Nombre total: <?= $materialCount ?></p>
                    <a href="/materials" class="btn btn-outline-success">Gérer</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 shadow">
                <div class="card-body text-info text-center">
                    <h5 class="card-title text-info">Laboratoires</h5>
                    <p class="card-text"><i class="bi bi-activity me-2"></i><?= count($laboratoires) ?></p>
                    <a href="/laboratories" class="btn btn-outline-info">Gérer</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Utilisateurs -->
    <div class="card mb-4 shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Utilisateurs (Total: <?= $userCount ?>)</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Service</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($allUsers as $user): ?>
                        <tr>
                            <td><?= $user['nom_complet'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['role'] ?></td>
                            <td>
                                <?php
                                    foreach ($services as $service) {
                                        if ($service['id_service'] == $user['id_service']) {
                                            echo $service['nom'];
                                            break;
                                        }
                                    }
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Matériels -->
    <div class="card mb-4 shadow">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Matériels (Total: <?= $materialCount ?>)</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Nom</th>
                        <th>Modèle</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($materials as $material): ?>
                        <tr>
                            <td><?= $material['nom'] ?></td>
                            <td><?= $material['model'] ?></td>
                            <td><?= $material['description'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Demandes de Changement -->
    <div class="card mb-4 shadow">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0">Demandes de Changement</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nom materiel actuel</th>
                        <th>Matériel</th>
                        <th>Raison</th>
                        <th>Date de Demande</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($demandes as $demande): ?>
                        <tr>
                            <td><?= $demande['id_demande'] ?></td>
                            <td><?= $demande['nom_materiel_actuel'] ?></td>
                            <td><?= $demande['nom'] ?></td>
                            <td><?= $demande['raison'] ?></td>
                            <td><?= $demande['date_creation'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Laboratoires -->
    <div class="card mb-5 shadow">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Laboratoires</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Nom</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($laboratoires as $laboratoire): ?>
                        <tr>
                            <td><?= $laboratoire['nom'] ?></td>
                            <td><?= $laboratoire['description'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
