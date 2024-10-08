<?php require_once '../../../includes/c-init.php';

use pluslib\ajaxAPI;
use App\Auth;
use App\Models\Category;

pls_validate_http_method('put');

API_header();

Auth::authAdmin(2);

const ajax = new ajaxAPI();

$cat = get_val('cat');

$_inps_arr = ['نام' => $cat];
$_inps_f = [
  'نام' => 'string | unique:categories,name | required',
];

[$inputs, $errors] = filter_persian($_inps_arr, $_inps_f);

$_SUBMITED = setted('create');

$errors = $_SUBMITED ? $errors : [];
$_COND = count($errors) == 0;

// PROCESSOR
$__PROCESS__CALLBACK__ = function () {
  global $cat;
  // db()->TABLE('categories')->INSERT(['name' => '?'])->Run([$cat]);

  (new Category)->fill(['Name' => $cat])->save();
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