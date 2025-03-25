<h1>Tableau de bord Stagiaire</h1>
    <h2>Tâches en cours</h2>
     <?php if (empty($tachesEnCours)): ?>
        <p>Aucune tâche en cours.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($tachesEnCours as $tache): ?>
                <li><?= htmlspecialchars($tache['titre']) ?> (Date limite: <?= htmlspecialchars($tache['date_limite']) ?>, Statut: <?= htmlspecialchars($tache['statut']) ?>)</li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
