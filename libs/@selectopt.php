<?php

use App\Models\Category;
use App\Models\User;
use pluslib\Collections\Arr;
use pluslib\Collections\Collection;
use pluslib\Eloquent\Select;

defined('ABSPATH') || exit;

function selectOpt($models, $name, $render, $once = [], $current = 0)
{
  ?>
  <select class="form-select" name="<?= $name ?>">
    <?php
    $option_render = function ($value, $text, $class = '') use ($current) {
      $isSelected = valueof($value) == $current;
      $attr = $isSelected ? 'selected' : '';
      $class = valueof($class);
      ?>
      <option class="list-group-item <?= $class ?>" value="<?= valueof($value) ?>" <?= $attr ?>>
        <?= valueof($text) ?>
      </option>
      <?php
    }; ?>
    <?php foreach ($once as $arr): ?>
      <?php $option_render(...wrap($arr)); ?>
    <?php endforeach; ?>
    <?php
    foreach ($models as $model) {
      ?>
      <?= $render($model, $option_render); ?>
      <?php
    }
    ?>
  </select>
  <?php
}


function categories_sel($inpname = 'cat', $default = null)
{
  $st = Category::all();
  selectOpt($st, $inpname, function (Category $category, $opr) {
    $opr($category->_id(), $category->Name);
  }, current: $default);
}

function authors_sel($inpname = 'author', $default = null)
{
  $st =
    User::select()->where('admin', '>', 0)->get();

  selectOpt($st, $inpname, function (User $user, $opr) {
    $opr($user->_id(), $user->fullname);
  }, once: [[0, 'همه']], current: $default);
}

define("searchSort", [
  [0, 'جدید ترین ها', ['verify_date', 'desc']],
  [1, 'قدیمی ترین ها', ['verify_date', 'asc']],
  [
    2,
    'پربحث ترین ها',
    function (Select $select) {
      $select->selectRaw('COUNT(c.id) as comment_count')
        ->on('c.post_id = posts.id AND c.verify = 1', 'comments c', 'left')
        ->groupBy('posts.id');

      return ['comment_count', 'desc'];
    }
  ],
  [
    3,
    'محبوب ترین ها',
    function (Select $select) {
      $select->selectRaw('COUNT(r.id) as reaction_count')
        ->on('r.post_id = posts.id', 'reactions r', 'left')
        ->groupBy('posts.id');

      return ['reaction_count', 'desc'];
    }
  ]
]);

function searchSort_sel($default = 0)
{
  $st =
    Arr::select(searchSort, [0, 1]);

  selectOpt($st, 'orderBy', function (array $kv, $opr) {
    $opr(...$kv);
  }, current: $default);
}