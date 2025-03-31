<style>
    h1, h2 {
        color: #333;
    }

    .task-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .task-table th, .task-table td {
        border: 1px solid #ddd;
        padding: 12px 15px;
        text-align: left;
    }

    .task-table th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    .task-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .status-en-cours {
        background-color: #e6f7ff;
        color: #1890ff;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .status-termine {
        background-color: #f6ffed;
        color: #52c41a;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .status-en-retard {
        background-color: #fff1f0;
        color: #ff4d4f;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .priority-high {
        color: #ff4d4f;
        font-weight: bold;
    }

    .priority-medium {
        color: #faad14;
    }

    .priority-low {
        color: #52c41a;
    }

    .action-buttons {
        display: flex;
        gap: 5px;
    }

    .action-buttons button {
        padding: 5px 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .action-buttons button.update-status {
        background-color: #1890ff;
        color: white;
    }

    .action-buttons button.update-percentage {
        background-color: #52c41a;
        color: white;
    }
</style>

<h1>Tableau de bord Stagiaire</h1>
<h2>Tâches en cours</h2>

<?php if (empty($tachesEnCours)): ?>
    <p>Aucune tâche en cours.</p>
<?php else: ?>
    <table class="task-table">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Date Limite</th>
                <th>Statut</th>
                <th>Priorité</th>
                <th>Assigné à</th>
                <th>Pourcentage</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tachesEnCours as $tache): ?>
                <tr>
                    <td><?= htmlspecialchars($tache['titre']) ?></td>
                    <td><?= htmlspecialchars($tache['description']) ?></td>
                    <td><?= htmlspecialchars($tache['date_limite']) ?></td>
                    <td class="status-<?= htmlspecialchars(strtolower($tache['statut'])) ?>"><?= htmlspecialchars($tache['statut']) ?></td>
                    <td class="priority-<?= htmlspecialchars(strtolower($tache['priorite'])) ?>"><?= htmlspecialchars($tache['priorite']) ?></td>
                    <td><?= htmlspecialchars($tache['assigne_a']) ?></td>
                    <td><?= htmlspecialchars($tache['pourcentage']) ?>%</td>
                    <td class="action-buttons">
                        <form method="post" action="update_status.php">
                            <input type="hidden" name="task_id" value="<?= htmlspecialchars($tache['id']) ?>">
                            <button type="submit" class="update-status">Statut</button>
                        </form>
                        <form method="post" action="update_percentage.php">
                            <input type="hidden" name="task_id" value="<?= htmlspecialchars($tache['id']) ?>">
                            <button type="submit" class="update-percentage">Avancement</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
