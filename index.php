<?php include ('components/header.php') ?>
<?php
$__component__post_pdos = db()->TABLE('posts', alias: 'p')->SELECT('*')
  ->LIMIT(15)->ORDER_BY('created_at DESC')->Run();

$__component__caro_pdos = db()->TABLE('posts', alias: 'p')->SELECT('*')
  ->WHERE('p.verify = 1')
  ->LIMIT(5)->ORDER_BY('created_at DESC')->Run()->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- Slider Section -->
<section>
  <?php include ('components/carousel.php'); ?>
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