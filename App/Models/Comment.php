<?php
namespace App\Models;

defined('ABSPATH') || exit;

use pluslib\Eloquent\BaseModel;

class Comment extends BaseModel
{
  protected $table = "comments";
  protected $id_field = "ID";
  protected $defaultData = [
    'Verify' => 0,
    'Parent' => NULL
  ];

  const updated_at = null;
  const created_at = 'date';

  protected $relationships = array(
    '_post' => array(self::HAS_ONE, 'Post', 'post'),
    '_parent' => array(self::BELONGS_TO, 'Comment', 'parent'),
    'author' => array(self::BELONGS_TO, 'User', 'user_id'),
    'replies' => array(self::HAS_MANY, 'Comment', 'parent')
  );
}