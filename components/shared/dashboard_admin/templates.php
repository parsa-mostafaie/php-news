<?php
$sidebarTemplate = [
  [
    'hide' => false,
    'route' => '/',
    'icon' => 'house-fill',
    'title' => 'داشبورد',
    'href' => $dashboard,
    'sup' => 'dashboard',
    'subs' => [
      [
        'hide' => false,
        'route' => '/posts',
        'icon' => 'file-earmark-image-fill',
        'title' => 'مقالات',
        'href' => $dashboardPages . 'posts/index.php'
      ],
      [
        'hide' => false,
        'route' => '/com',
        'icon' => 'chat-left-text-fill',
        'title' => 'کامنت ها',
        'href' => $dashboardPages . 'comments/index.php'
      ]
    ]
  ],
  [
    'hide' => !isAdmin(),
    'route' => '/',
    'icon' => 'person-check-fill',
    'title' => 'پنل ادمین',
    'href' => $admin,
    'sup' => 'admin',
    'subs' => [
      [
        'hide' => false,
        'route' => '/posts',
        'icon' => 'file-earmark-image-fill',
        'title' => 'مقالات',
        'href' => $adminPages . 'posts/index.php'
      ],
      [
        'hide' => false,
        'route' => '/com',
        'icon' => 'chat-left-text-fill',
        'title' => 'کامنت ها',
        'href' => $adminPages . 'comments/index.php'
      ],
      [
        'hide' => false,
        'route' => '/cat',
        'icon' => 'folder-fill',
        'title' => 'دسته بندی',
        'href' => $adminPages . 'categories/index.php'
      ],
      [
        'hide' => false,
        'route' => '/usr',
        'icon' => 'person-fill',
        'title' => 'کاربران',
        'href' => $adminPages . 'users/index.php'
      ]
    ]
  ],

  [
    'hide' => false,
    'icon' => 'newspaper',
    'title' => 'صفحه اصلی',
    'href' => c_url('/'),
  ],
  [
    'hide' => !isAdmin(),
    'icon' => 'database-fill',
    'title' => 'مدیریت پایگاه داده',
    'href' => '/phpmyadmin/'
  ],
  [
    'hide' => false,
    'icon' => 'box-arrow-left',
    'title' => 'خروج',
    'href' => c_url('/auth/signout.php'),
  ],
];