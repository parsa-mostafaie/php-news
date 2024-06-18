<?php
require_once '../includes/c-init.php';

$ctext = get_val('ctext');

$_inps_arr = [$ctext];

[$inputs, $errors] = filter(['comment text' => $ctext], ['comment text' => 'string | required']);

$_SUBMITED = setted('comment');

$errors = $_SUBMITED ? $errors : [];
$_COND = count($errors) == 0;

// PROCESSOR
$__PROCESS__CALLBACK__ = function () {
  global $ctext, $post_id;
  if (!secure_form(secure_form_enum::get)) {
    throw new Exception('ارسال ناایمن');
  }

  if (!canlogin()) {
    throw new Exception('ابتدا وارد شوید');
  }

  db()->TABLE('comments')->INSERT(['user_id' => '?', 'text' => '?', 'post' => '?'])
    ->Run([getCurrentUserInfo_prop('ID'), $ctext, $post_id]);
};

$__PROCESS__SUCCESS__ = function () {
  secure_form(secure_form_enum::expire);
  echo '<div class="alert alert-success" dir="rtl">کامنت در صف تایید است!</div>';
};

$__PROCESS__FAILED__ = $__DEFAULT__PROCESS_FAILED;

function errors($field)
{
  global $errors;
  return isset($errors[$field]) ? $errors[$field] : '';
}