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
function classIt($name)
{
  global $current_page;
  if ($name == $current_page) {
    return sidebarActiveItem;
  }
  return '';
}
function supermenu_classit($name)
{
  global $supermenu;
  if ($name == $supermenu) {
    return sidebarActiveMenu;
  }
  return sidebarNonActiveMenu;
}

$sidebarTemplate = [
  [
    'hide' => false,
    'route' => '/',
    'icon' => 'house-fill',
    'title' => 'داشبورد',
    'href' => $dashboard,
    'sup' => 'dashboard',
    'subs' => [
      [
        'hide' => false,
        'route' => '/posts',
        'icon' => 'file-earmark-image-fill',
        'title' => 'مقالات',
        'href' => $dashboardPages . 'posts/index.php'
      ],
      [
        'hide' => false,
        'route' => '/com',
        'icon' => 'chat-left-text-fill',
        'title' => 'کامنت ها',
        'href' => $dashboardPages . 'comments/index.php'
      ]
    ]
  ],
  [
    'hide' => !isAdmin(),
    'route' => '/',
    'icon' => 'person-check-fill',
    'title' => 'پنل ادمین',
    'href' => $admin,
    'sup' => 'admin',
    'subs' => [
      [
        'hide' => false,
        'route' => '/posts',
        'icon' => 'file-earmark-image-fill',
        'title' => 'مقالات',
        'href' => $adminPages . 'posts/index.php'
      ],
      [
        'hide' => false,
        'route' => '/com',
        'icon' => 'chat-left-text-fill',
        'title' => 'کامنت ها',
        'href' => $adminPages . 'comments/index.php'
      ],
      [
        'hide' => false,
        'route' => '/cat',
        'icon' => 'folder-fill',
        'title' => 'دسته بندی',
        'href' => $adminPages . 'categories/index.php'
      ],
      [
        'hide' => false,
        'route' => '/usr',
        'icon' => 'person-fill',
        'title' => 'کاربران',
        'href' => $adminPages . 'users/index.php'
      ]
    ]
  ],

  [
    'hide' => false,
    'icon' => 'newspaper',
    'title' => 'صفحه اصلی',
    'href' => c_url('/'),
  ],
  [
    'hide' => !isAdmin(),
    'icon' => 'database-fill',
    'title' => 'مدیریت پایگاه داده',
    'href' => '/phpmyadmin/'
  ],
  [
    'hide' => false,
    'icon' => 'box-arrow-left',
    'title' => 'خروج',
    'href' => c_url('/auth/signout.php'),
  ],
];

function navGenerate($template, $sub = false, $spn = null)
{
  $navClass = 'nav flex-column pe-3';
  $subClass = 'submenu ' . supermenu_classit($spn);
  $Class = $sub ? $subClass : $navClass;
  global $supermenu;
  ?>
  <ul class="<?= $Class ?>">
    <?php
    foreach ($template as $route) {
      $routePath = $route['route'] ?? '';
      $routeIcon = $route['icon'];
      $routeTitle = $route['title'];
      $routeLnk = $route['href'] ?? '#';

      $sup = $route['sup'] ?? null;

      $open = $sub || $sup ? $supermenu == ($spn ?? $sup) : true;
      $lnkClass = $open ? classIt($routePath) : '';

      $subs = $route['subs'] ?? [];

      if (!$route['hide']) { ?>
        <li class="nav-item">
          <a class="<?= sidebarItemClass ?> <?= $lnkClass ?>" href="<?= $routeLnk ?>">
            <i class="bi bi-<?= $routeIcon ?> fs-4 text-secondary"></i>
            <span class="fw-bold"><?= $routeTitle ?></span>
          </a>
          <?php $sup ? navGenerate($subs, true, $sup) : '' ?>
        </li><?php
      }
    }
    ?>
  </ul>
  <?php
}
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