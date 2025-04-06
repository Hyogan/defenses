<div class="container mt-5">
        <h2>Informations de l'utilisateur</h2>
        <?php if (!empty($userInfo)): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Statut</th>
                        <th>Rôle</th>
                        <th>Date de création</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $userInfo['id']; ?></td>
                        <td><?php echo $userInfo['nom']; ?></td>
                        <td><?php echo $userInfo['prenom']; ?></td>
                        <td><?php echo $userInfo['email']; ?></td>
                        <td><?php echo $userInfo['statut']; ?></td>
                        <td><?php echo $userInfo['role']; ?></td>
                        <td><?php echo $userInfo['date_creation']; ?></td>
                    </tr>
                </tbody>
            </table>
            <?php else: ?>
            <p>Aucune information d'utilisateur ou log trouvé.</p>
        <?php endif; ?>
</div>

<div class="container mt-5">
        <h2>Changer le mot de passe</h2>

        <?php if (isset($message)): ?>
            <div class="alert alert-<?php echo $message['type']; ?>"><?php echo $message['text']; ?></div>
        <?php endif; ?>

        <form action="/user/changePassword" method="post">
            <div class="form-group">
                <label for="current_password">Mot de passe actuel</label>
                <input type="password" class="form-control" id="current_password" name="current_password" required>
            </div>
            <div class="form-group">
                <label for="new_password">Nouveau mot de passe</label>
                <input type="password" class="form-control" id="new_password" name="new_password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirmer le nouveau mot de passe</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn btn-primary">Changer le mot de passe</button>
        </form>
    </div>
