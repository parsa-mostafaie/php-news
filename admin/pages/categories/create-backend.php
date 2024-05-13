<?php require_once '../../../includes/c-init.php';

API_header();

authAdmin();

const ajax = new ajaxAPI();

$cat = get_val('cat');

$_inps_arr = ['name' => $cat];
$_inps_f = [
  'name' => 'string | required',
];

[$inputs, $errors] = filter($_inps_arr, $_inps_f);

$_SUBMITED = setted('create');

$errors = $_SUBMITED ? $errors : [];
$_COND = count($errors) == 0;

// PROCESSOR
$__PROCESS__CALLBACK__ = function () {
  global $cat;
  db()->TABLE('categories')->INSERT('name')->VALUES('?')->Run([$cat]);
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