<?php

use pluslib\Config;

defined('ABSPATH') || exit;

if (!defined('news')) {
  define('news', true);
  HOME_URL('/news');
  db('plus_news');
}

Config::$passwordHash_SHA256 = false;