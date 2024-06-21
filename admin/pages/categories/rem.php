<?php require_once '../../../includes/c-init.php';

pls_validate_http_method('delete');

API_header();

authAdmin();

$cat = get_val('cat');

if (!$cat) {
  _404_();
}

db()->TABLE('categories')->DELETE('id = ?')->Run([$cat]);

redirect('./');