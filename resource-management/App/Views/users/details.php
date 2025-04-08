<div class="container mt-5">
        <h2>Informations de l'utilisateur</h2>
        <?php if (!empty($userInfo)): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom complet</th>
                        <th>Email</th>
                        <th>Statut</th>
                        <th>Rôle</th>
                        <th>Date de création</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $userInfo['id_utilisateur']; ?></td>
                        <td><?php echo $userInfo['nom_complet']; ?></td>
                        <!-- <td><?php echo $userInfo['prenom']; ?></td> -->
                        <td><?php echo $userInfo['email']; ?></td>
                        <td><?php echo $userInfo['statut'] ?? 'actif'; ?></td>
                        <td><?php echo $userInfo['role']; ?></td>
                        <td><?php echo $userInfo['date_creation']; ?></td>
                    </tr>
                </tbody>
            </table>

            <!-- <h2>Logs de l'utilisateur</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Action</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($userInfo['logs'])): ?>
                        <?php foreach ($userInfo['logs'] as $log): ?>
                            <tr>
                                <td><?php echo $log['date']; ?></td>
                                <td><?php echo $log['action']; ?></td>
                                <td><?php echo $log['message']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">Aucun log trouvé pour cet utilisateur.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Aucune information d'utilisateur ou log trouvé.</p>
        <?php endif; ?> -->
    </div>
