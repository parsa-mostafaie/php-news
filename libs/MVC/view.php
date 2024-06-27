<?php
defined('ABSPATH') || exit;

function view($url)
{
  $url = c_url('/Views/' . $url);
  $etc = etc_url($url);
  $www = www_url($url);

  ?>
  <div ajax-container>
    <div class="loading">لطفا صبر کنید!</div>
    <div ajax-content href="<?= $www ?>" loading=".loading">
      <?= file_get_contents($www) ?><!-- For SEO -->
    </div>
  </div>
  <?php
  useAjaxContent();
}