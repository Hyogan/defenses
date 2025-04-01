<?php include 'views/layout/template.php'; ?>

<?php ob_start(); ?>
<h2>Détails de la ligne</h2>
<p><strong>ID:</strong> <?php echo $ligne->id; ?></p>
<p><strong>Type:</strong> <?php echo $ligne->type_ligne; ?></p>
<p><strong>Numéro:</strong> <?php echo $ligne->numero_ligne; ?></p>
<p><strong>Marque du poste:</strong> <?php echo $ligne->marque_poste; ?></p>
<p><strong>Nom du propriétaire:</strong> <?php echo $ligne->nom_proprietaire; ?></p>
<p><strong>Numéro du port:</strong> <?php echo $ligne->numero_port; ?></p>
<p><strong>Numéro du bandeau:</strong> <?php echo $ligne->numero_bandeau; ?></p>
<p><strong>Numéro du fusible:</strong> <?php echo $ligne->numero_fusible; ?></p>
<p><strong>Numéro de la jarretière:</strong> <?php echo $ligne->numero_jarretiere; ?></p>
<a href="index.php?controller=lignes&action=liste" class="btn btn-secondary">Retour à la liste</a>
<?php $content = ob_get_clean(); ?>