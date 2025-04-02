<div class="container mt-5">
<div class="container mt-5">
    <h1 class="text-center mb-4">Tableau de bord Administrateur</h1>

    <div class="row row-cols-1 row-cols-md-3 g-4 mb-4">
        <div class="col">
            <div class="card h-100 shadow">
                <div class="card-body text-center">
                    <h5 class="card-title text-primary">Utilisateurs</h5>
                    <p class="card-text"><i class="bi bi-people me-2"></i>Nombre total: <?= $userCount ?></p>
                    <a href="/admin/users" class="btn btn-outline-primary">Gérer</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 shadow">
                <div class="card-body text-center">
                    <h5 class="card-title text-success">Stagiaires</h5>
                    <p class="card-text"><i class="bi bi-person-workspace me-2"></i>Nombre total: <?= $stagiaireCount ?></p>
                    <a href="/admin/stagiaires" class="btn btn-outline-success">Gérer</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 shadow">
                <div class="card-body text-info text-center">
                    <h5 class="card-title text-info">Tuteurs</h5>
                    <p class="card-text"><i class="bi bi-person-video2 me-2"></i>Nombre total: <?= $tuteurCount ?></p>
                    <a href="/admin/tuteurs" class="btn btn-outline-info">Gérer</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 shadow">
                <div class="card-body text-center">
                    <h5 class="card-title text-warning">Tâches</h5>
                    <p class="card-text"><i class="bi bi-list-task me-2"></i>Nombre total: <?= $tacheCount ?></p>
                    <a href="/admin/taches" class="btn btn-outline-warning">Gérer</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 shadow">
                <div class="card-body text-center">
                    <h5 class="card-title text-danger">Évaluations</h5>
                    <p class="card-text"><i class="bi bi-bar-chart-line me-2"></i>Nombre total: <?= $evaluationCount ?></p>
                    <a href="/admin/evaluations" class="btn btn-outline-danger">Gérer</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="card h-100 shadow">
                <div class="card-body">
                    <h5 class="card-title">Derniers Stagiaires Inscrits</h5>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Formation</th>
                                    <th>Date Début</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($latestStagiaires as $stagiaire): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($stagiaire['nom']) ?> <?= htmlspecialchars($stagiaire['prenom']) ?></td>
                                        <td><?= htmlspecialchars($stagiaire['email']) ?></td>
                                        <td><?= htmlspecialchars($stagiaire['formation']) ?></td>
                                        <td><?= htmlspecialchars($stagiaire['date_debut']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow">
                <div class="card-body">
                    <h5 class="card-title">Tâches Récentes</h5>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($recentTaches as $tache): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?= htmlspecialchars($tache['titre']) ?>
                                <span class="badge rounded-pill bg-<?= $tache['statut'] === 'terminée' ? 'success' : ($tache['statut'] === 'en cours' ? 'warning' : 'secondary') ?>">
                                    <?= htmlspecialchars(ucfirst($tache['statut'])) ?>
                                </span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

    <h2 class="mb-3">Liste des utilisateurs</h2>

    <?php if (empty($allUsers)): ?>
        <p class="alert alert-info">Aucun utilisateur trouvé.</p>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($allUsers as $user): ?>
                        <tr>
                            <td><?= htmlspecialchars($user['nom']) ?></td>
                            <td><?= htmlspecialchars($user['prenom']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td><?= htmlspecialchars($user['role']) ?></td>
                            <td>
                                <a href="/utilisateur/modifier/<?= $user['id'] ?>" class="btn btn-sm btn-primary">Modifier</a>
                                <button class="btn btn-sm btn-danger delete-user" data-user-id="<?= $user['id'] ?>">Supprimer</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-user');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-user-id');
                if (confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur?")) {
                    fetch('/admin/deleteUser/' + userId, {
                        method: 'DELETE'
                    })
                    .then(response => {
                        if (response.ok) {
                            // Optionally remove the row from the table
                            this.closest('tr').remove();
                            alert("L'utilisateur a été supprimé avec succès.");
                        } else {
                            alert("Une erreur s'est produite lors de la suppression de l'utilisateur.");
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert("Une erreur s'est produite.");
                    });
                }
            });
        });
    });
</script>
