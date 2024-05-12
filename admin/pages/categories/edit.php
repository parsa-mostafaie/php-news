<?php $current_page = '/cat' ?>
<?php include '../../components/header.php' ?>
<!-- Main Section -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="fs-3 fw-bold">ویرایش دسته بندی</h1>
  </div>

  <!-- Posts -->
  <div class="mt-4">
    <form class="row g-4">
      <div class="col-12 col-sm-6 col-md-4">
        <label class="form-label">عنوان دسته بندی</label>
        <input type="text" class="form-control" value="طبیعت" />
      </div>

      <div class="col-12">
        <button type="submit" class="btn btn-dark">ویرایش</button>
      </div>
    </form>
  </div>
</main>
<?php include '../../components/footer.php' ?>