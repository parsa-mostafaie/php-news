<?php

use App\Models\Category;

defined('ABSPATH') || exit;

function listify($models, $col, $link = '#', $class = '')
{
  ?>
  <ul class="list-group list-group-flush p-0">
    <?php
    foreach ($models as $model) {
      $colv = $model->$col;
      $link_ = valueof($link, $model);
      $class_ = valueof($class, $model);
      ?>
      <li class='list-group-item'>
        <a class='link-body-emphasis text-decoration-none <?= $class_ ?>' href='<?= $link_ ?>'><?= $colv ?></a>
      </li>
      <?php
    } ?>
  </ul>
  <?php
}


function categories_list()
{
  $st = Category::all();

  $href = function (Category $category) {
    return $category->get_url();
  };

  $class = function (Category $category) {
    return get_val('cat') == $category->_id() ? 'fw-bold' : '';
  };

  listify($st, 'Name', $href, $class);
}