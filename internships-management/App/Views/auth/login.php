<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg p-4 rounded">
                <h2 class="text-center mb-4">Login to Your Account</h2>

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
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" id="password" name="password" class="form-control" required>
                            <span class="input-group-text">
                                <i id="togglePassword" class="fa-solid fa-eye-slash" style="cursor: pointer;"></i>
                            </span>
                        </div>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" id="remember" name="remember" value="1" class="form-check-input">
                        <label for="remember" class="form-check-label">Remember me</label>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>

                    <div class="mt-3 text-center">
                        <a href="/forgot-password" class="text-decoration-none">Forgot Password?</a>
                        <br>
                        <a href="/register" class="text-decoration-none">Don't have an account? Register</a>
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
        // alert(this.classList)
    });
</script>
