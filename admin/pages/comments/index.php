<?php $current_page = '/com' ?>
<?php include ('../../components/header.php') ?>
<!-- Main Section -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="fs-3 fw-bold">کامنت ها</h1>
  </div>

  <!-- Comments -->
  <div class="mt-4">
    <div class="table-responsive small">
      <?php comments_table(false)?>
    </div>
  </div>
</main>
<?php include ('../../components/footer.php') ?>