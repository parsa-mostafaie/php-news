<?php require_once '../../../includes/c-init.php';

use App\Auth;
use App\Models\Category;

pls_validate_http_method('delete');

API_header();

Auth::authAdmin(2);

$cat = get_val('cat');

if (!$cat) {
  _404_();
}

$cat = Category::find($cat);

!$cat && _404_();

$cat->delete();