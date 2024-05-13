<?php require_once '../../../includes/c-init.php';

API_header();

authAdmin();

$cat = get_val('cat');

if(!$cat){
  _404_();
}

db()->TABLE('categories')->DELETE('id = ?')->Run([$cat]);

redirect('./');