<?php require_once __DIR__ . '/../../includes/c-init.php'; ?>
<?php Auth::authAdmin(2) ?>
<?php $adminPages = web_url(c_url('/admin/pages/')); ?>
<?php $admin = web_url(c_url('/admin/')); ?>
<!DOCTYPE html>
<html dir="rtl" lang="fa">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>اخبار</title>
  <link rel="shortcut icon" href="<?= c_url('/favicon.ico', false) ?>" type="image/x-icon">

  <?php useBootstrap() ?>
  <link rel="stylesheet" href="<?= c_url('/admin') ?>/assets/css/style.css" />
</head>

<body>
  <header class="navbar sticky-top bg-secondary flex-md-nowrap p-0 shadow-sm">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-5 text-white" href="<?= $admin ?>">پنل ادمین</a>

    <button class="ms-2 nav-link px-3 text-white d-md-none" type="button" data-bs-toggle="offcanvas"
      data-bs-target="#sidebarMenu">
      <i class="bi bi-justify-left fs-2"></i>
    </button>
  </header>


  <div class="container-fluid">
    <div class="row">
      <?php include 'sidebar.php' ?>