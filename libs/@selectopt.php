<?php

defined('ABSPATH') || exit;

function selectOpt(PDOStatement $st, $col, $valRow = 'ID', $inpname = '', $def = null, $all = null, $class = '', $echo = true)
{
  $html = '<select class="form-select" name="' . $inpname . '">';
  $fetch = $st->fetchAll(PDO::FETCH_ASSOC);
  if ($all) {
    $sfetch = $fetch;
    $fetch = [$all];
    array_push($fetch, ...$sfetch);
  }
  foreach ($fetch as $row) {
    $colv = $row[$col];
    $attr = '';
    if ($row[$valRow] == $def) {
      $attr = 'selected';
    }
    $class_ = valueof($class, $row);
    $html .= "<option class='list-group-item $class_' value=" . $row[$valRow] . " $attr>$colv</option>";
  }
  $html .= '</select>';
  if ($echo)
    echo $html;
  return $html;
}


function categories_sel($inpname = 'cat', $default = null)
{
  $st = db()->TABLE('categories')->SELECT('ID, Name')->Run();
  selectOpt($st, 'Name', inpname: $inpname, def: $default);
}

function authors_sel($inpname = 'author', $default = null)
{
  $st = db()->TABLE('users')->SELECT('ID, CONCAT(firstname, " ", lastname) as Name')
    ->WHERE('admin > 0')->Run();
  selectOpt($st, 'Name', inpname: $inpname, def: $default, all: ['ID' => '0', 'Name' => 'همه']);
}