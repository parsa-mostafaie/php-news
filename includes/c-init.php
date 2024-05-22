<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/libs/pluslib/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/libs/jdf/jdf.php';

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

function badge($t)
{
  return '<div>
                  <span class="badge text-bg-secondary">' . $t . '</span>
                </div>';
}

function hts_xss($html)
{
  return unti_xss(htmlspecialchars_decode($html));
}

require_once '@table.php';
require_once '@ul.php';
require_once '@selectopt.php';