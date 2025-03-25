<?php include_once __DIR__ . '/../partials/header.php'; ?>

<div class="container mt-5">
    <h2>Profil de <?= htmlspecialchars($stagiaire['nom'] . ' ' . $stagiaire['prenom']); ?></h2>
    <p><strong>Formation :</strong> <?= htmlspecialchars($stagiaire['formation']); ?></p>
    <p><strong>Email :</strong> <?= htmlspecialchars($stagiaire['email']); ?></p>

    <h3>Évaluations</h3>
    <a href="/stagiaire/<?= $stagiaire['id']; ?>/evaluation/ajouter" class="btn btn-primary btn-sm">Ajouter une évaluation</a>
    
    <h3>Documents</h3>
    <a href="/stagiaire/<?= $stagiaire['id']; ?>/documents" class="btn btn-primary btn-sm">Voir les documents</a>
</div>

<?php include_once __DIR__ . '/../partials/footer.php'; ?>
