<h2>Liste des lignes</h2>
<table class="table">
<a href="lignes/ajouter" class="btn btn-success">Ajouter une ligne</a>
    <thead>
        <tr>
            <th>ID</th>
            <th>Type</th>
            <th>Numéro</th>
            <th>Propriétaire</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($lignes as $ligne): ?>
            <tr>
                <td><?php echo $ligne['id']; ?></td>
                <td><?php echo $ligne['type_ligne']; ?></td>
                <td><?php echo $ligne['numero_ligne']; ?></td>
                <td><?php echo $ligne['nom_proprietaire']; ?></td>
                <td>
                    <a href="/lignes/details/<?php echo $ligne['id']; ?>" class="btn btn-info btn-sm">Détails</a>
                    <a href="/lignes/modifier/<?php echo $ligne['id']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                    <!-- <a href="/lignes/supprimer/<?php echo $ligne['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette ligne?');">Supprimer</a> -->
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
