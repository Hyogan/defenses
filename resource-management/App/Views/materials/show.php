<div class="container mt-5">
        <h2>Détails du matériel</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?= $material['nom'] ?></h5>
                <p class="card-text"><strong>Description:</strong> <?= $material['description'] ?></p>
                <p class="card-text"><strong>Modèle:</strong> <?= $material['model'] ?></p>
                <p class="card-text"><strong>Catégorie:</strong> <?= $category['nom'] ?></p>
                <a href="/materials" class="btn btn-secondary">Retour à la liste</a>
            </div>
        </div>
    </div>
