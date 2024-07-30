<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/libs/pluslib/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/libs/jdf/jdf.php';
require_once "boot.php";

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

function readtime($post)
{
  $content = $post->content;
  $count_words = str_word_count(strip_tags($content), );

  return ceil($count_words / 250);
}

require_once __DIR__ . '/../libs/@table.php';
require_once __DIR__ . '/../libs/@ul.php';
require_once __DIR__ . '/../libs/@use_lib.php';
require_once __DIR__ . '/../libs/@selectopt.php';
require_once __DIR__ . '/../libs/view.php';

require_once 'tables.php';