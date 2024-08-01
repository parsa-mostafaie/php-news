<?php include ('components/header.php'); ?>
<?php

use App\Models\Post;
use Pluslib\Database\Condition as sqlConditionGenerator;

$inp = get_val('search') ?? '';
$page = get_val('page');
$cat_id = intval(get_val('cat')) ?? 0;
$u_id = intval(get_val('author')) ?? 0;

[$condits, $fill] =
  sqlConditionGenerator::TextSearch($inp, 'p.title');

$stmt_params = [...$fill, $cat_id, $u_id];

$pres =
  Post::where('verify', 1)
    ->where($condits)
    ->WHERE($cat_id ? 'category = ?' : '0 = ?')
    ->WHERE($u_id ? 'author = ?' : '0 = ?')
    ->ORDER_BY('verify_date', 'desc')
    ->pagination(4, $page, $stmt_params);


$page = $pres['current'];

$countres = $pres['count'];

$__component__posts = $pres['result'];

function page($to)
{
  return url($_SERVER['REQUEST_URI'], ['page' => $to]);
}

function ui_pagination()
{
  global $page, $pres;
  ?>
  <div class="d-flex justify-content-cente">
    <nav aria-label="Search Navigation" dir="ltr">
      <ul class="pagination">
        <?php if ($page > 1): ?>
          <li class="page-item">
            <a class="page-link" href="<?= page($page - 1) ?>" aria-label="Previous" page="<?= $page - 1 ?>">
              <span aria-hidden="true">&laquo;</span>
            </a>
          </li>
        <?php endif ?>
        <?php for ($i = 1; $i <= $pres['page_count']; $i++): ?>
          <?php $class = $i == $page ? 'fw-bold text-dark' : ''; ?>
          <li class="page-item">
            <?php if ($page != $i): ?>
              <a class="page-link <?= $class ?>" href="<?= page($i) ?>" page="<?= $i ?>"><?= $i ?></a>
            <?php else: ?>
              <span class="page-link <?= $class ?>" href="<?= page($i) ?>" page="<?= $i ?>"><?= $i ?></span>
            <?php endif; ?>
          </li>
        <?php endfor; ?>
        <?php if ($page < $pres['page_count']): ?>
          <li class="page-item">
            <a class="page-link" href="<?= page($page + 1) ?>" aria-label="Next" page="<?= $page + 1 ?>">
              <span aria-hidden="true">&raquo;</span>
            </a>
          </li>
        <?php endif; ?>
      </ul>
    </nav>
  </div>

  <?php
}

?>
<!-- Content Section -->
<section class="mt-4">
  <div class="row">
    <!-- Posts Content -->
    <div class="col-lg-8">
      <div class="row">
        <div class="col">
          <?php ui_pagination() ?>
          <div class="alert alert-secondary">
            پست های مرتبط با کلمه [<b class="text-primary"><?= $inp ?></b>]
          </div>

          <?php if (!$countres): ?>
            <div class="alert alert-danger">
              مقاله مورد نظر پیدا نشد !!!!
            </div>
          <?php endif; ?>
          <?php if ($countres): ?>
            <div class="alert alert-success">
              از <?= $countres ?> نتیجه یافت شده؛ <?= $pres['result_count'] ?> نتیجه نمایش داده شد!
            </div>
          <?php endif; ?>
        </div>
      </div>

      <div class="row g-3">
        <?php
        include $_SERVER['DOCUMENT_ROOT'] . c_url('/components/posts.php');
        ?>
        <?php ui_pagination() ?>
      </div>
    </div>

    <?php include ('components/sidebar.php') ?>
  </div>
</section>

<?php include ('components/footer.php'); ?>