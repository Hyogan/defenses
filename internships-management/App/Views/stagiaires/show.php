<style>
        body {
            background-color: #f8f9fa;
        }

        .detail-card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .detail-card .card-header {
            background-color: #007bff;
            color: white;
            border-radius: 10px 10px 0 0;
            padding: 1rem;
        }

        .detail-card .card-body {
            padding: 1.5rem;
        }

        .detail-card .list-group-item {
            border: none;
            border-bottom: 1px solid #eee;
        }

        .detail-card .list-group-item:last-child {
            border-bottom: none;
        }

        .detail-card .list-group-item strong {
            color: #007bff;
        }

        .detail-card a {
            color: #007bff;
            text-decoration: none;
        }

        .detail-card a:hover {
            text-decoration: underline;
        }

        .detail-title {
            color: #343a40;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>

    <div class="container my-5">
        <h1 class="mb-4 detail-title">Détails du Stagiaire</h1>

        <?php if ($stagiaire): ?>
            <div class="detail-card">
                <div class="card-header">
                    <h5 class="mb-0"><?= $stagiaire['prenom_stagiaire'] . ' ' . $stagiaire['nom_stagiaire']; ?></h5>
                </div>
                <div class="card-body">
                    <p class="card-text"><strong>Email:</strong> <?= $stagiaire['email_stagiaire']; ?></p>
                    <p class="card-text"><strong>Formation:</strong> <?= $stagiaire['formation']; ?></p>
                    <p class="card-text"><strong>Date de début:</strong> <?= $stagiaire['date_debut']; ?></p>
                    <p class="card-text"><strong>Date de fin:</strong> <?= $stagiaire['date_fin']; ?></p>
                </div>
            </div>

            <?php if ($stagiaire['tuteur_id']): ?>
                <h2 class="mt-4 detail-title">Tuteur</h2>
                <div class="detail-card">
                    <div class="card-header">
                        <h5 class="mb-0"><?= $stagiaire['prenom_tuteur'] . ' ' . $stagiaire['nom_tuteur']; ?></h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><strong>Email:</strong> <?= $stagiaire['email_tuteur']; ?></p>
                        <p class="card-text"><strong>Département:</strong> <?= $stagiaire['departement_tuteur']; ?></p>
                        <p class="card-text"><strong>Poste:</strong> <?= $stagiaire['poste_tuteur']; ?></p>
                        <p class="card-text"><strong>Expérience:</strong> <?= $stagiaire['experience_tuteur']; ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($stagiaire['taches'])): ?>
                <h2 class="mt-4 detail-title">Tâches</h2>
                <ul class="list-group detail-card">
                    <?php foreach ($stagiaire['taches'] as $tache): ?>
                        <li class="list-group-item">
                            <strong><?= $tache['titre']; ?></strong><br>
                            <?= $tache['description']; ?><br>
                            <strong>Date limite:</strong> <?= $tache['date_limite']; ?><br>
                            <strong>Statut:</strong> <?= $tache['statut']; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <?php if (!empty($stagiaire['documents'])): ?>
                <h2 class="mt-4 detail-title">Documents</h2>
                <ul class="list-group detail-card">
                    <?php foreach ($stagiaire['documents'] as $document): ?>
                        <li class="list-group-item">
                            <a href="<?= $document['chemin_fichier']; ?>" target="_blank"><strong><?= $document['nom_fichier']; ?></strong></a><br>
                            <strong>Type:</strong> <?= $document['type_fichier']; ?><br>
                            <strong>Taille:</strong> <?= $document['taille']; ?> octets
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <?php if (!empty($stagiaire['evaluations'])): ?>
                <h2 class="mt-4 detail-title">Évaluations</h2>
                <ul class="list-group detail-card">
                    <?php foreach ($stagiaire['evaluations'] as $evaluation): ?>
                        <li class="list-group-item">
                            <strong>Note:</strong> <?= $evaluation['note']; ?><br>
                            <strong>Commentaires:</strong> <?= $evaluation['commentaires']; ?><br>
                            <strong>Date:</strong> <?= $evaluation['date_evaluation']; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

        <?php else: ?>
            <p>Stagiaire non trouvé.</p>
        <?php endif; ?>

    </div>
