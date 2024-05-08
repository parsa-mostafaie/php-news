<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/libs/pluslib/init.php';

$__unsafe__hash__pass__disable = true;

if (!defined('news')) {
  define('news', true);
  HOME_URL('/news');
  db('plus_news');
}
