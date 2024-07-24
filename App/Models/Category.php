<?php
namespace App\Models;

defined('ABSPATH') || exit;

use pluslib\Eloquent\BaseModel;

class Category extends BaseModel
{
  protected $table = "categories";
  protected $id_field = "ID";

  protected $_updated_at = null;
  protected $_created_at = null;
  protected $relationships = array(
    'posts' => array(self::HAS_MANY, Post::class, 'Category'),
  );
}