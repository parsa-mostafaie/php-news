<?php
// $__component__post_id

if (!is_numeric($__component__post_id)) {
  die();
}
$post_id = intval($__component__post_id);
$post =
  db()->TABLE('posts', true, 'p')
    ->SELECT('p.ID, p.title, p.content, p.image, p.verify, CONCAT(u.firstname, " ",u.lastname) as author, c.name as category')
    ->ON('p.author = u.id', 'users as u')->ON('c.id = p.category', 'categories as c')
    ->WHERE('p.id=?')->getFirstRow([$post_id]);

if (!$post->found) {
  die();
}
if (!$post->getColumn('verify')) {
  die();
}
?>
<div class="col-sm-6">
  <div class="card">
    <?= $post->getAssetBasedCol('image')->get_img('class="card-img-top" alt="post-image"') ?>

    <div class="card-body">
      <div class="d-flex justify-content-between">
        <h5 class="card-title fw-bold"><?=$post->getColumn('title')?></h5>
        <?= badge($post->getColumn('category')) ?>
      </div>
      <p class="card-text text-secondary pt-3">
        <?= truncate($post->getColumn('content'), 275) ?>
      </p>
      <div class="d-flex justify-content-between align-items-center">
        <a href="<?= c_url('/posts/' . $post_id) ?>" class="btn btn-sm btn-dark">مشاهده</a>

        <p class="fs-7 mb-0">نویسنده: <?= $post->getColumn('author') ?> </p>
      </div>
    </div>
  </div>
</div>