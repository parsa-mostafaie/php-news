<?php
defined('ABSPATH') || exit;

if (!defined('news')) {
  define('news', true);
  HOME_URL('/news');
  db('plus_news');
}