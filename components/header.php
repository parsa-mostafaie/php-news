<?php require_once __DIR__ . ('/../includes/c-init.php'); ?>
<!DOCTYPE html>
<html dir="rtl" lang="fa">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>اخبار</title>
  <link rel="shortcut icon" href="<?= c_url('/favicon.ico', false) ?>" type="image/x-icon">

  <?php useBootstrap() ?>
  <link rel="stylesheet" href="<?= c_url('/assets/css/style.css') ?>" />
</head>

<body>
  <div class="container py-3">
    <header class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom justify-content-between">
      <a href="<?= c_url('/') ?>" class="fs-4 fw-medium link-body-emphasis text-decoration-none">
        اخبار
      </a>

      <nav class="d-inline-flex">
        <!-- <a class="fw-bold me-3 py-2 link-body-emphasis text-decoration-none" href="#">طبیعت</a>
        <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="#">گردشگری</a>
        <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="#">تکنولوژی</a>
        <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="#">متفرقه</a> -->
        <?php if (canlogin()): ?>
          <a href="<?= !isAdmin() ? c_url('/dashboard/') : c_url('/admin/') ?>"
            class="me-3 py-2 link-body-emphasis text-decoration-none <?= isAdmin() ? 'text-primary' : '' ?>"><?= getCurrentUserInfo_prop('firstname') . ' ' . getCurrentUserInfo_prop('lastname') ?></a>
        <?php else: ?>
          <a href="<?= c_url('/auth/login.html') ?>"
            class="fw-bold me-3 py-2 link-body-emphasis text-decoration-none text-primary">ورود</a>
        <?php endif; ?>
      </nav>
    </header>

    <main>