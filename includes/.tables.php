<?php include_once 'c-init.php';

function categories_table()
{
  $actions = function ($data) {
    return '<a href="' . c_url('/admin/pages/categories/edit.php?cat=') . $data['ID'] . '" class="btn btn-sm btn-outline-dark">ویرایش</a>
                  <a href="' . c_url('/admin/pages/categories/rem.php?cat=') . $data['ID'] . '" class="btn btn-sm btn-outline-danger">حذف</a>';
  };
  $st = db()->TABLE('categories')->SELECT('ID, Name as `عنوان`')->Run();
  tablify($st, 'عملیات', $actions);
}

function comments_table($last = true)
{
  $actions = function ($data) {
    $nv = '<a href="' . c_url('/admin/pages/comments/verify.php?com=' . $data['ID']) . '" class="btn btn-sm btn-outline-info">در انتظار تایید</a>';
    $v = '<a href="#" class="btn btn-sm btn-outline-dark disabled">تایید شده</a>';
    $vb = $data['verify'] ? $v : $nv;
    return $vb . ' <a href="' . c_url('/admin/pages/comments/rem.php?com=' . $data['ID']) . '" class="btn btn-sm btn-outline-danger">حذف</a>';
  };
  $st = db()->TABLE('comments as c', true)->SELECT('c.verify, c.ID, (CONCAT(u.firstname, " ",u.lastname)) as `نام`, Text as `متن کامنت`')->ON('u.ID = c.user_id', 'users as u')->ORDER_BY('c.date desc');
  if ($last) {
    $st->LIMIT(5);
  }
  $st = $st->Run();
  tablify($st, 'عملیات', $actions, hidden: ['verify']);
}


function posts_table($last = true)
{
  $actions = function ($data) {
    $nv = '<a href="#" class="btn btn-sm btn-outline-info">در انتظار تایید</a>';
    $v = '<a href="#" class="btn btn-sm btn-outline-dark disabled">تایید شده</a>';
    $vb = $data['verify'] ? $v : $nv;
    return $vb . ' <a href="' . c_url('/admin/pages/edit.php') . '" class="btn btn-sm btn-outline-dark">ویرایش</a>' . ' <a href="#" class="btn btn-sm btn-outline-danger">حذف</a>';
  };
  $_ = 'p.verify, p.ID, Title as `عنوان`, (CONCAT(u.firstname, " ",u.lastname)) as `نویسنده`';
  $st = db()->TABLE('posts as p', true)->
    SELECT($_)->
    ON('u.ID = p.author', 'users as u')
    ->ORDER_BY('p.date desc');
  if ($last) {
    $st->LIMIT(5);
  }
  $st = $st->Run();
  tablify($st, 'عملیات', $actions, hidden: ['verify']);
}