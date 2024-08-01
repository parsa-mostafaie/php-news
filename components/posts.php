<?php
// $__component__posts

use pluslib\Collections\Collection;

if ($__component__posts) {
  if ($__component__posts instanceof Collection) {
    foreach ($__component__posts as $row) {
      $__component__post = $row;
      include 'post.php';
    }
  } else {
    die;
  }
} else {
  die;
}