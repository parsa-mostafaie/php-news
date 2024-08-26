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

  return tablify_optimized($fields, $values, $empty);
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

  $values = $values->orderBy('created_at', 'desc')->get()->all();

  $empty = function () {
    ?>
    <div class="alert alert-primary">هیچ کاربری فعلا وجود ندارد!</div>
    <?php
  };

  return tablify_optimized($fields, $values, $empty, params: [$id]);
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

  $values = Comment::select('comments.*');

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

  return tablify_optimized($fields, $values, $empty, params: [$id]);
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

  return tablify_optimized($fields, $values, $empty, params: [$id]);
}