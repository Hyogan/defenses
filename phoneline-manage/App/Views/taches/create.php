<div class="container mt-4">
    <h1>Créer une nouvelle tâche</h1>
    <?php if(!empty($erreurs)) { ?>
           <div class="alert alert-danger" role="alert">
           <?php foreach($erreurs as $error) {
             echo $error;
           }  
           ?>
    <?php } ?>
  </div>
   
    <form action="/tache/store" method="post">
        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" class="form-control" id="titre" name="titre" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>

        <div class="mb-3">
            <label for="stagiaire_id" class="form-label">Stagiaire</label>
            <select class="form-select" id="stagiaire_id" name="stagiaire_id" required>
                <?php foreach ($stagiaires as $stagiaire) : ?>
                    <option value="<?= $stagiaire['id'] ?>"><?= htmlspecialchars($stagiaire['nom'] . ' ' . $stagiaire['prenom']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php if ($role === 'tuteur') : ?>
            <div class="mb-3">
                <label for="tuteur_id" class="form-label">Tuteur</label>
                <input type="hidden" name="tuteur_id" value="<?= $tuteur_id; ?>">
                <input type="text" class="form-control" value="<?= htmlspecialchars($user_tuteur_nom . ' ' . $user_tuteur_prenom); ?>" readonly>
            </div>
        <?php else : ?>
            <div class="mb-3">
                <label for="tuteur_id" class="form-label">Tuteur</label>
                <select class="form-select" id="tuteur_id" name="tuteur_id" required>
                    <?php foreach ($tuteurs as $tuteur) : ?>
                        <option value="<?= $tuteur['id'] ?>"><?= htmlspecialchars($tuteur['nom'] . ' ' . $tuteur['prenom']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        <?php endif; ?>

        <div class="mb-3">
            <label for="date_limite" class="form-label">Date limite</label>
            <input type="date" class="form-control" id="date_limite" name="date_limite" required>
        </div>

        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
</div>
