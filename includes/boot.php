<?php
defined('ABSPATH') || exit;

pls_autoload('App', dirname(__DIR__));
set_exception_handler('pls_exception_handler');
include_once 'app.php';