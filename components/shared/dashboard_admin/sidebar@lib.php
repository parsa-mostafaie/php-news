<?php
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
function navGenerate($template, $sub = false, $supOpen = false)
{
  $navClass = 'nav flex-column pe-3';
  $subClass = 'submenu collapse ' . ($supOpen ? 'show' : '');
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

      $open = $sup ? $supermenu == $sup : false;
      $lnkClass = $open || $supOpen ? classIt($routePath) : '';

      $subs = $route['subs'] ?? [];

      if (!$route['hide']) { ?>
        <li class="nav-item">
          <a class="<?= sidebarItemClass ?> <?= $lnkClass ?>" href="<?= $routeLnk ?>">
            <i class="bi bi-<?= $routeIcon ?> fs-4 text-secondary"></i>
            <span class="fw-bold"><?= $routeTitle ?></span>
          </a>
          <?php $sup ? navGenerate($subs, true, $open) : '' ?>
        </li><?php
      }
    }
    ?>
  </ul>
  <?php
}