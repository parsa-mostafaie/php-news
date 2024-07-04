<?php include_once '../includes/c-init.php';

function EditAllowed($post_id)
{
  Auth::authAdmin(Post::canEdited($post_id) ? 0 : 2);
}