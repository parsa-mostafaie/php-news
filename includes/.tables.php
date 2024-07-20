<?php include_once 'c-init.php';
use App\Auth;

function categories_table()
{
  $actions = function ($data) {
    ?>
    <a href="<?= c_url('/admin/pages/categories/edit.php?cat=') . $data['ID'] ?>"
      class="btn btn-sm btn-outline-dark">ویرایش</a>
    <a type="submit" http-method="DELETE" danger-btn ajax-reload='#a_cats_tbl'
      href="<?= c_url('/admin/pages/categories/rem.php?cat=') . $data['ID'] ?>"
      class="btn btn-sm btn-outline-danger">حذف</a>
    <?php
    return '';
  };
  $idl = function ($data) {
    ['v' => $v] = $data;
    return c_url('/search.php?cat=' . $v);
  };
  $st = db()->TABLE('categories')->SELECT('ID, Name as `عنوان`')->Run();
  tablify($st, 'عملیات', $actions, head_link: $idl);
}

function users_table($last = true, $id = "a_users_tbl")
{
  $actions = function ($data) use ($id) {
    $c_admin = getCurrentUserInfo_prop('admin');
    if ($data['ID'] == getCurrentUserInfo_prop('ID') || $c_admin < 2) {
      return '';
    } ?>
    <?php if ($data['admin'] == 1): ?>
      <a http-method="patch" ajax-reload="#<?= $id ?>"
        href="<?= c_url('/admin/pages/users/grw.php?admin&usr=') . $data['ID'] ?>" class="btn btn-sm btn-outline-dark">ارتقا
        به ادمین</a>
    <?php endif;
    if ($data['admin'] < 1): ?>
      <a http-method="patch" ajax-reload="#<?= $id ?>" href="<?= c_url('/admin/pages/users/grw.php?usr=') . $data['ID'] ?>"
        class="btn btn-sm btn-outline-dark">ارتقا به نویسنده</a>
    <?php else: ?>
      <a http-method="patch" ajax-reload="#<?= $id ?>" href="<?= c_url('/admin/pages/users/shrnk.php?usr=') . $data['ID'] ?>"
        class="btn btn-sm btn-danger">تنزل</a>
    <?php endif;
  };
  $idl = function ($data) {
    return '#';
  };
  $st = db()->TABLE('users')->SELECT('ID, CONCAT(firstname, " ", lastname) as `نام`, admin')->ORDER_BY('created_at desc');
  if ($last) {
    $st->LIMIT(5);
  }
  $st = $st->Run();
  tablify($st, 'عملیات', $actions, head_link: $idl, hidden: ['admin']);
}

function comments_table($last = true, $by = null, $id = 'a_comments_tbl')
{
  $actions = function ($data) use ($id) {
    if (!$data['verify']): ?>
      <a http-method="PUT" ajax-reload="#<?= $id ?>"
        href="<?= Auth::isRole(2) ? c_url('/admin/pages/comments/verify.php?com=' . $data['ID']) : '#' ?>"
        class="btn btn-sm btn-outline-info">در
        انتظار تایید</a>
    <?php else: ?>
      <a href="#" class="btn btn-sm btn-outline-dark disabled">تایید شده</a>
    <?php endif; ?>
    <?php if (Auth::isRole(2)): ?>
      <a danger-btn http-method="DELETE" ajax-reload="#<?= $id ?>"
        href="<?= c_url('/admin/pages/comments/rem.php?com=' . $data['ID']) ?>" class="btn btn-sm btn-outline-danger">حذف</a>
    <?php endif ?>
  <?php
  };

  $st =
    db()->TABLE('comments as c', true)->
      SELECT(
        'c.verify, c.ID, (CONCAT(u.firstname, " ",u.lastname)) as `نام`, Text as `متن کامنت`'
      )
      ->ON('u.ID = c.user_id', 'users as u')->ORDER_BY('c.date desc');
  if ($last) {
    $st->LIMIT(5);
  }
  if ($by) {
    $st->WHERE('u.id = ?');
  }
  $st = $st->Run($by ? [$by] : []);
  $idl = function ($data) {
    ['v' => $v] = $data;
    $post = db()->TABLE('comments', alias: 'c')
      ->SELECT('p.id')->ON('p.id = c.post', 'posts as p')
      ->WHERE('c.id = ' . $v)->Run()->fetchColumn();
    return c_url('/posts/' . $post . '#c' . $v);
  };
  $ril = function ($data) {
    return $data['ID'];
  };
  tablify(
    $st,
    Auth::isRole(1) ? 'عملیات' : null,
    $actions,
    hidden: ['verify'],
    head_link: $idl,
    rowid: $ril,
    empty_msg: '<div class="alert alert-dark">هیچ کامنتی پیدا نشد!</div>'
  );
}


function posts_table($last = true, $by = null, $id = "a_posts_tbl")
{
  $actions = function ($data) use ($id) {
    if (!$data['verify']): ?>
      <a http-method="PUT" ajax-reload="#<?= $id ?>"
        href="<?= Auth::isRole(2) ? c_url('/admin/pages/posts/verify.php?post=' . $data['ID']) : '#' ?>"
        class="btn btn-sm btn-outline-info">در انتظار تایید</a>
    <?php else: ?>
      <a href="#" class="btn btn-sm btn-outline-dark disabled">تایید شده</a>
    <?php endif; ?>
    <?php if (Post::canEdited($data['ID'])): ?>
      <a href="<?= c_url('/writer/edit.php?post=' . $data['ID']) ?>" class="btn btn-sm btn-outline-dark">ویرایش</a>
    <?php endif; ?>
    <?php if (Auth::isRole(2)): ?>
      <a ajax-reload="#<?= $id ?>" href="<?= c_url('/admin/pages/posts/rem.php?post=' . $data['ID']) ?>" danger-btn
        class="btn btn-sm btn-outline-danger" http-method="DELETE">حذف</a>
    <?php endif; ?>
  <?php
  };
  $_ = 'p.verify, p.ID, Title as `عنوان`, (CONCAT(u.firstname, " ",u.lastname)) as `نویسنده`';
  $st = db()->TABLE('posts as p', true)->
    SELECT($_)->
    ON('u.ID = p.author', 'users as u')
    ->ORDER_BY('p.created_at desc');
  if ($last) {
    $st->LIMIT(5);
  }
  if ($by) {
    $st->WHERE('p.author = ?');
  }
  $st = $st->Run($by ? [$by] : []);
  $idl = function ($data) {
    ['v' => $v] = $data;
    return c_url('/posts/' . $v);
  };
  $ril = function ($data) {
    return $data['ID'];
  };

  tablify(
    $st,
    Auth::isRole(1) ? 'عملیات' : null,
    $actions,
    hidden: ['verify'],
    head_link: $idl,
    rowid: $ril,
    empty_msg: '<div class="alert alert-dark">هیچ پستی پیدا نشد!</div>'
  );
}