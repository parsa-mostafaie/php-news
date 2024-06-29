<?php $current_page = '/com' ?>
<?php include ('../../components/header.php') ?>
<!-- Main Section -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="fs-3 fw-bold">کامنت های شما</h1>

    <div class="btn-toolbar mb-2 mb-md-0">
      <a ajax-reload="#as_comments_tbl" class="btn btn-sm btn-primary me-1">
        تازه سازی
      </a>
    </div>
  </div>

  <!-- Comments -->
  <div class="mt-4">
    <div class="table-responsive small">
      <?php view('comments_tbl.php?by', 'as_comments_tbl') ?>
    </div>
  </div>
</main>
<?php include ('../../components/footer.php') ?>