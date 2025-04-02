
<div class="container mt-5">
    <h2>Modifier l'évaluation</h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form action="/evaluation/update/<?= $evaluation['id']; ?>" method="POST">
        <input type="hidden" name="stagiaire_id" value="<?= $stagiaire['id']; ?>">
        
        <div class="mb-3">
            <label for="note" class="form-label">Note (sur 20)</label>
            <input type="number" name="note" id="note" class="form-control" min="0" max="20" value="<?= htmlspecialchars($evaluation['note']); ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="commentaires" class="form-label">Commentaires</label>
            <textarea name="commentaires" id="commentaires" class="form-control" rows="4" required><?= htmlspecialchars($evaluation['commentaires']); ?></textarea>
        </div>

        <button type="submit" class="btn btn-success">Mettre à jour</button>
        <a href="/stagiaire/<?= $stagiaire['id']; ?>/evaluations" class="btn btn-secondary">Annuler</a>
    </form>
</div>
