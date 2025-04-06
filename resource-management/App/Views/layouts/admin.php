<?php
$stylesheet = "/assets/css/admin.css";
$header = APP_PATH . "/Views/layouts/partials/admin.php";
// $footer = APP_PATH . "/Views/layouts/partials/footer.php";

ob_start(); ?>
<div class="admin-container" style="min-height: 100vh; display: flex; flex-direction: column;">
    <?php require_once APP_PATH . '/Views/layouts/partials/header.php'; ?>

    <div class="row d-flex flex-grow-1 overflow-y-hidden" style="margin:0; height: 100vh;">
            <?php include_once APP_PATH . '/Views/layouts/partials/sidebar.php'; ?>
        <div style="margin:0; height: 100%; overflow-y: auto;" class="col-md-9 flex-grow-1">
            <main class="admin-content pt-4">
                <?php if ($message = flash('success')): ?>
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <?= htmlspecialchars($message) ?>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                 <?php endif; ?>

                  <?php if ($message = flash('error')): ?>
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                          <?= htmlspecialchars($message) ?>
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                  <?php endif; ?>
                <?= $content ?>
            </main>
        </div>
    </div>
</div>

<?php $content = ob_get_clean();

include APP_PATH . "/Views/layouts/base.php";
?>
