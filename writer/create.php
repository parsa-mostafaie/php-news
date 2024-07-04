<?php $current_page = '/posts';
$tiny_mce = true ?>
<?php include 'components/header.php' ?>
<!-- Main Section -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="fs-3 fw-bold">ایجاد مقاله</h1>
  </div>

  <!-- Posts -->
  <div class="mt-4">
    <form class="row g-4" submit-control form-wait="#wait" form-action="create-backend.php"
      enctype="multipart/form-data">
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
        <?php categories_sel() ?>
      </div>

      <div class="col-12 col-sm-6 col-md-4">
        <label for="formFile" class="form-label">تصویر مقاله</label>
        <input class="form-control" type="file" name="photo" />
      </div>

      <div class="col-12 col-sm-6 col-md-4">
        <label class="form-label" for="desc">توضیحات مقاله</label>
        <input type="text" class="form-control" id="desc" name="desc" />
      </div>

      <div class="col-12">
        <label for="content" class="form-label">متن مقاله</label>
        <textarea rows="9" name="id" id='tiny'></textarea>
      </div>

      <div id="wait">لطفا صبر کنید!</div>
      <div id="error" class='text-danger'></div>
      <div class="col-12">
        <button type="submit" class="btn btn-dark" ajax-submit name='create'>ایجاد</button>
      </div>
      <?php useFormlibAjax(); ?>
      <?php useAjaxInit2(); ?>
    </form>
  </div>
</main>
<?php include 'components/footer.php' ?>