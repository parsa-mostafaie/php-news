<?php require_once '../../../includes/c-init.php';

use App\Auth;

pls_validate_http_method('delete');

API_header();

Auth::authAdmin(2);

$cat = get_val('cat');

if (!$cat) {
  _404_();
}

db()->TABLE('categories')->DELETE('id = ?')->Run([$cat]);
