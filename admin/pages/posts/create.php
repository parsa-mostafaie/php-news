<?php $current_page = '/posts' ?>
<?php include '../../components/header.php' ?>
<!-- Main Section -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="fs-3 fw-bold">ایجاد مقاله</h1>
  </div>

  <!-- Posts -->
  <div class="mt-4">
    <form class="row g-4">
      <div class="col-12 col-sm-6 col-md-4">
        <label class="form-label">عنوان مقاله</label>
        <input type="text" class="form-control" />
      </div>

      <div class="col-12 col-sm-6 col-md-4">
        <label class="form-label">نویسنده مقاله</label>
        <input type="text" class="form-control" />
      </div>

      <div class="col-12 col-sm-6 col-md-4">
        <label class="form-label">دسته بندی مقاله</label>
        <select class="form-select">
          <option value="1">طبیعت</option>
          <option value="2">گردشگری</option>
          <option value="3">تکنولوژی</option>
          <option value="4">متفرقه</option>
        </select>
      </div>

      <div class="col-12 col-sm-6 col-md-4">
        <label for="formFile" class="form-label">تصویر مقاله</label>
        <input class="form-control" type="file" />
      </div>

      <div class="col-12">
        <label for="formFile" class="form-label">متن مقاله</label>
        <textarea class="form-control" rows="6"></textarea>
      </div>

      <div class="col-12">
        <button type="submit" class="btn btn-dark">ایجاد</button>
      </div>
    </form>
  </div>
</main>
<?php include '../../components/footer.php' ?>