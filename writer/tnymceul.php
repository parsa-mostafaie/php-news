<?php
include_once '../../../includes/c-init.php';
// /***************************************************
//  * Only these origins are allowed to upload images *
//  ***************************************************/
// $accepted_origins = array("http://localhost", "http://192.168.1.1", "https://plus.dev");

/*********************************************
 * Change this line to set the upload folder *
 *********************************************/
$imageFolder = web_url(c_url('/images/'));

API_header();
Auth::authAdmin();

// Don't attempt to process the upload on an OPTIONS request
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
  header("Access-Control-Allow-Methods: POST, OPTIONS");
  return;
}

try {
  $file = uploadFile_secure('file');
  if (!$file) {
    _500_();
  }
  // Successfull:
  echo json_encode(array('location' => web_url(urlOfUpload($file))));
} catch (Exception $ex) {
  $status = $ex->getCode();
  if ($status == 400) {
    _400_();
  }
  _404_(); // Unknown Error!
}

