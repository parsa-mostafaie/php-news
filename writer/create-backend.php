<?php require_once 'init.php';

use pluslib\ajaxAPI;
use App\Auth;
use App\Models\Post;
use App\Models\PostImage;
use App\Models\User;

pls_validate_http_method('post'); // Should be post, for file uploads

API_header();

Auth::authAdmin();

const ajax = new ajaxAPI();

$title = get_val('title');
$author = User::current()->_id();
$cat = intval(get_val('cat'));
$content = get_val('tiny');
$desc = get_val('desc');

$_inps_arr = ['عنوان' => $title, 'دسته بندی' => $cat, 'محتوا' => $content, 'توضیحات' => $desc];
$_inps_f = [
  'عنوان' => 'string | required',
  'دسته بندی' => 'int | required',
  'محتوا' => 'string | required',
  'توضیحان' => 'string'
];

[$inputs, $errors] = filter_persian($_inps_arr, $_inps_f);

$_SUBMITED = setted('create');

$errors = $_SUBMITED ? $errors : [];
$_COND = count($errors) == 0;

// PROCESSOR
$__PROCESS__CALLBACK__ = function () {
  global $title, $cat, $content, $author, $desc;

  $post = new Post;

  $post->title = $title;
  $post->content = $content;
  $post->category_id = $cat;
  $post->user_id = $author;
  $post->description = $desc;

  $post->save();

  $upload = PostImage::setFromInput($post->_id(), 'photo');

  if (!$upload) {
    // db()->TABLE('posts')->DELETE('id = ?')->Run([$id]); 
    // Delete Record on upload fail! Can be replaced by transcation in future
    $post->delete();
    throw new Exception('فایل آپلود نشد!');
  }

  ajax->redirect('./');
};

$__PROCESS__SUCCESS__ = function () {
  ajax->redirect('./');
};

$__PROCESS__FAILED__ = function (Exception $ex, $isPDO) {
  global $errors;
  if (count($errors) > 0) {
    ajax->err($errors);
  }
  $err = $ex instanceof PDOException ? $ex->errorInfo[2] : null;
  $msg = $isPDO ? $err : $ex->getMessage();
  ajax->err($msg);
};

process_form();
ajax->send();