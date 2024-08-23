<?php
defined('ABSPATH') || exit;

include_once 'app.php';
pls_autoload('App', etc_url(c_url('')));
set_exception_handler('pls_exception_handler');