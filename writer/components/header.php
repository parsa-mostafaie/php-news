<?php require_once __DIR__ . '/../init.php';
use App\Auth; ?>
<?php Auth::authAdmin(1) ?>
<?php $writer = web_url(c_url('/writer/')); ?>
<!DOCTYPE html>
<html dir="rtl" lang="fa">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>اخبار</title>
  <link rel="shortcut icon" href="<?= c_url('/favicon.ico', false) ?>" type="image/x-icon">

  <?php useBootstrap() ?>

  <?php if ($tiny_mce ?? false): ?>
    <!-- TinyMCE -->
    <?php useTinyMCE(); ?>

    <?php add_head(function () {
      global $writer; ?>
      <script>
        tinymce.init({
          selector: 'textarea#tiny',
          content_css: '<?= c_url('/admin/', false) ?>assets/css/style.css',
          plugins: [
            'a11ychecker', 'advlist', 'advcode', 'advtable', 'autolink', 'checklist', 'markdown',
            'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',
            'powerpaste', 'fullscreen', 'formatpainter', 'insertdatetime', 'media', 'table', 'help', 'wordcount'
          ],
          toolbar: 'undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify |' +
            'bullist numlist checklist outdent indent | removeformat | code table help',
          images_upload_url: '<?= $writer . 'tnymceul.php' ?>',
          language_url:'/tinymce/langs/fa.js',
          language:'fa'
        })
      </script>
    <?php }); ?>
    <!-- end TinyMCE -->
  <?php endif ?>
  <?php do_head(); ?>
  <link rel="stylesheet" href="<?= c_url('/admin/', false) ?>assets/css/style.css" />
</head>

<body>
  <header class="navbar sticky-top bg-secondary flex-md-nowrap p-0 shadow-sm">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-5 text-white" href="<?= $writer ?>">پنل نویسنده</a>

    <button class="ms-2 nav-link px-3 text-white d-md-none" type="button" data-bs-toggle="offcanvas"
      data-bs-target="#sidebarMenu">
      <i class="bi bi-justify-left fs-2"></i>
    </button>
  </header>


  <div class="container-fluid">
    <div class="row">
      <?php include 'sidebar.php' ?>