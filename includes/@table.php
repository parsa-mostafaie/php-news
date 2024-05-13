<?php include_once 'c-init.php';

function colnames(PDOStatement $st)
{
  for ($i = 0; $i < $st->columnCount(); $i++) {
    $col = $st->getColumnMeta($i);
    $columns[] = $col['name'];
  }
  return $columns;
}

function tablify(PDOStatement $st, $h_actions = '', $actions = '', $echo = true)
{
  $html = '<table class="table table-hover align-middle"><thead>';
  $fetch = $st->fetchAll(PDO::FETCH_ASSOC);
  $headers = colnames($st);
  foreach ($headers as $header) {
    $html .= "<th>$header</th>";
  }
  if ($h_actions and $actions) {
    $html .= "<th>$h_actions</th>";
  }
  $html .= "<tbody>";
  foreach ($fetch as $data) {
    $html .= "<tr>";
    foreach ($data as $cold) {
      $html .= "<td>$cold</td>";
    }
    if ($h_actions and $actions) {
      $actions_ = $actions;
      if (is_callable($actions)) {
        $actions_ = $actions($data);
      }
      $html .= "<td>$actions_</td>";
    }
    $html .= '</tr>';
  }

  $html .= '</tbody></table>';
  if ($echo)
    echo $html;
  return $html;
}

function categories_table()
{
  $actions = function ($data) {
    return '<a href="./pages/categories/edit.php?q=' . $data['ID'] . '" class="btn btn-sm btn-outline-dark">ویرایش</a>
                  <a href="#" class="btn btn-sm btn-outline-danger">حذف</a>';
  };
  $st = db()->TABLE('categories')->SELECT('ID, Name as `عنوان`')->Run();
  tablify($st, 'عملیات', $actions);
}