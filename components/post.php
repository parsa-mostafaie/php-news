<?php
use App\Models\Post;

// $__component__post, __component__post_class

if (!$__component__post instanceof Post) {
  die();
}
$post = $__component__post;

if (!$post->loaded()) {
  return;
}
if (!$post->verify) {
  return;
}

$__component__post_class ??= "col-sm-6"
?>
<div class="<?=$__component__post_class?>">
  <div class="card h-100">
    <div class='position-relative'>
      <?= $post->sp_image() ?>
      <?= $post->cat_badge() ?>
    </div>
    <div class="card-header d-flex justify-content-between align-items-center flex-column flex-sm-row">
      <div>
        <span><i class='bi bi-clock-history'></i>
          <?= jdate('j F Y', $post->publish_date()) ?></span>
      </div>
      <div class='d-sm-block d-none'>
        <span><i class='bi bi-file-earmark-post-fill'></i>
          <?= $post->_id() ?></span>
      </div>
    </div>
    <div class="card-body" style='min-height: 190px'>
      <div class="d-flex justify-content-between">
        <h5 class="card-title fw-bold"><?= $post->title ?></h5>
      </div>
      <?php if ($post->description): ?>
        <!-- <p class="card-text pt-1 m-0 bg-gray p-1 px-2 bg-light rounded" style="border-right: .25rem solid #0a0b0caa;"> -->
        <?= nl2br($post->description, 275) ?>
        <!-- </p> -->
      <?php endif; ?>
      <!-- <p class="card-text text-secondary pt-1">
        <?php // echo truncate($post->content, 275) ?>
      </p> -->
    </div>
    <div class="card-footer">
      <div class="d-flex justify-content-between gap-2 align-items-center flex-sm-row flex-column">
        <a href="<?= c_url('/posts/' . $post->_id()) ?>" class="btn btn-sm btn-dark">مشاهده</a>

        <p class="fs-7 mb-0">نویسنده: <?= $post->author->fullname() ?> </p>
      </div>
    </div>
  </div>
</div>