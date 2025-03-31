<div class="container mt-4">
    <h1>Modifier la tâche</h1>
    
    <form method="POST" action="/taches/edit/<?= $tache['id'] ?>">
        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" class="form-control" id="titre" name="titre" value="<?= htmlspecialchars($tache['titre']) ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"><?= htmlspecialchars($tache['description']) ?></textarea>
        </div>
        
        <div class="mb-3">
            <label for="stagiaire_id" class="form-label">Stagiaire</label>
            <select class="form-select" id="stagiaire_id" name="stagiaire_id" required>
                <?php foreach ($stagiaires as $stagiaire): ?>
                    <option value="<?= $stagiaire['id'] ?>" <?= $stagiaire['id'] == $tache['stagiaire_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($stagiaire['nom'] . ' ' . $stagiaire['prenom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="mb-3">
            <label for="tuteur_id" class="form-label">Tuteur</label>
            <input type="number" class="form-control" id="tuteur_id" name="tuteur_id" value="<?= $tache['tuteur_id'] ?>">
        </div>
        
        <div class="mb-3">
            <label for="statut" class="form-label">Statut</label>
            <select class="form-select" id="statut" name="statut">
                <option value="en cours" <?= $tache['statut'] == 'en cours' ? 'selected' : '' ?>>En cours</option>
                <option value="terminé" <?= $tache['statut'] == 'terminé' ? 'selected' : '' ?>>Terminé</option>
                <option value="en attente" <?= $tache['statut'] == 'en attente' ? 'selected' : '' ?>>En attente</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label for="pourcentage" class="form-label">Progression (%)</label>
            <input type="number" class="form-control" id="pourcentage" name="pourcentage" min="0" max="100" value="<?= $tache['pourcentage'] ?>">
        </div>
        
        <div class="mb-3">
            <label for="date_echeance" class="form-label">Date d'échéance</label>
            <input type="date" class="form-control" id="date_echeance" name="date_echeance" value="<?= $tache['date_echeance'] ?>">
        </div>
        
        <div class="d-flex justify-content-between">
            <a href="/taches" class="btn btn-secondary">Annuler</a>
            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
        </div>
    </form>
</div>
</qodoArtifact>
