<?php
require_once '../../../includes/c-init.php';

use App\Auth;
use App\Models\Post;

if(!Auth::canLogin()){
  _404_();
}

pls_validate_http_method('put');
API_header();

$post_id = get_val('post');
$react_id = get_val('react_id');

if (!is_numeric($post_id) || !is_numeric($react_id)) {
  _404_();
}

$post = Post::find($post_id);

if (!$post) {
  _404_();
}

$post->add_reaction($react_id);