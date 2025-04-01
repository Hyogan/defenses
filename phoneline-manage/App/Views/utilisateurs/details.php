<?php include 'views/layout/template.php'; ?>

<?php ob_start(); ?>
<h2>Détails de l'utilisateur</h2>
<p><strong>ID:</strong> <?php echo $utilisateur->id; ?></p>
<p><strong>Nom:</strong> <?php echo $utilisateur->nom; ?></p>
<p><strong>Email:</strong> <?php echo $utilisateur->email; ?></p>
<p><strong>Rôle:</strong> <?php echo $utilisateur->role; ?></p>
<a href="index.php?controller=utilisateurs&action=liste" class="btn btn-secondary">Retour à la liste</a>
<?php $content = ob_get_clean(); ?>