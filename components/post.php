<?php
use App\Models\Post;

// $__component__post, __component__post_class

if (!$__component__post instanceof Post) {
  die();
}

if (!$__component__post->loaded()) {
  return;
}
if (!$__component__post->verify) {
  return;
}

$__component__post_class ??= "col-sm-6"
  ?>
<div class="<?= $__component__post_class ?>">
  <div class="card h-100">
    <div class='position-relative'>
      <?= $__component__post->sp_image() ?>
      <?= $__component__post->cat_badge() ?>
    </div>
    <div class="card-header d-flex justify-content-between align-items-center flex-column flex-sm-row">
      <div>
        <span><i class='bi bi-clock-history'></i>
          <?= jdate('j F Y', $__component__post->publish_date()) ?></span>
      </div>
      <div class='d-sm-block d-none'>
        <span><i class='bi bi-file-earmark-post-fill'></i>
          <?= $__component__post->_id() ?></span>
      </div>
    </div>
    <div class="card-body" style='min-height: 190px'>
      <div class="d-flex justify-content-between">
        <a href="<?= $__component__post->get_url() ?>" class="text-decoration-none">
          <div class="text-black">
            <p class="card-title fw-bold"><?= $__component__post->title ?></p>
            <?php if ($__component__post->description): ?>
              <?= nl2br($__component__post->description, true) ?>
            <?php endif; ?>
          </div>
        </a>
      </div>
    </div>
    <div class="card-footer">
      <div class="d-flex justify-content-between gap-2 align-items-center flex-column">
        <p class="fs-7 mb-0">نویسنده: <?= $__component__post->author->fullname ?> </p>

        <?= view('post/reactions', 'reactions' . $__component__post->_id(), props: ['post' => $__component__post->_id()]) ?>
      </div>
    </div>
  </div>
</div>