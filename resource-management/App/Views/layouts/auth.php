<?php
$stylesheet = "/assets/css/auth.css";
$header = APP_PATH . "/Views/layouts/partials/auth_header.php";
$footer = APP_PATH . "/Views/layouts/partials/auth_footer.php";

ob_start(); ?>
<div class="auth-container justify-content-center">
    <?= $content ?>
</div>
<?php $content = ob_get_clean();

include APP_PATH . "/Views/layouts/base.php";
