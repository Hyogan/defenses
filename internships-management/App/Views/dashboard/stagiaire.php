<style>
        body {
            background-color: #f8f9fa;
        }

        .dashboard-card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 10px;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .dashboard-card .card-body {
            padding: 2rem;
        }

        .dashboard-card .card-title {
            font-size: 1.5rem;
            color: #343a40;
            margin-bottom: 1rem;
        }

        .dashboard-card .card-text {
            font-size: 2rem;
            font-weight: 600;
            color: #007bff;
        }

        .dashboard-header {
            background: linear-gradient(to right, #007bff, #6610f2);
            color: white;
            padding: 2rem 0;
            border-radius: 10px 10px 0 0;
        }

        .dashboard-header h2 {
            margin-bottom: 0;
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <div class="dashboard-header text-center mb-4">
            <h2>Stagiaire Dashboard</h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-4 mb-4">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <h5 class="card-title">Nombre de Tâches</h5>
                        <?php
                        echo "<p class='card-text'>" . count($tachesEnCours) . "</p>";
                        ?>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <h5 class="card-title">Nombre de Tuteurs</h5>
                        <?php
                        echo "<p class='card-text'>" . $tuteurCount . "</p>";
                        ?>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <h5 class="card-title">Nombre d'Évaluations</h5>
                        <?php
                        echo "<p class='card-text'>" . $evaluationCount . "</p>";
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
    <h2 class="mb-3">Tâches en cours</h2>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Date Limite</th>
                    <th>Statut</th>
                    <th>Pourcentage</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $firstTenTasks = array_slice($tachesEnCours, 0, 10); // Get the first 10 items
                    foreach ($firstTenTasks as $tache):
                ?>
                    <tr>
                        <td><?= htmlspecialchars($tache['titre']) ?></td>
                        <td><?= htmlspecialchars($tache['description']) ?></td>
                        <td><?= htmlspecialchars($tache['date_limite']) ?></td>
                        <td class="status-<?= htmlspecialchars(strtolower($tache['statut'])) ?>">
                            <?= htmlspecialchars($tache['statut']) ?>
                        </td>
                        <td><?= htmlspecialchars($tache['nouveau_pourcentage']) ?>%</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
