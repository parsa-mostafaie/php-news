<?php
defined('ABSPATH') || exit;

use pluslib\MVC\Defaults\User as UserBase;

class User extends UserBase
{
  protected $relationships = array(
    'posts' => array(self::HAS_MANY, 'Post', 'author'),
    'comments' => array(self::HAS_MANY, 'Comment', 'user_id'),
  );
}