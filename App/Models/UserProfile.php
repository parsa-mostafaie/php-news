<?php
namespace App\Models;

use pluslib\App\Models\UserProfile as PluslibUserProfile;
use pluslib\Database\UploadBaseColumn;

defined('ABSPATH') || exit;

class UserProfile extends PluslibUserProfile
{
  function __construct()
  {
    parent::__construct();

    $this->altImage = c_url('/assets/images/profile.png', false);
  }
}