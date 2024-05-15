<?php include ('components/header.php'); ?>
<?php
$inp = $_GET['search'] ?? '';
[$condits, $fill] =
  sqlConditionGenerator::TextSearch($inp, 'p.title');
$__component__post_pdos = db()->TABLE('posts', alias: 'p')->SELECT('*')
  ->WHERE($condits)
  ->Run($fill);
$countres = $__component__post_pdos->rowCount(); ?>
<!-- Content Section -->
<section class="mt-4">
  <div class="row">
    <!-- Posts Content -->
    <div class="col-lg-8">
      <div class="row">
        <div class="col">
          <div class="alert alert-secondary">
            پست های مرتبط با کلمه [<b class="text-primary"><?= $inp ?></b>]
          </div>

          <?php if (!$countres): ?>
            <div class="alert alert-danger">
              مقاله مورد نظر پیدا نشد !!!!
            </div>
          <?php endif; ?>
        </div>
      </div>

      <div class="row g-3">
        <?php
        include ($_SERVER['DOCUMENT_ROOT'] . c_url('/components/posts.php'))
          ?>
      </div>
    </div>

    <?php include ('components/sidebar.php') ?>
  </div>
</section>
<?php include ('components/footer.php'); ?>