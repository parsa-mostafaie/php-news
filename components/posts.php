<?php
// $__component__posts_pdos

if ($__component__post_pdos) {
  if ($__component__post_pdos instanceof PDOStatement) {
    $_fetchassoc_ = $__component__post_pdos->fetchAll(PDO::FETCH_ASSOC);
  } else {
    die;
  }
} else {
  die;
}

foreach ($_fetchassoc_ as $row) {
  $__component__post_id = $row['ID'];
  include ('post.php');
}