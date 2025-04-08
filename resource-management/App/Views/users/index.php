<h2>Liste des utilisateurs</h2>
<a href="/users/create" class="btn btn-success">Ajouter un utilisateur</a>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $utilisateur): ?>
            <tr>
                <td><?php echo $utilisateur['id_utilisateur']; ?></td>
                <td><?php echo $utilisateur['nom_complet']; ?></td>
                <td><?php echo $utilisateur['email']; ?></td>
                <td><?php echo $utilisateur['role']; ?></td>
                <td>
                    <a href="/users/details/<?php echo $utilisateur['id_utilisateur']; ?>" class="btn btn-info btn-sm">Détails</a>
                    <a href="/users/edit/<?php echo $utilisateur['id_utilisateur']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                    <a href="/users/delete/<?php echo $utilisateur['id_utilisateur']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur?');">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
