<?php $current_page = '/cat' ?>
<?php include '../../components/header.php' ?>
<!-- Main Section -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="fs-3 fw-bold">دسته بندی ها</h1>

    <div class="btn-toolbar mb-2 mb-md-0">
      <a href="./create.php" class="btn btn-sm btn-dark">
        ایجاد دسته بندی
      </a>
      <a ajax-reload="#a_cats_tbl" class="btn btn-sm btn-primary me-1">
        تازه سازی
      </a>
    </div>
  </div>

  <!-- Categories -->
  <div class="mt-4">
    <?php view('a_cats_tbl') ?>
  </div>
</main>
<?php include '../../components/footer.php' ?>