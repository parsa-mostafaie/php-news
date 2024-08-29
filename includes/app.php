<?php

use App\Auth;
use pluslib\Support\Facades\Application;

return
  Application::configure(
    basepath: '/news',
    login_path: '/auth/login.html',
    auth_class: Auth::class,
    devmode: true,
    use_sha: false
  )
    ->withProviders(require realpath(__DIR__ . '/providers.php'))
    ->init();