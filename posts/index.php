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
    ->SELECT('p.ID, p.title, p.content, p.image, p.verify, CONCAT(u.firstname, " ",u.lastname) as author, c.name as category')
    ->ON('p.author = u.id', 'users as u')->ON('c.id = p.category', 'categories as c')
    ->WHERE('p.id=?')->getFirstRow([$post_id]);

if (!$post->found) {
  _404_();
}
if (!$post->getColumn('verify')) {
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
                ' . $comment->getColumn('text') . '
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
    ->WHERE('c.post=' . $post_id)->WHERE($nop ? '1=1' : "c.parent $verb $parent");
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
            <?= $post->getAssetBasedCol('image')->get_img('class="card-img-top" alt="post-image"') ?>
            <div class="card-body">
              <div class="d-flex justify-content-between">
                <h5 class="card-title fw-bold"><?= $post->getColumn('title') ?></h5>
                <?= badge($post->getColumn('category')); ?>
              </div>
              <p class="card-text text-secondary text-justify pt-3"><?= $post->getColumn('content') ?>
              </p>
              <div>
                <p class="fs-6 mt-5 mb-0">نویسنده: <?= $post->getColumn('author') ?> </p>
              </div>
            </div>
          </div>
        </div>

        <hr class="mt-4" />

        <!-- Comment Section -->
        <div class="col">
          <!-- Comment Form -->
          <div class="card">
            <div class="card-body">
              <p class="fw-bold fs-5">ارسال کامنت</p>

              <form>
                <div class="mb-3">
                  <label class="form-label">نام</label>
                  <input type="text" class="form-control" />
                </div>
                <div class="mb-3">
                  <label class="form-label">متن کامنت</label>
                  <textarea class="form-control" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-dark">
                  ارسال
                </button>
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
<?php include ('../components/footer.php') ?>