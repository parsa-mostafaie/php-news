<?php require_once '../../../includes/c-init.php';

pls_validate_http_method('delete');

API_header();

authAdmin();

$post = get_val('post');

if(!$post){
  _404_();
}

db()->TABLE('posts')->DELETE('id = ?')->Run([$post]);
