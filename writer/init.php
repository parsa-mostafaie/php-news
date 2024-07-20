<?php include_once '../includes/c-init.php';

use App\Auth;
use App\Models\Post;

function EditAllowed($post_id)
{
  Auth::authAdmin(Post::canEdited($post_id) ? 0 : 2);
}