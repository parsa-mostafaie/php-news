<?php require_once '../../../includes/c-init.php';

pls_validate_http_method('put');

API_header();

Auth::authAdmin(2);

$post = get_val('post');

if (!$post) {
  _404_();
}

db()->TABLE('posts')->UPDATE('id = ?')
  ->SET(['verify' => 1, 'verify_date' => 'current_timestamp()'])->Run([$post]);
