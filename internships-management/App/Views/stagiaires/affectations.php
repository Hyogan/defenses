<div class="container mt-5">
    <h2>Liste des Stagiaires et Tuteurs</h2>
    <!-- <a class="btn btn-primary" href="/tuteurs/assign">Assigner</a> -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Stagiaire</th>
                <th>Email Stagiaire</th>
                <th>Tuteur</th>
                <th>Email Tuteur</th>
                <th>Date affectation</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($affectations)) : ?>
                <?php foreach ($affectations as $item) : ?>
                    <tr>
                        <td><?= htmlspecialchars($item['stagiaire_nom'] . ' ' . $item['stagiaire_prenom']) ?></td>
                        <td><?= htmlspecialchars($item['stagiaire_email']) ?></td>
                        <td><?= htmlspecialchars($item['tuteur_nom'] . ' ' . $item['tuteur_prenom']) ?></td>
                        <td><?= htmlspecialchars($item['tuteur_email']) ?></td>
                        <td><?= htmlspecialchars($item['date_affectation']) ?></td>
                      
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="5">Aucune affectation trouvée.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
