<?php $current_page = '/posts' ?>
<?php require_once 'init.php';

use App\Models\Post;
use App\Models\PostImage;

$post_qs = get_val('post');

if (!is_numeric($post_qs)) {
  _404_();
}
$post_id = intval($post_qs);

EditAllowed($post_id);

$post = Post::find($post_id);

if (!$post) {
  _404_();
}

['n' => $sessn, 'v' => $sessv] = secure_form();

$tiny_mce = true;
?>
<?php include 'components/header.php' ?>
<!-- Main Section -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="fs-3 fw-bold">ویرایش مقاله</h1>
  </div>

  <!-- Posts -->
  <div class="mt-4">
    <form class="row g-4" submit-control form-wait="#wait" form-action="edit-backend.php" enctype="multipart/form-data">
      <input type="hidden" name="sec_form_sess_n" value="<?= $sessn ?>">
      <input type="hidden" name="sec_form_sess_v" value="<?= $sessv ?>">
      <input type="hidden" name="post" value="<?= $post_id ?>" ?>
      <div class="col-12 col-sm-6 col-md-4">
        <label class="form-label" for="title">عنوان مقاله</label>
        <input type="text" class="form-control" id="title" name="title" value="<?= $post->title ?>" />
      </div>

      <div class="col-12 col-sm-6 col-md-4">
        <label class="form-label" for="author">نویسنده مقاله</label>
        <input type="text" class="form-control" disabled id="author" value="<?= $post->author->fullname ?>" />
      </div>

      <div class="col-12 col-sm-6 col-md-4">
        <label class="form-label">دسته بندی مقاله</label>
        <?php categories_sel(default: $post->category->_id()) ?>
      </div>

      <div class="col-12 col-sm-6 col-md-4">
        <label for="formFile" class="form-label">تصویر جدید مقاله</label>
        <input class="form-control" type="file" name="photo" />
      </div>

      <div class="col-12 col-sm-6 col-md-4">
        <label class="form-label" for="desc">توضیحات مقاله</label>
        <input type="text" class="form-control" id="desc" name="desc" value="<?= $post->description ?>" />
      </div>

      <div class="col-12">
        <label for="content" class="form-label">متن مقاله</label>
        <textarea rows="6" name="tiny" id="tiny"><?= $post->content ?></textarea>
      </div>


      <div class="col-12 col-sm-6 col-md-4 d-flex flex-column">
        <?= $post->thumbnail_image() ?>
        <b class="text-dark text-center mt-1">تصویر فعلی</b>
      </div>

      <div id="wait">لطفا صبر کنید!</div>
      <div id="error" class='text-danger'></div>
      <div class="col-12">
        <button type="submit" class="btn btn-dark" ajax-submit name='edit'>ویرایش</button>
      </div>
      <?php useFormlibAjax(); ?>
      <?php useAjaxInit2(); ?>
    </form>
  </div>
</main>
<?php include 'components/footer.php' ?>