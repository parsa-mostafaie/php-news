<?php require_once '../../../includes/c-init.php';

pls_validate_http_method('delete');

API_header();

Auth::authAdmin(2);

$com = get_val('com');

if (!$com) {
  _404_();
}

db()->TABLE('comments')->DELETE('id = ?')->Run([$com]);
