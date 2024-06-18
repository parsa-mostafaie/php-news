<?php require_once '../../../includes/c-init.php';

API_header();

authAdmin();

$post = get_val('post');

if (!$post) {
  _404_();
}

db()->TABLE('posts')->UPDATE('id = ?')
  ->SET(['verify' => 1, 'verify_date' => 'current_timestamp()'])->Run([$post]);

redirect('./');