<?php

use App\Models\Post;

include ('components/header.php');
useAjaxContent() ?>
<?php
$__component__posts = Post::where('verify', 1)->LIMIT(15)->orderBy('verify_date', 'desc')->get();

$__component__caro = Post::where('verify', 1)->LIMIT(5)->orderBy('verify_date', 'desc')->get();
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