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
    ->db(
      'plus_news'
    )
    ->init();