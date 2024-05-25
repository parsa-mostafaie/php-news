<?php include_once __DIR__ . ('/../includes/c-init.php')
  // __component__caro_pdos
;
?>
<link rel="stylesheet" href="<?= c_url('/assets/public/rtl-carousel.css') ?>">
<div id="carousel" class="carousel slide">
  <div class="carousel-indicators">
    <?php foreach ($__component__caro_pdos as $i => $post): ?>
      <button type="button" data-bs-target="#carousel" data-bs-slide-to="<?= $i ?>"
        class="<?= $i == 0 ? 'active' : '' ?>"></button>
    <?php endforeach; ?>
  </div>
  <div class="carousel-inner rounded">
    <?php foreach ($__component__caro_pdos as $i => $post): ?>
      <a href="<?= c_url('/posts/' . $post['ID']) ?>">
        <div class="carousel-item overlay carousel-height <?= $i == 0 ? 'active' : '' ?>">
          <?= imageComponent($post['Image'], 'class="d-block w-100" alt="post-image"', web_url(c_url('/assets/images/1.jpg'))) ?>
          <div class="carousel-caption d-none d-md-block">
            <h5><?= $post['Title'] ?></h5>
            <p>
              <?= $post['description'] ?>
            </p>
          </div>
        </div>
      </a>
    <?php endforeach; ?>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="next">
    <span class="carousel-control-prev-icon"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="prev">
    <span class="carousel-control-next-icon"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>