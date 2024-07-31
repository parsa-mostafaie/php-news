<?php include_once '../../../includes/c-init.php';
use App\Models\Category;

$cat_id = get_val('cat');

if (!is_numeric($cat_id)) {
  _404_();
} ?>
<?php $cat = Category::find($cat_id);
if (!$cat) {
  _404_();
} ?>
<?php $current_page = '/cat' ?>
<?php include '../../components/header.php' ?>
<!-- Main Section -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="fs-3 fw-bold">ویرایش دسته بندی</h1>
  </div>

  <!-- Posts -->
  <div class="mt-4">
    <form class="row g-4" submit-control form-method="PUT" form-wait="#wait" form-action="edit-backend.php">
      <div class="col-12 col-sm-6 col-md-4">
        <label class="form-label">عنوان دسته بندی</label>
        <input type="text" class="form-control" name='catn' value="<?= $cat->Name ?>" />
      </div>
      <div id="wait">لطفا صبر کنید!</div>
      <div id="error" class='text-danger'></div>
      <div class="col-12">
        <button type="submit" class="btn btn-dark" ajax-submit name='update'
          value='<?= intval(get_val('cat')) ?>'>ویرایش</button>
      </div>
      <?php useFormlibAjax(); ?>
      <?php useAjaxInit1(); ?>
    </form>
  </div>
</main>
<?php include '../../components/footer.php' ?>