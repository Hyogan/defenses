<tr>
    <td><?= htmlspecialchars($evaluation['note']); ?></td>
    <td><?= htmlspecialchars($evaluation['commentaires']); ?></td>
    <td><?= htmlspecialchars($evaluation['date_evaluation']); ?></td>
    <?php if ($_SESSION['role'] === 'tuteur' || $_SESSION['role'] === 'superviseur'): ?>
        <td>
            <a href="/evaluation/modifier/<?= $evaluation['id']; ?>" class="btn btn-warning btn-sm">Modifier</a>
            <a href="/evaluation/supprimer/<?= $evaluation['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Confirmer la suppression ?')">Supprimer</a>
        </td>
    <?php endif; ?>
</tr>
