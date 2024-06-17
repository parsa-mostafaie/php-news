<?php
// $__component__post_id

if (!is_numeric($__component__post_id)) {
  die();
}
$post_id = intval($__component__post_id);
$post =
  db()->TABLE('posts', true, 'p')
    ->SELECT('p.verify_date as `date`, p.ID, p.title, p.description as `desc`, p.content, p.image, p.verify, CONCAT(u.firstname, " ",u.lastname) as author, c.name as category')
    ->ON('p.author = u.id', 'users as u')->ON('c.id = p.category', 'categories as c')
    ->WHERE('p.id=?')->getFirstRow([$post_id]);

if (!$post->found) {
  return;
}
if (!$post->getColumn('verify')) {
  return;
}
?>
<div class="col-sm-6">
  <div class="card h-100">
    <div class='position-relative'>
      <?= PostImage::get_img($post_id, 'class="card-img-top" alt="post-image"') ?>
      <div class='position-absolute' style='top: 5px;left:5px'><?= badge($post->getColumn('category')) ?></div>
    </div>
    <div class="card-header d-flex justify-content-between align-items-center flex-column flex-sm-row">
      <div>
        <span><i class='bi bi-clock-history'></i>
          <?= jdate('j F Y', strtotime($post->getColumn('date'))) ?></span>
      </div>
      <div class='d-sm-block d-none'>
        <span><i class='bi bi-file-earmark-post-fill'></i>
          <?= $post_id ?></span>
      </div>
    </div>
    <div class="card-body" style='min-height: 190px'>
      <div class="d-flex justify-content-between">
        <h5 class="card-title fw-bold"><?= $post->getColumn('title') ?></h5>
      </div>
      <?php if ($post->getColumn('desc')): ?>
        <!-- <p class="card-text pt-1 m-0 bg-gray p-1 px-2 bg-light rounded" style="border-right: .25rem solid #0a0b0caa;"> -->
        <?= nl2br($post->getColumn('desc'), 275) ?>
        <!-- </p> -->
      <?php endif; ?>
      <!-- <p class="card-text text-secondary pt-1">
        <?= truncate($post->getColumn('content'), 275) ?>
      </p> -->
    </div>
    <div class="card-footer">
      <div class="d-flex justify-content-between gap-2 align-items-center flex-sm-row flex-column">
        <a href="<?= c_url('/posts/' . $post_id) ?>" class="btn btn-sm btn-dark">مشاهده</a>

        <p class="fs-7 mb-0">نویسنده: <?= $post->getColumn('author') ?> </p>
      </div>
    </div>
  </div>
</div>