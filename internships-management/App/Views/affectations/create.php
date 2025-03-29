
<div class="container mt-4">
    <h1>Assigner des Tuteurs à un Stagiaire</h1>
    
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?= $_SESSION['success']; ?>
            <?php unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['error']; ?>
            <?php unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>
    
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Sélectionner un Stagiaire</h5>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <?php foreach ($stagiaires as $stagiaire): ?>
                            <a href="?stagiaire_id=<?= $stagiaire['id'] ?>" class="list-group-item list-group-item-action <?= (isset($_GET['stagiaire_id']) && $_GET['stagiaire_id'] == $stagiaire['id']) ? 'active' : '' ?>">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1"><?= htmlspecialchars($stagiaire['nom'] . ' ' . $stagiaire['prenom']) ?></h5>
                                </div>
                                <p class="mb-1"><?= htmlspecialchars($stagiaire['formation']) ?></p>
                                <small>Du <?= htmlspecialchars($stagiaire['date_debut']) ?> au <?= htmlspecialchars($stagiaire['date_fin']) ?></small>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <?php if (isset($_GET['stagiaire_id']) && $selectedStagiaire): ?>
                <div class="card">
                    <div class="card-header">
                        <h5>Assigner des Tuteurs à <?= htmlspecialchars($selectedStagiaire[0]['nom'] . ' ' . $selectedStagiaire[0]['prenom']) ?></h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="/tuteur/assign-process">
                            <input type="hidden" name="stagiaire_id" value="<?= $_GET['stagiaire_id'] ?>">
                            
                            <div class="form-group mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="replace_existing" name="replace_existing">
                                    <label class="form-check-label" for="replace_existing">
                                        Remplacer les assignations existantes
                                    </label>
                                </div>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label>Sélectionner les tuteurs à assigner:</label>
                                <div class="row">
                                    <?php foreach ($tuteurs as $tuteur): ?>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" 
                                                       name="tuteur_ids[]" 
                                                       value="<?= $tuteur['id'] ?>" 
                                                       id="tuteur_<?= $tuteur['id'] ?>"
                                                       <?= $this->isTuteurAssigned($tuteur['id'], $assignedTuteurs) ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="tuteur_<?= $tuteur['id'] ?>">
                                                    <?= htmlspecialchars($tuteur['nom'] . ' ' . $tuteur['prenom']) ?>
                                                    <br>
                                                    <small><?= htmlspecialchars($tuteur['departement'] . ' - ' . $tuteur['poste']) ?></small>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Assigner les Tuteurs</button>
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-info">
                    Veuillez sélectionner un stagiaire dans la liste pour lui assigner des tuteurs.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
// Helper function to check if a tutor is assigned
function isTuteurAssigned($tuteurId, $assignedTuteurs) {
    foreach ($assignedTuteurs as $tuteur) {
        if ($tuteur['id'] == $tuteurId) {
            return true;
        }
    }
    return false;
}
?>
