<?php

use pluslib\defaults\UserProfile as DefaultsUserProfile;
use pluslib\SQL\UploadBaseColumn;

defined('ABSPATH') || exit;

class PostImage extends UploadBaseColumn
{

  function __construct()
  {
    parent::__construct();

    $this->tbl = db()->TABLE('posts');
    $this->prefix = 'post.photo.';
    $this->colName = 'image';
    $this->altImage = web_url(c_url('/assets/images/1.jpg'));
  }
}

class UserProfile extends DefaultsUserProfile
{
  function __construct()
  {
    parent::__construct();

    $this->altImage = web_url(c_url('/assets/images/profile.png'));
  }
}