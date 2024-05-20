<?php include_once 'c-init.php';

function selectOpt(PDOStatement $st, $col, $valRow = 'ID', $inpname = '', $def = null, $class = '', $echo = true)
{
  $html = '<select class="form-select" name="' . $inpname . '">';
  $fetch = $st->fetchAll(PDO::FETCH_ASSOC);
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