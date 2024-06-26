<?php require_once '../../../includes/c-init.php';

pls_validate_http_method(['post', 'put', 'options', 'patch']);

API_header();

authAdmin();

$user = get_val('usr');

if (!$user) {
  _404_();
}

shrinkDownUser($user);

redirect('./');