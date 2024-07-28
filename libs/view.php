<?php
defined('ABSPATH') || exit;

function view($url, $id = null, $props = [])
{
  $url = url($url . ".php", $props);
  $url = c_url('/Views/' . $url);
  $etc = etc_url($url);
  $www = www_url($url);

  ?>
  <div ajax-container id="<?= $id ?? pathinfo($etc, PATHINFO_FILENAME) ?>">
    <div class="loading">لطفا صبر کنید!</div>
    <div ajax-content http-method="post" href="<?= redirect($www, back: true, gen: true) ?>" loading=".loading">
    </div>
  </div>
  <?php
  useDangerButtons();
  useAjaxContent();
  useHTTPLink();
}