<style>
        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }
    </style>

<div class="container mt-4">
        <h1 class="mb-4">Stagiaires Supervisés</h1>

        <div class="mb-4">
            <div class="input-group">
                <input type="text" id="searchInput" class="form-control" placeholder="Rechercher un stagiaire...">
                <button class="btn btn-outline-secondary" type="button" id="searchButton">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-header d-flex align-items-center">
                <i class="bi bi-people me-2"></i> Liste des Stagiaires
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="internTable">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <!-- <th>Département</th> -->
                                <th>Date de Début</th>
                                <th>Date de Fin</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($stagiaires)) : ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Aucun stagiaire trouvé.</td>
                                </tr>
                            <?php else : ?>
                                <?php foreach ($stagiaires as $stagiaire) : ?>
                                    <tr>
                                        <td><?= htmlspecialchars($stagiaire['nom']) ?></td>
                                        <td><?= htmlspecialchars($stagiaire['prenom']) ?></td>
                                        <td><?= htmlspecialchars($stagiaire['email']) ?></td>
                                        <!-- <td><?= htmlspecialchars($stagiaire['departement']) ?></td> -->
                                        <td><?= htmlspecialchars($stagiaire['date_debut']) ?></td>
                                        <td><?= htmlspecialchars($stagiaire['date_fin']) ?></td>
                                        <td><a href="/evaluation/ajouter/<?=$stagiaire['id']?>">Evaluer</a></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const searchButton = document.getElementById('searchButton');
            const table = document.getElementById('internTable');
            const rows = table.querySelectorAll('tbody tr');

            function filterTable() {
                const searchTerm = searchInput.value.toLowerCase();

                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    if (text.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            searchButton.addEventListener('click', filterTable);
            searchInput.addEventListener('input', filterTable); // Live search
        });
    </script>
