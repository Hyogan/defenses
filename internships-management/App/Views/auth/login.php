<div class="auth-form-container">
    <h2>Login to Your Account</h2>
    
    <?php if (isset($error)): ?>
        <div class="error-message">
            <?= $error ?>
        </div>
    <?php endif; ?>
    
    <form action="/auth/authenticate" method="post" class="auth-form">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?= $email ?? '' ?>" required>
        </div>
        
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        
        <div class="form-group remember-me">
            <input type="checkbox" id="remember" name="remember" value="1">
            <label for="remember">Remember me</label>
        </div>
        
        <div class="form-group">
            <button type="submit" class="btn-primary">Login</button>
        </div>
        
        <div class="auth-links">
            <a href="/forgot-password">Forgot Password?</a>
            <a href="/register">Don't have an account? Register</a>
        </div>
    </form>
</div>
