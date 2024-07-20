<?php
defined('ABSPATH') || exit;

use pluslib\Eloquent\BaseModel;

class Category extends BaseModel
{
  protected $table = "categories";
  protected $id_field = "ID";
  protected $relationships = array(
    'posts' => array(self::HAS_MANY, 'Post', 'Category'),
  );
}