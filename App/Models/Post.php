<?php
namespace App\Models;

defined('ABSPATH') || exit;

use pluslib\Eloquent\BaseModel;
use App\Auth;

class Post extends BaseModel
{
  protected $table = "posts";
  protected $id_field = "ID";
  protected $defaultData = [
    'Verify' => 0,
    'verify_date' => NULL
  ];

  protected $relationships = array(
    'comments' => array(self::HAS_MANY, 'Comment', 'post'),
    'category' => array(self::BELONGS_TO, 'Category', 'Category'),
    'author' => array(self::BELONGS_TO, User::class, 'Author'),
  );

  public static function canEdited($post_id)
  {
    $post = new static($post_id);
    if (!$post->loaded()) {
      return false;
    }
    return $post->Author == User::current()->_id() || Auth::isRole(2);
  }

  public function canEdit()
  {
    return static::canEdited($this->_id());
  }

  function verify($save = true)
  {
    $this->Verify = 1;
    $this->verify_date = expr('current_timestamp()');

    if ($save)
      $this->save();

    return $this;
  }
}