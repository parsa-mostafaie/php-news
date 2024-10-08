<?php
defined('ABSPATH') || exit;

function view($url, $id = null, $props = [])
{
  $url = url("$url.php", $props);
  $url = c_url("/Views/$url");
  $etc = etc_url($url);
  $www = www_url($url);

  $id ??= pathinfo($etc, PATHINFO_FILENAME)

    ?>
  <div ajax-container id="<?= $id ?>">
    <div class="d-flex align-items-center overflow-hidden justify-content-center mx-auto loading">
      <div class="spinner-grow text-primary" role="status" aria-hidden="true"></div>
      <p class="my-0 me-2">لطفا صبر کنید!</p>
    </div>
    <div class="fallback text-danger d-none d-flex justify-content-center align-items-center mx-auto">
      خطا هنگام بارگزاری...
      &nbsp;<a class="text-decoration-underline fw-bold" href ajax-reload="#<?= $id ?>" onclick="return false;">تلاش مجدد</a>
    </div>
    <div ajax-content http-method="post" href="<?= redirect($www, back: true, gen: true) ?>" loading=".loading"
      fallback=".fallback">
    </div>
  </div>
  <?php
  useDangerButtons();
  useHTTPLink();
  useAjaxContent();
}