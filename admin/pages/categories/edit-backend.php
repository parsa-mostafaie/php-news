<?php require_once '../../../includes/c-init.php';

use App\Auth;
use pluslib\ajaxAPI;
use App\Models\Category;

pls_validate_http_method('put');

API_header();

Auth::authAdmin(2);

const ajax = new ajaxAPI();

$catn = (get_val('catn'));

$_inps_arr = ['نام' => $catn];
$_inps_f = [
  'نام' => 'string | required',
];

[$inputs, $errors] = filter_persian($_inps_arr, $_inps_f);

$_SUBMITED = setted('update');
$cat = intval(get_val('update'));

$errors = $_SUBMITED ? $errors : [];
$_COND = count($errors) == 0;

// PROCESSOR
$__PROCESS__CALLBACK__ = function () {
  global $cat, $catn;
  // db()->TABLE('categories')->UPDATE('ID = ' . $cat)->SET(['Name' => '?'])->Run([$catn]);
  $category = Category::find($cat);

  if (!$category)
    throw new Exception("دسته بندی پیدا نشد!");

  $category->name = $catn;

  $category->save();
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