<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/libs/pluslib/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/libs/jdf/jdf.php';
require_once __DIR__ . '/../configs/config.php';

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
  return anti_xss(htmlspecialchars_decode($html));
}

function readtime(sqlRow $post)
{
  $content = $post->getColumn('content');
  $count_words = str_word_count(strip_tags($content), );

  return ceil($count_words / 250);
}

require_once '@table.php';
require_once '@ul.php';
require_once '@use_lib.php';
require_once '@selectopt.php';

require_once __DIR__ . '/../libs/MVC/ubc.php';