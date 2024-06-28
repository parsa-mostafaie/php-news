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
<?php useDangerButtons()?>