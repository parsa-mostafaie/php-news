<?php require_once '../includes/c-init.php';

use App\Auth;
use pluslib\ajaxAPI;

API_header();

const ajax = new ajaxAPI();

$pword = get_val('pass');
$uname = get_val('uname');

function is_usermail(...$p)
{
  return is_username(...$p) || is_email(...$p);
}

$_inps_arr = ['رمزعبور'  => $pword, 'نام کاربری' => $uname];
$_inps_f = [
  'نام کاربری' => 'string | usermail | required',
  'رمزعبور' => 'string | required',
];

[$inputs, $errors] = filter_persian($_inps_arr, $_inps_f);

$_SUBMITED = setted('login');

$errors = $_SUBMITED ? $errors : [];
$_COND = count($errors) == 0;

// PROCESSOR
$__PROCESS__CALLBACK__ = function () {
  global $uname, $pword;
  if (!Auth::LoginWith($uname, $pword)) {
    throw new Exception('<b>لاگین شکست خورد!</b> نام کاربری یا پسورد اشتباه است!');
  }
};

$__PROCESS__SUCCESS__ = function () {
  ajax->redirect(redirectBack(c_url('/', false), true));
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