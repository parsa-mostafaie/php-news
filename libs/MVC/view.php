<?php
defined('ABSPATH') || exit;

function view($url, $id = null)
{
  $url = c_url('/Views/' . $url);
  $etc = etc_url($url);
  $www = www_url($url);

  ?>
  <div ajax-container id="<?= $id ?? pathinfo($etc, PATHINFO_FILENAME) ?>">
    <div class="loading d-none">لطفا صبر کنید!</div>
    <div ajax-content http-method="post" href="<?= redirect($www, back: true, gen: true) ?>" loading=".loading">
    </div>
  </div>
  <?php
  useDangerButtons();
  useAjaxContent();
  useHTTPLink();
}