<?php
namespace App\Models;

use pluslib\App\Models\UserProfile as PluslibUserProfile;
use pluslib\Database\UploadBaseColumn;

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