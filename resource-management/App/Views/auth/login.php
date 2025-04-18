<style>
    /* Personnalisation des couleurs */
    .card {
        background-color: white;
        border-color: #17a2b8; /* Rouge doux pour la bordure */
    }

    .card-header {
        background-color: #f8f9fa; /* Couleur claire pour le fond du header */
        color: #333; /* Couleur sombre pour le titre */
        text-align: center;
        font-size: 1.5rem;
    }

    .form-label {
        color: #333; /* Texte des labels */
    }

    .form-control {
        border: 1px solid #ddd; /* Bordure plus douce pour les champs de saisie */
        box-shadow: none;
    }

    .form-control:focus {
        border-color: #17a2b8; /* Rouge doux au focus */
        box-shadow: 0 0 0 0.25rem rgba(243, 15, 32, 0.25);
    }

    .btn-primary {
        background-color: #17a2b8; /* Couleur rouge douce */
        border: none;
    }

    .btn-primary:hover {
        background-color: #f8f9fa; /* Fond clair au survol */
        color: #17a2b8; /* Texte rouge au survol */
        border: 1px solid #17a2b8;
    }

    .text-decoration-none {
        color: #17a2b8;
    }

    .text-decoration-none:hover {
        text-decoration: underline;
        color: #17a2b8;
    }

    /* .alert-danger {
        background-color: #red;  Fond très clair pour les alertes d'erreur 
        border-color:rgb(40, 47, 53);
        color: #17a2b8;
    } */

    .input-group-text {
        background-color: #17a2b8;
        color: white;
    }

    /* Ajout d'une légère bordure autour du formulaire pour le délimiter */
    .auth-form {
        border: 1px solid #f0f0f0;
        border-radius: 8px;
        padding: 20px;
    }
    img{
      width: 100px;
      height: auto;
    }
</style>

<div class="container mt-5">
    <div class="row justify-content-center">
      <!-- <?= password_hash('123', PASSWORD_DEFAULT); ?> -->
        <div class="col-md-6">
            <div class="card shadow-lg p-4 rounded">
                <img src="/logo-iug.png" alt="Logo IUG">
                <h2 class="card-header mb-4">Connectez-vous à votre compte</h2>
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $error ?>
                    </div>
                <?php endif; ?>

                <form action="/auth/authenticate" method="post" class="auth-form">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" value="<?= $email ?? '' ?>" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <div class="input-group">
                            <input type="password" id="password" name="password" class="form-control" required>
                            <span class="input-group-text">
                                <i id="togglePassword" class="fa-solid fa-eye-slash" style="cursor: pointer;"></i>
                            </span>
                        </div>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" id="remember" name="remember" value="1" class="form-check-input">
                        <label for="remember" class="form-check-label">Se souvenir de moi</label>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Se connecter</button>
                    </div>

                    </form>
            </div>
        </div>
    </div>
</div>

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye / eye slash icon
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
</script>
