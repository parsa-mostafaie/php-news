<?php include_once 'c-init.php';

function listify(PDOStatement $st, $col, $link = '#', $class = '', $echo = true)
{
  $html = '<ul class="list-group list-group-flush p-0">';
  $fetch = $st->fetchAll(PDO::FETCH_ASSOC);
  foreach ($fetch as $row) {
    $colv = $row[$col];
    $link_ = $link;
    if (is_callable($link_)) {
      $link_ = $link_($row);
    }
    $class_ = $class;
    if (is_callable($class_)) {
      $class_ = $class_($row);
    }
    $html .= "<li class='list-group-item'><a class='link-body-emphasis text-decoration-none $class_' href='$link_'>$colv</a></li>";
  }
  $html .= '</ul>';
  if ($echo)
    echo $html;
  return $html;
}


function categories_list()
{
  $st = db()->TABLE('categories')->SELECT('ID, Name')->Run();
  $href = function ($row) {
    return c_url("/search.php?search&cat=" . $row['ID']);
  };
  $class = function ($row) {
    return get_val('cat') == $row['ID']? 'fw-bold':'';
  };
  listify($st, 'Name', $href, $class);
}