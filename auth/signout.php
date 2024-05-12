<?php include_once __DIR__ . '/../includes/c-init.php';

API_header();
signout();

redirect(c_url('/', false));
