<?php require_once '../../../includes/c-init.php';

API_header();

authAdmin();

const ajax = new ajaxAPI();

$title = get_val('title');
$author = getCurrentUserInfo_prop('ID');
$cat = intval(get_val('cat'));
$content = get_val('content');
$desc = get_val('desc');

$_inps_arr = ['title' => $title, 'category' => $cat, 'content' => $content, 'description' => $desc];
$_inps_f = [
  'title' => 'string | required',
  'category' => 'int | required',
  'content' => 'string | required',
  'description' => 'string | required'
];

[$inputs, $errors] = filter($_inps_arr, $_inps_f);

$_SUBMITED = setted('create');

$errors = $_SUBMITED ? $errors : [];
$_COND = count($errors) == 0;

// PROCESSOR
$__PROCESS__CALLBACK__ = function () {
  global $title, $cat, $content, $author, $desc;
  $upload = uploadFile_secure('photo', prefix: 'post.photo.');
  if (!$upload) {
    throw new Exception('Failed! Cant Upload File');
  }
  db()->TABLE('posts')
    ->INSERT('title, content, category, author, image, description')->VALUES('?, ?, ?, ?, ?, ?')
    ->Run([$title, $content, $cat, $author, $upload, $desc]);

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