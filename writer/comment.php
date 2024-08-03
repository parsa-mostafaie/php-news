<?php require_once 'init.php';

use App\Auth;
use App\Models\Comment;

pls_validate_http_method('put');

API_header();

$com = get_val('com');

if (!$com) {
  _404_();
}

$comment = Comment::find($com);

if (!$comment)
  _404_();

Auth::authAdmin($comment->can_verified() ? 0 : 2);

if (intval(get_val('v')))
  $comment->verify();
else
  $comment->unverify();