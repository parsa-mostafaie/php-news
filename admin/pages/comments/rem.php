<?php require_once '../../../includes/c-init.php';

API_header();

authAdmin();

$com = get_val('com');

if(!$com){
  _404_();
}

db()->TABLE('comments')->DELETE('id = ?')->Run([$com]);

redirect('./');