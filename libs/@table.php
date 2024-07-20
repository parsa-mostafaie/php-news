<?php

defined('ABSPATH') || exit;

function tablify(
  PDOStatement $st,
  $h_actions = '',
  $actions = '',
  $echo = true,
  $hidden = [],
  $th_s = ['ID'],
  $head_link = '#',
  $rowid = '',
  $empty_msg = null
) {
  ?>
  <table class="table table-hover align-middle text-nowrap">
    <thead><?php
    $fetch = $st->fetchAll(PDO::FETCH_ASSOC);
    if (!$st->rowCount() && $empty_msg) {
      if ($echo) {
        echo $empty_msg;
      }
      return $empty_msg;
    }
    $headers = colnames($st);
    foreach ($headers as $header) {
      if (in_array($header, $hidden)) {
        continue;
      }
      ?>
        <th><?= $header ?></th><?php
    }
    if ($h_actions and $actions) {
      ?>
        <th><?= $h_actions ?></th><?php
    }
    ?>
    <tbody><?php
    foreach ($fetch as $data) {
      ?>
        <tr id='<?= valueof($rowid, $data) ?>'>
          <?php
          foreach ($data as $k => $cold) {
            if (in_array($k, $hidden)) {
              continue;
            }
            if (!in_array($k, $th_s)) {
              ?>
              <td><?= $cold ?></td><?php
            } else {
              ?>
              <th><a href='<?= valueof($head_link, [' k' => $k, 'v' => $cold]) ?>'><?= $cold ?></a></th><?php
            }
          }
          if ($h_actions and $actions) {
            ?>
            <td><?= valueof($actions, $data) ?></td>
            <?php
          }
          ?>
        </tr><?php
    }

    ?>
    </tbody>
  </table><?php
}
