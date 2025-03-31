<h1>Tableau de bord Superviseur</h1>

    <h2>Stagiaires en retard</h2>
    <?php if (empty($stagiairesEnRetard)): ?>
        <p>Aucun stagiaire en retard.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($stagiairesEnRetard as $stagiaire): ?>
                <li><?= htmlspecialchars($stagiaire['nom']) ?> <?= htmlspecialchars($stagiaire['prenom']) ?> (Début: <?= htmlspecialchars($stagiaire['date_debut']) ?>, Fin: <?= htmlspecialchars($stagiaire['date_fin']) ?>)</li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
