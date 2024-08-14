<?php require_once '../includes/c-init.php';

use App\Models\User;
use pluslib\ajaxAPI;
use pluslib\Support\Facades\DB;

API_header();

const ajax = new ajaxAPI();

$fname = get_val('fname');
$lname = get_val('lname');
// $uname = get_val('uname');
$pword = get_val('pass');
$mail = get_val('email');

$fname = trim($fname);
$lname = trim($lname);
// $uname = trim($uname);

$_inps_arr = [/*'username' => $uname,*/
  'رمزعبور' => $pword,
  'نام' => $fname,
  'نام خانوادگی' => $lname,
  'ایمیل' => $mail
];
$_inps_f = [
  // 'username' => 'string | username | required',
  'رمزعبور' => 'string | required',
  'ایمیل' => 'string | email | unique:users,mail | required',
  'نام' => 'string | required',
  'نام خانوادگی' => 'string | required'
];
[$inputs, $errors] = filter_persian($_inps_arr, $_inps_f);

$_SUBMITED = setted('signup');

$errors = $_SUBMITED ? $errors : [];
$_COND = count($errors) == 0;

// PROCESSOR
$__PROCESS__CALLBACK__ = function () {
  global $fname, $lname, $pword, $mail;

  $uname = substr($mail, 0, strrpos($mail, '@'));

  $count = User::select()->where('username', "LIKE", expr("?"))->count([$uname]);

  if ($count) {
    $uname .= "__" . uniqid();
  }

  DB::transaction(function () use ($fname, $lname, $uname, $pword, $mail) {
    add_user($fname, $lname, $uname, $pword);
    update_users('username="' . $uname . '"', 'mail=?', [$mail]);
  });
};

$__PROCESS__SUCCESS__ = function () {
  global $uname, $pword;
  loginWith($uname, $pword);

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