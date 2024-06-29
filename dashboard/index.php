<?php $current_page = '/' ?>
<?php include 'components/header.php'; ?>
<!-- Main Section -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="fs-3 fw-bold">داشبورد</h1>
  </div>

  <!-- Recently Posts -->
  <div class="mt-4">
    <h4 class="text-secondary fw-bold">مقالات اخیر شما</h4>
    <div class="table-responsive small">
      <?php posts_table(by: getCurrentUserInfo_prop('ID')) ?>
    </div>
  </div>

  <!-- Recently Comments -->
  <div class="mt-4">
    <h4 class="text-secondary fw-bold">کامنت های اخیر شما</h4>
    <div class="table-responsive small">
      <?php view('comments_tbl.php?by&last', 'ls_comments_tbl') ?>
    </div>
  </div>
</main>
<?php include 'components/footer.php' ?>