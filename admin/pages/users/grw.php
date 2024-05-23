<?php require_once '../../../includes/c-init.php';

API_header();

authAdmin();

$user = get_val('usr');

if (!$user) {
  _404_();
}

db()->TABLE('users')->UPDATE('id = ?')->SET('admin = 1')->Run([$user]);

redirect('./');