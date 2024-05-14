<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/libs/pluslib/init.php';

if (!defined('news')) {
  define('news', true);
  HOME_URL('/news');
  db('plus_news');
}

function colnames(PDOStatement $st)
{
  for ($i = 0; $i < $st->columnCount(); $i++) {
    $col = $st->getColumnMeta($i);
    $columns[] = $col['name'];
  }
  return $columns;
}


require_once '@table.php';
require_once '@ul.php';