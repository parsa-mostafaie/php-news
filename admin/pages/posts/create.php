<?php $current_page = '/posts' ?>
<?php include '../../components/header.php' ?>
<!-- Main Section -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="fs-3 fw-bold">ایجاد مقاله</h1>
  </div>

  <!-- Posts -->
  <div class="mt-4">
    <form class="row g-4" method="post" enctype="multipart/form-data">
      <div class="col-12 col-sm-6 col-md-4">
        <label class="form-label" for="title">عنوان مقاله</label>
        <input type="text" class="form-control" id="title" name="title" />
      </div>

      <div class="col-12 col-sm-6 col-md-4">
        <label class="form-label" for="author">نویسنده مقاله</label>
        <input type="text" class="form-control" disabled id="author"
          value="<?= getCurrentUserInfo_prop('firstname') . ' ' . getCurrentUserInfo_prop('lastname') ?>" />
      </div>

      <div class="col-12 col-sm-6 col-md-4">
        <label class="form-label">دسته بندی مقاله</label>
        <?php categories_sel(default: get_val('cat')) ?>
      </div>

      <div class="col-12 col-sm-6 col-md-4">
        <label for="formFile" class="form-label">تصویر مقاله</label>
        <input class="form-control" type="file" name="photo" />
      </div>

      <div class="col-12">
        <label for="content" class="form-label">متن مقاله</label>
        <textarea class="form-control" rows="6" name="content" id="content"></textarea>
      </div>

      <div class="col-12">
        <button type="submit" class="btn btn-dark" name="submit">ایجاد</button>
      </div>
    </form>
  </div>
</main>
<script src="/libs/pluslib/frontend/resubmit.js"></script>
<?php include '../../components/footer.php' ?>