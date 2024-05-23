<?php const sidebarActiveItem = 'text-secondary';
function classIt($name)
{
  global $current_page;
  if ($name == $current_page) {
    return sidebarActiveItem;
  }
  return '';
}
?>
<!-- Sidebar Section -->
<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
  <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu">
    <div class="offcanvas-header">
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"></button>
    </div>

    <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
      <ul class="nav flex-column pe-3">
        <li class="nav-item">
          <a class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2 <?= classIt('/') ?>"
            href="<?= $admin ?>">
            <i class="bi bi-person-check-fill fs-4 text-secondary"></i>
            <span class="fw-bold">پنل ادمین</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2"
            href="<?= c_url('/dashboard/') ?>">
            <i class="bi bi-house-fill fs-4 text-secondary"></i>
            <span class="fw-bold">داشبورد</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2 <?= classIt('/posts') ?>"
            href="<?= $adminPages ?>posts/index.php">
            <i class="bi bi-file-earmark-image-fill fs-4 text-secondary"></i>
            <span class="fw-bold">مقالات</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2  <?= classIt('/cat') ?>"
            href="<?= $adminPages ?>categories/index.php">
            <i class="bi bi-folder-fill fs-4 text-secondary"></i>

            <span class="fw-bold">دسته بندی</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2  <?= classIt('/com') ?>"
            href="<?= $adminPages ?>comments/index.php">
            <i class="bi bi-chat-left-text-fill fs-4 text-secondary"></i>

            <span class="fw-bold">کامنت ها</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2  <?= classIt('/usr') ?>"
            href="<?= $adminPages ?>users/index.php">
            <i class="bi bi-person-fill fs-4 text-secondary"></i>
        
            <span class="fw-bold">کاربران</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2 ?>"
            href="/phpmyadmin/?db=<?= db()->db ?>">
            <i class="bi bi-database-fill fs-4 text-secondary"></i>

            <span class="fw-bold">مدیریت پایگاه داده</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2"
            href="<?= c_url('/auth/signout.php') ?>">
            <i class="bi bi-box-arrow-right fs-4 text-secondary"></i>

            <span class="fw-bold">خروج</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>