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

const FARSI_VALIDATION_ERRORS = [
  'required' => 'لطفا %s را وارد کنید',
  'email' => '%s یک ایمیل درست نیست',
  'min' => '%s باید حداقل %s کاراکتر باشد',
  'max' => '%s باید حداکثر %s کاراکتر باشد',
  'between' => '%s باید بین %d و %d تا کاراکتر باشد',
  'same' => '%s باید با %s برابر باشد',
  'alphanumeric' => '%s باید فقط شامل اعداد و حروف باشد',
  'secure' => '%s باید بین 8 و 64 کاراکتر و حداقل یک عدد و یک حرف بزرگ و یک حرف کوچک و یک کاراکتر خاص باشد',
  'unique' => '%s تکراری است',
  'username' => '%s باید با حرف آغاز شود و فقط شامل: [A-Z, a-z, 0-9, _, -] باشد حداقل 3 و حداکثر 25 حرف می تواند داشته باشد',
  'usermail' => '%s باید یک نام کاربری یا ایمیل معتبر باشد'
];

function filter_persian($data, $fields, $errors = [])
{
  return filter($data, $fields, array_merge(FARSI_VALIDATION_ERRORS, $errors));
}

const ROLE_NORMAL = 0, ROLE_WRITER = 1, ROLE_ADMIN = 2;

require_once __DIR__ . '/../libs/@table.php';
require_once __DIR__ . '/../libs/@ul.php';
require_once __DIR__ . '/../libs/@use_lib.php';
require_once __DIR__ . '/../libs/@selectopt.php';
require_once __DIR__ . '/../libs/view.php';

require_once 'tables.php';