<?php
namespace App\Models;

defined('ABSPATH') || exit;

use pluslib\Eloquent\BaseModel;

class Category extends BaseModel
{
  protected $table = "categories";
  protected $id_field = "ID";

  const updated_at = null;
  const created_at = null;

  protected $_timestamps = false;

  protected $relationships = array(
    'posts' => array(self::HAS_MANY, Post::class, 'Category'),
  );
}