<?php include_once 'c-init.php';

function tablify(
  PDOStatement $st,
  $h_actions = '',
  $actions = '',
  $echo = true,
  $hidden = [],
  $th_s = ['ID'],
  $head_link = '#'
) {
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
      else {
        $_cold = "<a href='" . valueof($head_link, ['k' => $k, 'v' => $cold]) . "'>$cold</a>";
        $html .= "<th>$_cold</th>";
      }
    }
    if ($h_actions and $actions) {
      $actions_ = valueof($actions, $data);
      $html .= "<!-- 1 --><td>$actions_</td>";
    }
    $html .= '</tr>';
  }

  $html .= '</tbody></table>';
  if ($echo)
    echo $html;
  return $html;
}

include ('.tables.php');