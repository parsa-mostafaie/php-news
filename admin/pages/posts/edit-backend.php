<?php require_once '../../../includes/c-init.php';

pls_validate_http_method('post'); // Should be post, for file uploads

API_header();

authAdmin();

const ajax = new ajaxAPI();

$title = get_val('title');
$cat = intval(get_val('cat'));
$content = get_val('tiny');
$desc = get_val('desc');
$post_id = intval(get_val('post'));

$_inps_arr = ['title' => $title, 'category' => $cat, 'content' => $content, 'description' => $desc];
$_inps_f = [
  'title' => 'string | required',
  'category' => 'int | required',
  'content' => 'string | required',
  'description' => 'string'
];

[$inputs, $errors] = filter($_inps_arr, $_inps_f);

$_SUBMITED = setted('edit');

$errors = $_SUBMITED ? $errors : [];
$_COND = count($errors) == 0;

// PROCESSOR
$__PROCESS__CALLBACK__ = function () {
  global $title, $cat, $content, $post_id, $desc;
  if (!secure_form(secure_form_enum::get)) {
    ajax->err('ارسال ناایمن');
  }

  PostImage::setFromInput($post_id, 'photo');

  db()->TABLE('posts')
    ->UPDATE('id=?')->SET(
      [
        'title' => '?',
        'content' => '?',
        'category' => '?',
        'description' => '?',
        'updated_at' => 'current_timestamp()'
      ]
    )
    ->Run([$title, $content, $cat, $desc, $post_id]);

};

$__PROCESS__SUCCESS__ = function () {
  secure_form(secure_form_enum::expire);
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