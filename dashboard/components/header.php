<?php require_once __DIR__ . '/../../includes/c-init.php'; ?>
<?php canlogin() || redirect(c_url('/auth/login.html')) ?>
<?php $dashboardPages = c_url('/dashboard/pages/'); ?>
<?php $dashboard = c_url('/dashboard/'); ?>
<!DOCTYPE html>
<html dir="rtl" lang="fa">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>اخبار</title>

  <?php useBootstrap() ?>
  <link rel="stylesheet" href="<?= $dashboard ?>assets/css/style.css" />
</head>

<body>
  <header class="navbar sticky-top bg-secondary flex-md-nowrap p-0 shadow-sm">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-5 text-white" href="<?= $dashboard ?>">داشبورد</a>

    <button class="ms-2 nav-link px-3 text-white d-md-none" type="button" data-bs-toggle="offcanvas"
      data-bs-target="#sidebarMenu">
      <i class="bi bi-justify-left fs-2"></i>
    </button>
  </header>


  <div class="container-fluid">
    <div class="row">
      <?php include 'sidebar.php' ?>