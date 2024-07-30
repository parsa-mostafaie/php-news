<?php require_once '../../../includes/c-init.php';

use App\Auth;
use App\Models\Post;

pls_validate_http_method('delete');

API_header();

Auth::authAdmin(2);

$post = get_val('post');

if(!$post){
  _404_();
}

$post = Post::find($post);

if (!$post)
  _404_();

$post->delete();