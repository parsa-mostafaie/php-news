<?php require_once '../../../includes/c-init.php';

use App\Auth;

pls_validate_http_method(['post', 'put', 'options', 'patch']);

API_header();

Auth::authAdmin(2);

$user = get_val('usr');

if (!$user) {
  _404_();
}

$role = urlParam_Sended('admin') ? 2 : 1;

$user = new User(intval($user));

$user->admin = $role;

$user->update();