<?php require_once '../../../includes/c-init.php';

use App\Auth;
use App\Models\Post;

pls_validate_http_method('put');

API_header();

Auth::authAdmin(2);

$post = get_val('post');

if (!$post) {
  _404_();
}

$Post = Post::find($post);

if (!$Post)
  _404_();

$Post->unverify();
