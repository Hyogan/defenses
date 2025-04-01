<h2>Liste des utilisateurs</h2>
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
        <?php foreach ($utilisateurs as $utilisateur): ?>
            <tr>
                <td><?php echo $utilisateur['id']; ?></td>
                <td><?php echo $utilisateur['nom']; ?></td>
                <td><?php echo $utilisateur['email']; ?></td>
                <td><?php echo $utilisateur['role']; ?></td>
                <td>
                    <a href="/user/details/<?php echo $utilisateur['id']; ?>" class="btn btn-info btn-sm">Détails</a>
                    <a href="/user/edit/<?php echo $utilisateur['id']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                    <a href="/user/delete/<?php echo $utilisateur['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur?');">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<a href="/user/create" class="btn btn-success">Ajouter un utilisateur</a>
