<?php include_once __DIR__ . '/../includes/c-init.php';

API_header();

if(request_method('get')){
  redirectBack();
}