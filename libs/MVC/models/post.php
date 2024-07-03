<?php
defined('ABSPATH') || exit;

use pluslib\MVC\BaseModel;

class Post extends BaseModel
{
  protected $table = "posts";
  protected $id_field = "ID";
  protected $relationships = array(
    'comments' => array(self::HAS_MANY, 'Comment', 'post'),
    'category' => array(self::BELONGS_TO, 'Category', 'Category'),
    'author' => array(self::BELONGS_TO, 'User', 'Author'),
  );
}