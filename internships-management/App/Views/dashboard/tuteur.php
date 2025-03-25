<h1>Tableau de bord Tuteur</h1>
    
    <h2>Tâches assignées</h2>
    <?php if (empty($tachesAssignées)): ?>
        <p>Aucune tâche assignée.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($tachesAssignées as $tache): ?>
                <li><?= htmlspecialchars($tache['titre']) ?> (Date limite: <?= htmlspecialchars($tache['date_limite']) ?>, Statut: <?= htmlspecialchars($tache['statut']) ?>)</li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
