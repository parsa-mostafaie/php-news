<?php
// $supermenu, $current_page

const sidebarActiveMenu = 'show';
const sidebarNonActiveMenu = 'collapse';
const sidebarActiveItem = 'text-secondary';
const sidebarItemClass = 'nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2';

$dashboard = c_url('/dashboard/');
$dashboardPages = $dashboard . 'pages/';

$admin = c_url('/admin/');
$adminPages = $admin . 'pages/';

include_once 'sidebar@lib.php';
include_once 'templates.php';
?>
<!-- Sidebar Section -->
<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
  <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu">
    <div class="offcanvas-header">
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"></button>
    </div>

    <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
      <!-- <ul class="nav flex-column pe-3">
        <li class="nav-item has-submenu">
          <a class="<?= sidebarItemClass ?> <?= classIt('/') ?>" href="<?= $dashboard ?>">
            <i class="bi bi-house-fill fs-4 text-secondary"></i>
            <span class="fw-bold">داشبورد</span>
          </a>
          <ul class="submenu <?= supermenu_classit('dashboard') ?>">
            <li class="nav-item">
              <a class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2 <?= classIt('/posts') ?>"
                href="<?= $dashboardPages ?>posts/index.php">
                <i class="bi bi-file-earmark-image-fill fs-4 text-secondary"></i>
                <span class="fw-bold">مقالات</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2  <?= classIt('/com') ?>"
                href="<?= $dashboardPages ?>comments/index.php">
                <i class="bi bi-chat-left-text-fill fs-4 text-secondary"></i>

                <span class="fw-bold">کامنت ها</span>
              </a>
            </li>
          </ul>
        </li>
        <?php if (isAdmin()): ?>
          <li class="nav-item">
            <a class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2"
              href="<?= c_url('/admin/') ?>">
              <i class="bi bi-person-check-fill fs-4 text-secondary"></i>
              <span class="fw-bold">پنل ادمین</span>
            </a>
          </li>
        <?php endif ?>
        <li class="nav-item">
          <a class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2"
            href="<?= c_url('/') ?>">
            <i class="bi bi-newspaper fs-4 text-secondary"></i>

            <span class="fw-bold">اخبار</span>
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
        -->
      <?php navGenerate($sidebarTemplate); ?>
    </div>
  </div>
</div>

<!-- FRONT -->
<style>
  .sidebar .nav li .submenu {
    list-style: none;
    margin: 0;
    padding: 0;
    padding-left: 1rem;
    padding-right: 1rem;
  }
</style>


<script>
  document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.sidebar .nav-link').forEach(function (element) {

      element.addEventListener('click', function (e) {

        let nextEl = element.nextElementSibling;
        let parentEl = element.parentElement;

        if (nextEl) {
          e.preventDefault();
          let mycollapse = new bootstrap.Collapse(nextEl);

          if (nextEl.classList.contains('show')) {
            mycollapse.hide();
          } else {
            mycollapse.show();
            // find other submenus with class=show
            var opened_submenu = parentEl.parentElement.querySelector('.submenu.show');
            // if it exists, then close all of them
            if (opened_submenu) {
              new bootstrap.Collapse(opened_submenu);
            }
          }
        }
      }); // addEventListener
    }) // forEach
  });
  // DOMContentLoaded  end
</script>