<?php include_once __DIR__ . ('/../includes/c-init.php')
  // __component__caro_pdos
;
?>
<style>
  /* Make the images wide and responsive. */
  #carousel img {
    height: auto;
    max-width: 100%;
    width: 100%;
  }

  /* Change the order of the indicators. 
   Return them to the center of the slide. */
  /* .carousel-indicators {
    width: auto;
    margin-left: 0;
    transform: translateX(-50%);
  } */

  .carousel-indicators li {
    float: right;
    margin: 1px 4px;
  }

  .carousel-indicators .active {
    margin: 0 3px;
  }

  /* Change the direction of the transition. */
  @media all and (transform-3d),
  (-webkit-transform-3d) {

    .carousel-inner>.item.next,
    .carousel-inner>.item.active.right {
      left: 0;
      -webkit-transform: translate3d(-100%, 0, 0);
      transform: translate3d(-100%, 0, 0);
    }

    .carousel-inner>.item.prev,
    .carousel-inner>.item.active.left {
      left: 0;
      -webkit-transform: translate3d(100%, 0, 0);
      transform: translate3d(100%, 0, 0);
    }
  }
</style>
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