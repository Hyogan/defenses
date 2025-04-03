<?php
// require_once VIEW_PATH . '/layouts/auth_header.php';
?>

<style>

    .container {
        max-width: 700px; /* Reduced container width */
    }

    .card {
        border-radius: 15px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        border: none;
        background-color: var(--card-bg-color);
        padding: 2rem; /* Increased padding */
    }

    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        padding: 0.75rem 1.5rem; /* Larger button padding */
        border-radius: 25px; /* Pill-shaped buttons */
        font-weight: 600; /* Bold font */
    }

    .btn-primary:hover {
        background-color: #e65a5a; /* Darker Coral Red on hover */
        border-color: #e65a5a;
    }

    .form-control-lg {
        border-radius: 8px;
        border: 1px solid var(--input-border-color);
        padding: 0.75rem;
    }

    .alert-danger {
        background-color: var(--error-color);
        border-color: #ef9a9a;
        color: var(--error-text-color);
        border-radius: 8px;
        padding: 1rem;
    }

    .form-check-input:checked {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .text-decoration-none {
        color: var(--accent-color);
        font-weight: 500;
    }

    .text-decoration-none:hover {
        color: #ffb347; /* Darker Orange on hover */
    }

    .form-label {
        color: var(--secondary-color);
        font-weight: 500;
    }

    h2 {
        color: var(--secondary-color);
        font-size: 2rem; /* Larger title */
        font-weight: 700;
        margin-bottom: 1.5rem; /* Increased margin */
    }

    .form-check {
        margin-bottom: 1rem;
    }

    .d-grid {
        margin-top: 1.5rem;
    }
</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-col-lg-6">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-body">
                    <h2 class="text-center">Connexion</h2>
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>

                    <form method="post" action="<?php echo APP_URL; ?>/auth/authenticate" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control form-control-lg" id="email" name="email" required>
                            <div class="invalid-feedback">
                                Veuillez entrer une adresse email valide.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control form-control-lg" id="password" name="password" required>
                            <div class="invalid-feedback">
                                Veuillez entrer votre mot de passe.
                            </div>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Se souvenir de moi</label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Se connecter</button>
                        </div>

                        <!-- <div class="text-center mt-4">
                            <a href="<?php echo APP_URL; ?>/auth/forgot-password" class="text-decoration-none">Mot de passe oublié?</a>
                        </div>
                        <div class="text-center mt-2">
                            <a href="<?php echo APP_URL; ?>/auth/register" class="text-decoration-none">Créer un compte</a>
                        </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>

<?php
// require_once VIEW_PATH . '/layouts/auth_footer.php';
?>
