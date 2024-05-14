<?php include_once 'c-init.php';

function listify(PDOStatement $st, $col, $link = '#', $echo = true)
{
  $html = '<ul class="list-group list-group-flush p-0">';
  $fetch = $st->fetchAll(PDO::FETCH_ASSOC);
  foreach ($fetch as $row) {
    $colv = $row[$col];
    $link_ = $link;
    if (is_callable($link_)) {
      $link_ = $link_($row);
    }
    $html .= "<li class='list-group-item'><a class='link-body-emphasis text-decoration-none' href='$link_'>$colv</a></li>";
  }
  $html .= '</ul>';
  if ($echo)
    echo $html;
  return $html;
}


function categories_list()
{
  $st = db()->TABLE('categories')->SELECT('ID, Name')->Run();
  listify($st, 'Name');
}