<div class="container mt-5">
        <h1>Détails du Stagiaire</h1>

        <?php if ($stagiaire): ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= $stagiaire['prenom_stagiaire'] . ' ' . $stagiaire['nom_stagiaire']; ?></h5>
                    <p class="card-text">Email: <?= $stagiaire['email_stagiaire']; ?></p>
                    <p class="card-text">Formation: <?= $stagiaire['formation']; ?></p>
                    <p class="card-text">Date de début: <?= $stagiaire['date_debut']; ?></p>
                    <p class="card-text">Date de fin: <?= $stagiaire['date_fin']; ?></p>
                </div>
            </div>

            <?php if ($stagiaire['tuteur_id']): ?>
                <h2 class="mt-4">Tuteur</h2>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= $stagiaire['prenom_tuteur'] . ' ' . $stagiaire['nom_tuteur']; ?></h5>
                        <p class="card-text">Email: <?= $stagiaire['email_tuteur']; ?></p>
                        <p class="card-text">Département: <?= $stagiaire['departement_tuteur']; ?></p>
                        <p class="card-text">Poste: <?= $stagiaire['poste_tuteur']; ?></p>
                        <p class="card-text">Expérience: <?= $stagiaire['experience_tuteur']; ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($stagiaire['taches'])): ?>
                <h2 class="mt-4">Tâches</h2>
                <ul class="list-group">
                    <?php foreach ($stagiaire['taches'] as $tache): ?>
                        <li class="list-group-item">
                            <strong><?= $tache['titre']; ?></strong><br>
                            <?= $tache['description']; ?><br>
                            Date limite: <?= $tache['date_limite']; ?><br>
                            Statut: <?= $tache['statut']; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <?php if (!empty($stagiaire['documents'])): ?>
                <h2 class="mt-4">Documents</h2>
                <ul class="list-group">
                    <?php foreach ($stagiaire['documents'] as $document): ?>
                        <li class="list-group-item">
                            <a href="<?= $document['chemin_fichier']; ?>" target="_blank"><?= $document['nom_fichier']; ?></a><br>
                            Type: <?= $document['type_fichier']; ?><br>
                            Taille: <?= $document['taille']; ?> octets
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <?php if (!empty($stagiaire['evaluations'])): ?>
                <h2 class="mt-4">Évaluations</h2>
                <ul class="list-group">
                    <?php foreach ($stagiaire['evaluations'] as $evaluation): ?>
                        <li class="list-group-item">
                            Note: <?= $evaluation['note']; ?><br>
                            Commentaires: <?= $evaluation['commentaires']; ?><br>
                            Date: <?= $evaluation['date_evaluation']; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

        <?php else: ?>
            <p>Stagiaire non trouvé.</p>
        <?php endif; ?>

    </div>
