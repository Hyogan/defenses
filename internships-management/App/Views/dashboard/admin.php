<h1>Tableau de bord Administrateur</h1>
    
    <h2>Liste des utilisateurs</h2>
    <?php if (empty($allUsers)): ?>
        <p>Aucun utilisateur trouvé.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    </tr>
            </thead>
            <tbody>
                <?php foreach ($allUsers as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['nom']) ?></td>
                    <td><?= htmlspecialchars($user['prenom']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['role']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
