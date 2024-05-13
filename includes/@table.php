<?php include_once 'c-init.php';

function colnames(PDOStatement $st)
{
  for ($i = 0; $i < $st->columnCount(); $i++) {
    $col = $st->getColumnMeta($i);
    $columns[] = $col['name'];
  }
  return $columns;
}

function tablify(PDOStatement $st, $h_actions = '', $actions = '', $echo = true, $hidden = [], $th_s = ['ID'])
{
  $html = '<table class="table table-hover align-middle"><thead>';
  $fetch = $st->fetchAll(PDO::FETCH_ASSOC);
  $headers = colnames($st);
  foreach ($headers as $header) {
    if (in_array($header, $hidden)) {
      continue;
    }
    $html .= "<th>$header</th>";
  }
  if ($h_actions and $actions) {
    $html .= "<th>$h_actions</th>";
  }
  $html .= "<tbody>";
  foreach ($fetch as $data) {
    $html .= "<tr>";
    foreach ($data as $k => $cold) {
      if (in_array($k, $hidden)) {
        continue;
      }
      if (!in_array($k, $th_s))
        $html .= "<td>$cold</td>";
      else
        $html .= "<th>$cold</th>";
    }
    if ($h_actions and $actions) {
      $actions_ = $actions;
      if (is_callable($actions)) {
        $actions_ = $actions($data);
      }
      $html .= "<!-- 1 --><td>$actions_</td>";
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

function comments_table()
{
  $actions = function ($data) {
    $nv = '<a href="#" class="btn btn-sm btn-outline-info">در انتظار تایید</a>';
    $v = '<a href="#" class="btn btn-sm btn-outline-dark disabled">تایید شده</a>';
    $vb = $data['verify'] ? $v : $nv;
    return $vb . ' <a href="#" class="btn btn-sm btn-outline-danger">حذف</a>';
  };
  $st = db()->TABLE('comments as c', true)->SELECT('c.verify, c.ID, (CONCAT(u.firstname, " ",u.lastname)) as `نام`, Text as `متن کامنت`')->ON('u.ID = c.user_id', 'users as u')->LIMIT(5)->Run();
  tablify($st, 'عملیات', $actions, hidden: ['verify']);
}