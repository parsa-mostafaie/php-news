<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/libs/pluslib/init.php';

if (!defined('news')) {
  define('news', true);
  HOME_URL('/news');
  db('plus_news');
}
