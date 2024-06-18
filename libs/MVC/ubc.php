<?php

use pluslib\defaults\UserProfile as DefaultsUserProfile;
use pluslib\SQL\UploadBaseColumn;

defined('ABSPATH') || exit;

class PostImage extends UploadBaseColumn
{
  protected ?string $table = 'posts';
  protected string $colName = 'image';
  protected string $prefix = 'post.photo';

  function __construct()
  {
    parent::__construct();

    $this->altImage = c_url('/assets/images/1.jpg', false);
  }
}

class UserProfile extends DefaultsUserProfile
{
  function __construct()
  {
    parent::__construct();

    $this->altImage = c_url('/assets/images/profile.png', false);
  }
}