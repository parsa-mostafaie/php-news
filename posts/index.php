<?php
require_once '../includes/c-init.php';

$exps_arr = explode('/', $_SERVER['REQUEST_URI']);
$posts_index = array_search('posts', $exps_arr);
$lp = array_splice($exps_arr, $posts_index + 1);
$flp = $lp[0];

if (!is_numeric($flp)) {
  _404_();
}
$post_id = intval($flp);
$post =
  db()->TABLE('posts', true, 'p')
    ->SELECT('p.date, p.ID, p.title, p.content, p.description as `desc`, p.image, p.verify, CONCAT(u.firstname, " ",u.lastname) as author, c.name as category')
    ->ON('p.author = u.id', 'users as u')->ON('c.id = p.category', 'categories as c')
    ->WHERE('p.id=?')->getFirstRow([$post_id]);

if (!$post->found) {
  _404_();
}
if (!$post->getColumn('verify') && !isAdmin()) {
  _404_();
}

function comment($cid)
{
  $comment = db()->TABLE('comments as c', true)->
    SELECT('CONCAT(u.firstname, " ", u.lastname) as fname, c.text, u.profile')
    ->WHERE('c.ID=' . $cid)
    ->WHERE('verify = 1')
    ->ON('u.ID = c.user_id', 'users as u')->getFirstRow();
  if (!$comment->found) {
    return '';
  }
  $und =
    web_url(c_url('/assets/images/profile.png'));
  $pimg = $comment->getAssetBasedCol('profile')->
    get_img(
      'width="45" height="45" alt="user-profile" class="rounded-circle"',
      $und
    );
  return '<div class="card bg-light-subtle mb-3" id="c' . $cid . '">
            <div class="card-body">
              <div class="d-flex align-items-center">
                ' . $pimg . '

                <h5 class="card-title me-2 mb-0">' . $comment->getColumn('fname') . '</h5>
              </div>

              <p class="card-text pt-3 pr-3">
                ' . nl2br($comment->getColumn('text')) . '
              </p>
            ' . comments($cid) . '
            </div>
          </div>';
}

function comments_fetch($parent = 'NULL', $nop = false)
{
  global $post_id;
  $verb = strtoupper($parent) == 'NULL' ? 'is' : '=';
  $coms = db()->TABLE('comments as c', true)->SELECT('id')
    ->WHERE('c.post=' . $post_id)->WHERE($nop ? '1=1' : "c.parent $verb $parent")->WHERE('verify = 1');
  return $coms->Run()->fetchAll(PDO::FETCH_ASSOC);
}

function comments($parent = 'NULL')
{
  $s = '';
  foreach (comments_fetch($parent) as $comm) {
    $s .= comment($comm['id']);
  }
  return $s;
}

// comment
include_once ('proc.php');
// end

['n' => $sessn, 'v' => $sessv] = secure_form();
?>
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
              <?= $post->getAssetBasedCol('image')->get_img('class="card-img-top" alt="post-image"', web_url(c_url('/assets/images/1.jpg'))) ?>
              <div class='position-absolute' style='top: 5px;left:5px'><?= badge($post->getColumn('category')) ?></div>
              <?php if (!$post->getColumn('verify')): ?>
                <div class='position-absolute' style='top: 5px;right:5px'><a
                    href="<?= c_url('/admin/pages/posts/index.php#' . $post_id) ?>"><span
                      class="badge text-bg-danger">تایید
                      نشده</span></a></div>
              <?php endif; ?>
            </div>
            <div class="card-header d-flex justify-content-between">
              <div>
                <span><i class='bi bi-clock-history'></i>
                  <?= jdate('j F Y', strtotime($post->getColumn('date'))) ?></span>
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
              <p class="card-text text-secondary text-justify pt-3"><?= hts_xss(nl2br($post->getColumn('content'))) ?>
              </p>
              <div class="d-flex justify-content-between">
                <p class="fs-6 mt-5 mb-0">نویسنده: <?= $post->getColumn('author') ?> </p>
                <p class="fs-6 mt-5 mb-0"><?= jdate('j F Y در H:i ', strtotime($post->getColumn('date'))) ?> </p>
              </div>
            </div>
          </div>
        </div>

        <hr class="mt-4" />

        <!-- Comment Section -->
        <div class="col">
          <?= process_form() ?>
          <!-- Comment Form -->
          <div class="card" id="comments">
            <div class="card-body">
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
                  <?= errors('comment text') ?>
                </div>
                <button type="submit" class="btn btn-dark" <?= !canlogin() ? 'disabled' : '' ?> name="comment">
                  ارسال
                </button>
                <?php if (!canlogin()): ?>
                  <a href="<?= c_url('/auth/login.html') ?>" class="btn btn-success">
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
<script src="/libs/pluslib/frontend/resubmit.js"></script>
<?php include ('../components/footer.php') ?>