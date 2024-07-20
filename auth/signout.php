<?php include_once __DIR__ . '/../includes/c-init.php';

API_header();
App\Auth::logout();

redirect(c_url('/', false));
