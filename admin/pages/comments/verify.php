<?php require_once '../../../includes/c-init.php';

use App\Auth;
use App\Models\Comment;

pls_validate_http_method('put');

API_header();

Auth::authAdmin(2);

$com = get_val('com');

if (!$com) {
  _404_();
}

$comment = Comment::find($com);

if (!$comment)
  _404_();

$comment->verify();