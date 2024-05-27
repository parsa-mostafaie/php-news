<?php require_once '../../../includes/c-init.php';

API_header();

authAdmin();

$user = get_val('usr');

if (!$user) {
  _404_();
}

shrinkDownUser($user);

redirect('./');