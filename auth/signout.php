<?php include_once __DIR__ . '/../includes/c-init.php';

App\Auth::logout();

redirect(c_url('/', false));
