<?php
require_once '../includes/c-init.php';

include_once ('lib.php');

$post_id = postID();

if (!is_numeric($post_id)) {
  _404_();
}
$post_id = intval($post_id);
$post =
  db()->TABLE('posts', true, 'p')
    ->SELECT('c.id as catid, p.created_at as `date`, p.updated_at as `edit`, p.ID, p.title, p.content, p.description as `desc`, p.verify_date as `vdate`, p.image, p.verify, CONCAT(u.firstname, " ",u.lastname) as author, c.name as category')
    ->ON('p.author = u.id', 'users as u')->ON('c.id = p.category', 'categories as c')
    ->WHERE('p.id=?')->getFirstRow([$post_id]);

if (!$post->found) {
  _404_();
}
if (!$post->getColumn('verify') && !isAdmin()) {
  _404_();
}

$_GET['cat'] = $post->getColumn('catid');// bold category in categories_list

// comment
include_once ('proc.php');
// end

$seoFriendly_URL = normalRoute();

['n' => $sessn, 'v' => $sessv] = secure_form();

// Edition >= Creation
// Verify > Creation
// Edition <=> Verify
$post_edit = $post->edit; // edition
$post_date = $post->date; // Creation
$post_vdate = $post->vdate; // Verify (Publish)
$date = empty($post_vdate) ? '<b class="text-success">تایید نشده</b>' : jdate('j F Y', strtotime(max($post_vdate, $post_edit)));
$editdate = $post_edit > $post_vdate && $post_vdate ? ' <b class="text-info">ویرایش شده</b>' : ''
  ?>
<?php if ($_SERVER['REQUEST_URI'] != $seoFriendly_URL): ?>
  <script>
    window.history.replaceState({}, '', "<?= $seoFriendly_URL ?>"+window.location.hash)
  </script>
<?php endif; ?>
<?php include ('../components/header.php') ?>

<!-- Content -->
<section class="mt-4">
  <div class="row">
    <!-- Posts & Comments Content -->
    <div class="col-lg-8">
      <div class="row justify-content-center">
        <!-- Post Section -->
        <div class="col">
          <div class="card">

            <!-- <img src="../assets/images/6.jpg" /> -->
            <div class='position-relative'>
              <?= PostImage::get_img($post_id, 'class="card-img-top" alt="post-image"') ?>
              <div class='position-absolute' style='top: 5px;left:5px'><?= badge($post->getColumn('category')) ?></div>
              <?php if (!$post->getColumn('verify')): ?>
                <div class='position-absolute' style='top: 5px;right:5px'><a
                    href="<?= c_url('/admin/pages/posts/index.php#' . $post_id) ?>"><span
                      class="badge text-bg-danger">تایید
                      نشده</span></a></div>
              <?php endif; ?>
            </div>
            <div class="card-header d-flex flex-wrap justify-content-between">
              <div class="d-flex flex-wrap column-gap-4">
                <span><i class='bi bi-clock-history'></i>
                  <?= $date ?></span> <span><i class="bi bi-clock"></i>
                  <?= readtime($post) ?> دقیقه</span>
              </div>
              <div>
                <span><i class='bi bi-file-earmark-post-fill'></i>
                  <?= $post_id ?></span>
              </div>
            </div>
            <div class="card-body">
              <div class="d-flex justify-content-between">
                <h5 class="card-title fw-bold">
                  <?php if (isAdmin()): ?><a href="<?= c_url('/admin/pages/posts/edit.php?post=' . $post_id) ?>">
                      <i class='bi bi-pencil-square text-secondary'></i></a><?php endif ?>
                  <?php if (isAdmin()): ?><a href="<?= c_url('/admin/pages/posts/#' . $post_id) ?>">
                      <i class='bi bi-newspaper text-secondary'></i></a><?php endif ?>
                  <?= $post->getColumn('title') ?>
                </h5>
              </div>
              <?php if ($post->getColumn('desc')): ?>
                <figure class="mt-1 bg-light p-3 rounded" style="border-right: .25rem solid #0a0b0caa;">
                  <blockquote class="fs-6 blockquote mb-0">
                    <?= nl2br($post->getColumn('desc'), 275) ?>
                  </blockquote>
                </figure>
              <?php endif ?>
              <p class="card-text text-secondary text-justify pt-3"><?= hts_xss(($post->getColumn('content'))) ?>
              </p>
              <div class="d-flex justify-content-between">
                <p class="fs-6 mt-5 mb-0">نویسنده: <?= $post->getColumn('author') ?> </p>
                <p class="fs-6 mt-5 mb-0"><?= $date ?> <?= $editdate ?> </p>
              </div>
            </div>
          </div>
        </div>

        <hr class="mt-4" />

        <!-- Comment Section -->
        <div class="col">
          <!-- Comment Form -->
          <div class="card" id="comments">
            <div class="card-body">
              <div class="text-center" dir="ltr"><?= process_form() ?></div>
              <p class="fw-bold fs-5">ارسال کامنت</p>

              <form method="post" action="./<?= $post_id ?>#comments">
                <input type="hidden" name="sec_form_sess_n" value="<?= $sessn ?>">
                <input type="hidden" name="sec_form_sess_v" value="<?= $sessv ?>">
                <div class="mb-3">
                  <label class="form-label">نام</label>
                  <input type="text" class="form-control" disabled
                    value="<?= getCurrentUserInfo_prop('firstname') . ' ' . getCurrentUserInfo_prop('lastname') ?>" />
                </div>
                <div class="mb-3">
                  <label class="form-label">متن کامنت</label>
                  <textarea class="form-control" rows="3" name="ctext" <?= !canlogin() ? 'disabled' : '' ?>><?= !$_COND ? $ctext : '' ?></textarea>
                  <p class="text-danger fw-bold text-center" dir="ltr"><?= errors('comment text') ?></p>
                </div>
                <button type="submit" class="btn btn-dark" <?= !canlogin() ? 'disabled' : '' ?> name="comment">
                  ارسال
                </button>
                <?php if (!canlogin()): ?>
                  <a href="<?= redirect(c_url('/auth/login.html'),true, gen:true) ?>" class="btn btn-success">
                    ورود به سایت
                  </a>
                <?php endif ?>
              </form>
            </div>
          </div>

          <hr class="mt-4" />
          <!-- Comment Content -->
          <p class="fw-bold fs-6">تعداد کامنت : <?= count(comments_fetch(nop: true)) ?> </p>

          <?= comments() ?>
        </div>
      </div>
    </div>

    <?php include ('../components/sidebar.php') ?>
  </div>
</section>
<?php useResubmit(); ?>
<?php include ('../components/footer.php') ?>