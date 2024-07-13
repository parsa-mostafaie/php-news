<?php
require_once '../../../includes/c-init.php';

API_header();

const ajax = new ajaxAPI();

$ctext = get_val('ctext');
$parent = get_val('parent');
$parent = is_numeric($parent) ? intval($parent) : NULL;

$_inps_arr = [$ctext];

[$inputs, $errors] = filter(['comment text' => $ctext], ['comment text' => 'string | required']);

$_SUBMITED = setted('comment');

$post_id = get_val('post');

$errors = $_SUBMITED ? $errors : [];
$_COND = count($errors) == 0;

// PROCESSOR
$__PROCESS__CALLBACK__ = function () {
  global $ctext, $post_id, $parent;
  if (!secure_form(secure_form_enum::get)) {
    throw new Exception('ارسال ناایمن');
  }

  if (!Auth::canlogin()) {
    throw new Exception('ابتدا وارد شوید');
  }

  db()->TABLE('comments')->INSERT(['user_id' => '?', 'text' => '?', 'post' => '?', 'parent' => '?'])
    ->Run([getCurrentUserInfo_prop('ID'), $ctext, $post_id, $parent]);
};

$__PROCESS__SUCCESS__ = function () {
  secure_form(secure_form_enum::expire);
  echo ('<div class="alert alert-success" dir="rtl">کامنت در صف تایید است!</div>');
  ajax->send();
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