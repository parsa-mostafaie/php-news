<?php include ('components/header.php'); ?>
<?php
$inp = get_val('search') ?? '';
$page = get_val('page');
$cat_id = intval(get_val('cat')) ?? 0;
$u_id = intval(get_val('author')) ?? 0;

[$condits, $fill] =
  sqlConditionGenerator::TextSearch($inp, 'p.title');

$stmt_params = [...$fill, $cat_id, $u_id];

$pres = db()->TABLE('posts', alias: 'p')->SELECT('*')
  ->WHERE($condits)
  ->WHERE($cat_id ? 'category = ?' : '0 = ?')
  ->WHERE($u_id ? 'p.author = ?' : '0 = ?')
  ->ORDER_BY('p.created_at desc')
  ->pagination(4, $page, $stmt_params);


$page = $pres['current'];

$countres = $pres['count'];

$__component__post_pdos = $pres['res'];

function ui_pagination()
{
  global $page, $pres;
  ?>
  <div class="d-flex justify-content-cente">
    <nav aria-label="Search Navigation" dir="ltr">
      <ul class="pagination">
        <?php if ($page > 1): ?>
          <li class="page-item">
            <a class="page-link" href="#" aria-label="Previous" page="<?= $page - 1 ?>">
              <span aria-hidden="true">&laquo;</span>
            </a>
          </li>
        <?php endif ?>
        <?php for ($i = 1; $i <= $pres['page_count']; $i++): ?>
          <?php $class = $i == $page ? 'fw-bold text-dark' : ''; ?>
          <li class="page-item">
            <?php if ($page != $i): ?>
              <a class="page-link <?= $class ?>" href="#" page="<?= $i ?>"><?= $i ?></a>
            <?php else: ?>
              <span class="page-link <?= $class ?>" href="#" page="<?= $i ?>"><?= $i ?></span>
            <?php endif; ?>
          </li>
        <?php endfor; ?>
        <?php if ($page < $pres['page_count']): ?>
          <li class="page-item">
            <a class="page-link" href="#" aria-label="Next" page="<?= $page + 1 ?>">
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
        include ($_SERVER['DOCUMENT_ROOT'] . c_url('/components/posts.php'))
          ?>
        <?php ui_pagination() ?>
      </div>
    </div>

    <?php include ('components/sidebar.php') ?>
  </div>
</section>

<script src='/libs/pluslib/frontend/sparams.js'></script>
<script>
  window.addEventListener('load', () => {
    anchors('a[page]', {
      attribute: {
        page: (pv, url) => setUrlParams(url, 'page', pv)
      }
    })
  })
</script>

<?php include ('components/footer.php'); ?>