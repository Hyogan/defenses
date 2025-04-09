<div class="container">
    <div class="card shadow-lg mb-4 border-primary">
        <div class="card-header bg-primary text-white">
            <h3><i class="bi bi-speedometer2"></i> Tableau de Bord de l'Utilisateur</h3>
        </div>
        <div class="card-body">
            <h4 class="mb-3"><i class="bi bi-person-circle"></i> Informations de l'Utilisateur</h4>
            <ul class="list-group list-group-flush mb-4">
                <li class="list-group-item"><strong>Nom :</strong> <?= htmlspecialchars($user['nom_complet']) ?></li>
                <li class="list-group-item"><strong>Email :</strong> <?= htmlspecialchars($user['email']) ?></li>
                <li class="list-group-item"><strong>Service :</strong><?= $user['service']['nom']?>
                </li>
            </ul>

            <h4 class="mt-5 mb-3"><i class="bi bi-list-ul"></i> Mes Demandes de Changement</h4>
            <?php if (count($demandes) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle">
                        <thead class="table-primary text-center">
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
                                    <td class="text-center"><?= $demande['id_demande'] ?></td>
                                    <td><?= htmlspecialchars($demande['nom']) ?></td>
                                    <td><?= htmlspecialchars($demande['raison']) ?></td>
                                    <td><?= date('d/m/Y', strtotime($demande['date_creation'])) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i> Aucune demande de changement enregistrée.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
