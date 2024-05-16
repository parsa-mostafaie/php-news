<?php include ('components/header.php') ?>
<?php
$__component__post_pdos = db()->TABLE('posts', alias: 'p')->SELECT('*')
  ->LIMIT(15)->ORDER_BY('date DESC')->Run();
?>
<!-- Slider Section -->
<section>
  <div id="carousel" class="carousel slide">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active"></button>
      <button type="button" data-bs-target="#carousel" data-bs-slide-to="1"></button>
      <button type="button" data-bs-target="#carousel" data-bs-slide-to="2"></button>
    </div>
    <div class="carousel-inner rounded">
      <div class="carousel-item overlay carousel-height active">
        <img src="./assets/images/1.jpg" class="d-block w-100" alt="post-image" />
        <div class="carousel-caption d-none d-md-block">
          <h5>لورم ایپسوم متن</h5>
          <p>
            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و
            با استفاده
          </p>
        </div>
      </div>
      <div class="carousel-item carousel-height overlay">
        <img src="./assets/images/2.jpg" class="d-block w-100" alt="post-image" />
        <div class="carousel-caption d-none d-md-block">
          <h5>لورم ایپسوم متن</h5>
          <p>
            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و
            با استفاده
          </p>
        </div>
      </div>
      <div class="carousel-item carousel-height overlay">
        <img src="./assets/images/3.jpg" class="d-block w-100" alt="post-image" />
        <div class="carousel-caption d-none d-md-block">
          <h5>لورم ایپسوم متن</h5>
          <p>
            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و
            با استفاده
          </p>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</section>

<!-- Content Section -->
<section class="mt-4">
  <div class="row row-gap-4">
    <!-- Posts Content -->
    <div class="col-lg-8">
      <div class="row g-3">
        <?php
        include ($_SERVER['DOCUMENT_ROOT'] . c_url('/components/posts.php'))
          ?>
      </div>
    </div>

    <?php include ('components/sidebar.php') ?>
  </div>
</section>
<?php include ('components/footer.php') ?>