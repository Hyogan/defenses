<?php
$stylesheet = "/assets/css/admin.css";
$header = BASE_PATH . "/views/layouts/partials/admin.php";
// $footer = BASE_PATH . "/views/layouts/partials/footer.php";

ob_start(); ?>

<div class="admin-container">
    <?php require_once BASE_PATH . '/views/layouts/partials/header.php'; ?>

    <div style="height: 100vh; overflow-y: hidden;" class="row d-flex flex-grow-1 overflow-y-hidden">
        <div style="height: 100vh; overflow-y: auto;" class="col-md-9 flex-grow-1">
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
        <?php include_once BASE_PATH . '/views/layouts/partials/sidebar.php'; ?>
    </div>
</div>

<?php $content = ob_get_clean();

include BASE_PATH . "/views/layouts/base.php";
?>
