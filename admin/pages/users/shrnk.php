<?php require_once '../../../includes/c-init.php';

pls_validate_http_method(['post', 'put', 'options', 'patch']);

API_header();

Auth::authAdmin(2);

$user = get_val('usr');

if (!$user) {
  _404_();
}

$user = new User(intval($user));

$user->admin -= 1;

$user->update();