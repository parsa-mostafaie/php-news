<?php include_once 'c-init.php';
use App\Auth;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use pluslib\Collections\Collection;

function categories_table()
{
  $fields = [
    '#',
    'عنوان',
    'عملیات'
  ];

  $values = Category::all()->all();

  $empty = function () {
    ?>
    <div class="alert alert-primary">هیچ دسته بندی فعلا وجود ندارد!</div>
    <?php
  };

  return tablify_pro($fields, $values, function (Category $cat, callable $td_render) {
    $td_render(function () use ($cat) {
      ?>
      <a href="<?= c_url('/search.php?cat=' . $cat->_id()) ?>"><?= $cat->_id(); ?></a>
      <?php
    });

    $td_render($cat->Name);

    $td_render(function () use ($cat) {
      ?>
      <a href="<?= c_url('/admin/pages/categories/edit.php?cat=') . $cat->_id() ?>"
        class="btn btn-sm btn-outline-dark">ویرایش</a>
      <a type="submit" http-method="DELETE" danger-btn ajax-reload='#a_cats_tbl'
        href="<?= c_url('/admin/pages/categories/rem.php?cat=') . $cat->_id() ?>"
        class="btn btn-sm btn-outline-danger">حذف</a>
      <?php
      return '';
    });

  }, $empty);
}

function users_table($last = true, $id = "a_users_tbl")
{
  $fields = [
    '#',
    'نام',
    'عملیات'
  ];

  $values = User::select();

  if ($last) {
    $values->limit(5);
  }

  $values = $values->get()->all();

  $empty = function () {
    ?>
    <div class="alert alert-primary">هیچ دسته بندی فعلا وجود ندارد!</div>
    <?php
  };

  return tablify_pro($fields, $values, function (User $user, callable $td_render) use ($id) {
    $c_admin = User::current()->admin;
    $has_actions = !($user->_id() == User::current()->_id() || $c_admin < 2);

    $td_render([
      function () use ($user) {
        ?>
      <a href="#"><?= $user->_id() ?></a>
      <?php
      },
      $user->fullname()
    ]);

    if ($has_actions) {
      $td_render(
        function () use ($user, $id) {
          ?>
        <?php if ($user->admin == 1): ?>
          <a http-method="patch" ajax-reload="#<?= $id ?>"
            href="<?= c_url('/admin/pages/users/grw.php?admin&usr=') . $user->ID ?>" class="btn btn-sm btn-outline-dark">ارتقا
            به ادمین</a>
        <?php endif;
          if ($user->admin < 1): ?>
          <a http-method="patch" ajax-reload="#<?= $id ?>" href="<?= c_url('/admin/pages/users/grw.php?usr=') . $user->_id() ?>"
            class="btn btn-sm btn-outline-dark">ارتقا به نویسنده</a>
        <?php else: ?>
          <a http-method="patch" ajax-reload="#<?= $id ?>" href="<?= c_url('/admin/pages/users/shrnk.php?usr=') . $user->_id() ?>"
            class="btn btn-sm btn-danger">تنزل</a>
        <?php endif;
        }
      );
    } else {
      $td_render('');
    }
  }, $empty);
}

function comments_table($last = true, $by = null, $id = 'a_comments_tbl')
{
  $actions = function ($data) use ($id) {
    $danger = $data['verify'] ? 'danger-btn' : '';
    $url = c_url('/writer/comment.php' . '?com=' . $data['ID'] . ($data['verify'] ? '' : '&v=1'));
    $href = Post::canEdited($data['pid']) ?
      "href='$url' http-method='PUT' ajax-reload='#$id' $danger" : '';
    $disable = Post::canEdited($data['pid']) ? '' : 'disabled';
    if (!$data['verify']): ?>
      <a <?= $href ?> class="btn btn-sm btn-outline-info <?= $disable ?>">در
        انتظار تایید</a>
    <?php else: ?>
      <a <?= $href ?> class="btn btn-sm btn-success <?= $disable ?>">تایید شده</a>
    <?php endif; ?>
    <?php if (Auth::isRole(2)): ?>
      <a danger-btn http-method="DELETE" ajax-reload="#<?= $id ?>"
        href="<?= c_url('/admin/pages/comments/rem.php?com=' . $data['ID']) ?>" class="btn btn-sm btn-outline-danger">حذف</a>
    <?php endif ?>
  <?php
  };

  $st =
    db()->TABLE('comments as c')->
      select([])->selectRaw(
        'p.id as pid, c.verify, c.ID, (CONCAT(u.firstname, " ",u.lastname)) as `نام`, Text as `متن کامنت`'
      )
      ->ON('u.ID = c.user_id', 'users as u')
      ->on('p.id = c.post', 'posts p')
      ->orderBy('c.date','desc');
  if ($last) {
    $st->LIMIT(5);
  }
  if ($by) {
    $st->WHERE('u.id = ? OR p.author = ?');
  }
  $st = $st->Run($by ? [$by, $by] : []);
  $idl = function ($kv, $data) {
    ['v' => $v] = $kv;
    $post = $data['pid'];
    return c_url('/posts/' . $post . '#c' . $v);
  };
  $ril = function ($data) {
    return $data['ID'];
  };
  tablify(
    $st,
    Auth::isRole(1) ? 'عملیات' : null,
    $actions,
    hidden: ['verify', 'pid'],
    head_link: $idl,
    rowid: $ril,
    empty_msg: '<div class="alert alert-dark">هیچ کامنتی پیدا نشد!</div>'
  );
}


function posts_table($last = true, $by = null, $id = "a_posts_tbl")
{
  $actions = function ($data) use ($id) {
    $danger = $data['verify'] ? 'danger-btn' : '';
    $url = c_url('/admin/pages/posts/' . ($data['verify'] ? 'un' : '') . 'verify.php?post=' . $data['ID']);
    $attrs = Auth::isRole(2) ? "href='$url' http-method='PUT' ajax-reload='#$id' $danger" : '';

    $disable = Auth::isRole(2) ? '' : 'disabled';

    if (!$data['verify']): ?>
      <a <?= $attrs ?> class="btn btn-sm btn-outline-info <?= $disable ?>">در انتظار تایید</a>
    <?php else: ?>
      <a <?= $attrs ?> class="btn btn-sm btn-success <?= $disable ?>">تایید شده</a>
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
  $st = db()->TABLE('posts as p')->
    SELECT([])->selectRaw($_)->
    ON('u.ID = p.author', 'users as u')
    ->orderBy('p.created_at','desc');
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