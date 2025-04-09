<div class="container mt-5">
    <h1 class="text-center mb-4">Tableau de bord Administrateur</h1>

    <div class="row row-cols-1 row-cols-md-3 g-4 mb-4">
        <div class="col">
            <div class="card h-100 shadow">
                <div class="card-body text-center">
                    <h5 class="card-title text-primary">Utilisateurs</h5>
                    <p class="card-text"><i class="bi bi-people me-2"></i>Nombre total: <?= $userCount ?></p>
                    <a href="/users" class="btn btn-outline-primary">Gérer</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 shadow">
                <div class="card-body text-success text-center">
                    <h5 class="card-title text-success">Matériels</h5>
                    <p class="card-text"><i class="bi bi-pc-display me-2"></i>Nombre total: <?= $materialCount ?></p>
                    <a href="/materials" class="btn btn-outline-success">Gérer</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 shadow">
                <div class="card-body text-info text-center">
                    <h5 class="card-title text-info">Activités Récentes</h5>
                    <p class="card-text"><i class="bi bi-activity me-2"></i>Dernières activités</p>
                    <a href="/dashboard/logs" class="btn btn-outline-info">Gérer</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="card h-100 shadow">
                <div class="card-body">
                    <h5 class="card-title">Derniers Utilisateurs Inscrits</h5>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Rôle</th>
                                    <th>Date Inscription</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($allUsers as $user): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($user['nom_complet']) ?></td>
                                        <td><?= htmlspecialchars($user['email']) ?></td>
                                        <td><?= htmlspecialchars($user['role']) ?></td>
                                        <td><?= htmlspecialchars($user['date_creation']) ?></td>
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
                    <h5 class="card-title">Activités Récentes</h5>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($activiteRecente as $activite): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?= htmlspecialchars($activite['message']) ?>
                                <span class="badge rounded-pill bg-info">
                                    <?= htmlspecialchars($activite['date']) ?>
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
                    <th>Nom Complet</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($allUsers as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['nom_complet']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= htmlspecialchars($user['role']) ?></td>
                        <td>
                            <a href="/users/edit/<?= $user['id_utilisateur'] ?>" class="btn btn-sm btn-primary">Modifier</a>
                            <button class="btn btn-sm btn-danger delete-user" data-user-id="<?= $user['id_utilisateur'] ?>">Supprimer</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-user');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-user-id');
                if (confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur?")) {
                    fetch('/users/delete/' + userId, {
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
