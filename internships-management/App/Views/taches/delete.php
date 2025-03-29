<div class="container mt-4">
    <h1>Supprimer la tâche</h1>
    
    <div class="alert alert-danger">
        <p>Êtes-vous sûr de vouloir supprimer la tâche suivante ?</p>
        <p><strong><?= htmlspecialchars($tache['titre']) ?></strong></p>
    </div>
    
    <form method="POST" action="/taches/delete/<?= $tache['id'] ?>">
        <div class="d-flex justify-content-between">
            <a href="/taches" class="btn btn-secondary">Annuler</a>
            <button type="submit" class="btn btn-danger">Confirmer la suppression</button>
        </div>
    </form>
</div>
