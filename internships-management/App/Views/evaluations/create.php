<?php include_once __DIR__ . '/../partials/header.php'; ?>

<div class="container mt-5">
    <h2>Ajouter une évaluation pour <?= htmlspecialchars($stagiaire['nom'] . ' ' . $stagiaire['prenom']); ?></h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form action="/stagiaire/<?= $stagiaire['id']; ?>/evaluation/store" method="POST">
        <div class="mb-3">
            <label for="note" class="form-label">Note (sur 20)</label>
            <input type="number" name="note" id="note" class="form-control" min="0" max="20" required>
        </div>
        
        <div class="mb-3">
            <label for="commentaire" class="form-label">Commentaires</label>
            <textarea name="commentaire" id="commentaire" class="form-control" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="/stagiaire/<?= $stagiaire['id']; ?>/evaluations" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<?php include_once __DIR__ . '/../partials/footer.php'; ?>
