<?php
defined('ABSPATH') || exit;

use pluslib\Eloquent\BaseModel;
use App\Auth;

class Post extends BaseModel
{
  protected $table = "posts";
  protected $id_field = "ID";
  protected $relationships = array(
    'comments' => array(self::HAS_MANY, 'Comment', 'post'),
    'category' => array(self::BELONGS_TO, 'Category', 'Category'),
    'author' => array(self::BELONGS_TO, 'User', 'Author'),
  );

  public static function canEdited($post_id)
  {
    $post = new static($post_id);
    if (!$post->loaded()) {
      return false;
    }
    return $post->Author == getCurrentUserInfo_prop('ID') || Auth::isRole(2);
  }
}