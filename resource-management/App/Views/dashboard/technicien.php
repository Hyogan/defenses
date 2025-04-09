<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Tableau de Bord du Technicien</h4>
        </div>
        <div class="card-body">
            <h2 class="mb-4">Matériels</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Modèle</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($materiels as $materiel): ?>
                            <tr>
                                <td><?= $materiel['nom'] ?></td>
                                <td><?= $materiel['model'] ?></td>
                                <td><?= $materiel['description'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <h2 class="mt-5 mb-4">Demandes de Changement</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Matériel</th>
                            <th>Raison</th>
                            <th>Date de Demande</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($demandes as $demande): ?>
                            <tr>
                                <td><?= $demande['id_demande'] ?></td>
                                <td><?= $demande['nom'] ?></td>
                                <td><?= $demande['raison'] ?></td>
                                <td><?= $demande['date_creation'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
