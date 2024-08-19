<?php
defined('ABSPATH') || exit;

if (!defined('news')) {
  define('news', true);
  HOME_URL('/news');
  db('plus_news');
  pls_autoload('App', etc_url(c_url('')));
  set_exception_handler('pls_exception_handler');
}

use pluslib\Config;
use App\Auth;

Config::$passwordHash_SHA256 = false;
Config::$devMode = true;
Config::$login_page = c_url('/auth/login.html', false);
Config::$AuthClass = Auth::class;

Config::init();