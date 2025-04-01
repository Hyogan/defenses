<?php include 'views/layout/template.php'; ?>

<?php ob_start(); ?>
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
                    <a href="index.php?controller=utilisateurs&action=details&id=<?php echo $utilisateur['id']; ?>" class="btn btn-info btn-sm">Détails</a>
                    <a href="index.php?controller=utilisateurs&action=modifier&id=<?php echo $utilisateur['id']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                    <a href="index.php?controller=utilisateurs&action=supprimer&id=<?php echo $utilisateur['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur?');">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<a href="index.php?controller=utilisateurs&action=ajouter" class="btn btn-success">Ajouter un utilisateur</a>
<?php $content = ob_get_clean(); ?>