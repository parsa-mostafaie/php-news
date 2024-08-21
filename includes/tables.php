<?php include_once 'c-init.php';
use App\Auth;
use App\Models\Category;
use App\Models\Comment;
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

  return tablify($fields, $values, function (Category $cat, callable $td_render) {
    $td_render(function () use ($cat) {
      ?>
      <a href="<?= $cat->get_url() ?>"><?= $cat->_id(); ?></a>
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
    <div class="alert alert-primary">هیچ کاربری فعلا وجود ندارد!</div>
    <?php
  };

  return tablify($fields, $values, function (User $user, callable $td_render) use ($id) {
    $c_admin = User::current()->admin;
    $has_actions = !($user->_id() == User::current()->_id() || $c_admin < 2);

    $td_render([
      function () use ($user) {
        ?>
      <a href="#"><?= $user->_id() ?></a>
      <?php
      },
      $user->fullname
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
  $fields = [
    '#',
    'نام',
    'پست',
    'در پاسخ به',
    'متن کامنت',
    'عملیات'
  ];

  $values = Comment::select();

  if ($last) {
    $values->limit(5);
  }

  if ($by) {
    $values->on(cond('u.id', expr('comments.user_id')), 'users u');
    $values->on(cond('p.id', expr('comments.post_id')), 'posts p');
    $values->where('u.id = :id OR p.user_id = :id');
  }

  $values->orderBy('comments.date', 'desc');

  $values = $values->get($by ? [':id' => $by] : [])->all();

  $empty = function () {
    ?>
    <div class="alert alert-primary">هیچ کامنتی فعلا وجود ندارد!</div>
    <?php
  };

  return tablify($fields, $values, function (Comment $comment, callable $td_render) use ($id) {
    $td_render([
      function () use ($comment) {
        ?>
      <a href="<?= $comment->get_url() ?>"><?= $comment->_id() ?></a>
      <?php
      },
      $comment->author->fullname,
      function () use ($comment) {
        ?>
      <a href="<?= $comment->_post->get_url() ?>"><?= truncate($comment->_post->title) ?></a>
      <?php
      }
    ]);

    $td_render(!$comment->parent_id ? '' : function () use ($comment) {
      ?>
      <a href="<?= $comment->parent->get_url() ?>"><?= $comment->parent->author->fullname ?></a>
      <?php
    });

    $td_render(truncate($comment->text));

    $td_render(function () use ($comment, $id) {
      $danger = $comment->verified() ? 'danger-btn' : '';

      $url = url(c_url('/writer/comment.php' . '?com=' . $comment->_id() . ($comment->Verify ? '' : '&v=1')));

      $href = $comment->can_verified() ?
        "href='$url' http-method='PUT' ajax-reload='#$id' $danger" : '';

      $disable = $comment->can_verified() ? '' : 'disabled';
      if (!$comment->verified()): ?>
        <a <?= $href ?> class="btn btn-sm btn-outline-info <?= $disable ?>">در
          انتظار تایید</a>
      <?php else: ?>
        <a <?= $href ?> class="btn btn-sm btn-success <?= $disable ?>">تایید شده</a>
      <?php endif; ?>
      <?php if (Auth::isRole(2)): ?>
        <a danger-btn http-method="DELETE" ajax-reload="#<?= $comment->_id() ?>"
          href="<?= url(c_url('/admin/pages/comments/rem.php?com=' . $comment->_id())) ?>"
          class="btn btn-sm btn-outline-danger">حذف</a>
      <?php endif ?>
    <?php
    });
  }, $empty);
}


function posts_table($last = true, $by = null, $id = "a_posts_tbl")
{

  $fields = [
    '#',
    'عنوان',
    'نویسنده',
    'عملیات'
  ];

  $values = Post::select();

  if ($last) {
    $values->limit(5);
  }

  if ($by) {
    $values->where('posts.user_id', expr(':id'));
  }

  $values->orderBy('posts.created_at', 'desc');

  $values = $values->get($by ? [':id' => $by] : [])->all();

  $empty = function () {
    ?>
    <div class="alert alert-primary">هیچ پستی فعلا وجود ندارد!</div>
    <?php
  };

  return tablify($fields, $values, function (Post $post, callable $td_render) use ($id) {
    $td_render(function () use ($post) {
      ?>
      <a href="<?= $post->get_url() ?>"><?= $post->_id() ?></a>
      <?php
    });

    $td_render($post->title);
    $td_render($post->author->fullname);

    $td_render(Auth::isRole(2) ? function () use ($post, $id) {
      $danger = $post->published() ? 'danger-btn' : '';
      $url = $post->_un_publish_url();
      $attrs = Auth::isRole(2) ? "href='$url' http-method='PUT' ajax-reload='#$id' $danger" : '';

      $disable = Auth::isRole(2) ? '' : 'disabled';

      if (!$post['verify']): ?>
        <a <?= $attrs ?> class="btn btn-sm btn-outline-info <?= $disable ?>">در انتظار تایید</a>
      <?php else: ?>
        <a <?= $attrs ?> class="btn btn-sm btn-success <?= $disable ?>">تایید شده</a>
      <?php endif; ?>
      <?php if ($post->canEdit()): ?>
        <a href="<?= $post->edit_url() ?>" class="btn btn-sm btn-outline-dark">ویرایش</a>
      <?php endif; ?>
      <?php if (Auth::isRole(2)): ?>
        <a ajax-reload="#<?= $id ?>" href="<?= $post->rem_url() ?>" danger-btn class="btn btn-sm btn-outline-danger"
          http-method="DELETE">حذف</a>
      <?php endif; ?>
    <?php
    } : null);
  }, $empty);
}