<?php
namespace App\Models;

defined('ABSPATH') || exit;

use pluslib\Database\Expression;
use pluslib\Eloquent\BaseModel;

/**
 * @property Expression|string $date
 * 
 * @property int $Verify
 * 
 * @property int $ID
 * @property int $parent_id
 * @property int $post_id
 * @property int $user_id
 * 
 * @property string $text
 * 
 * @property string $Text
 * 
 * @property Post $_post
 * @property Comment $parent
 * @property User $author
 * @property Comment[] $replies
 */
class Comment extends BaseModel
{
  protected $table = "comments";
  protected $id_field = "ID";
  protected $appends = ['url'];
  protected $defaultData = [
    'Verify' => 0,
    'Parent' => NULL
  ];

  protected $fillable = [
    'date',
    'Verify',
    'Text',
    'parent_id',
    'post_id',
    'user_id'
  ];

  const updated_at = null;
  const created_at = 'date';

  protected $translation = [
    'text' => 'Text'
  ];

  protected $relationships = array(
    '_post' => array(self::BELONGS_TO, Post::class, 'post_id'),
    'parent' => array(self::BELONGS_TO, Comment::class, 'parent_id'),
    'author' => array(self::BELONGS_TO, User::class, 'user_id'),
    'replies' => array(self::HAS_MANY, Comment::class, 'parent_id')
  );

  function verify($save = true)
  {
    $this->Verify = 1;

    if ($save)
      $this->save();

    return $this;
  }

  function unverify($save = true)
  {
    $this->Verify = 0;

    if ($save)
      $this->save();

    return $this;
  }

  function verified()
  {
    return $this->Verify;
  }

  function published()
  {
    return $this->verified();
  }

  function can_verified()
  {
    return $this->_post->canEdit();
  }

  function getUrlAttribute(){
    return $this->get_url();
  }
  function get_url()
  {
    return $this->_post->get_url() . '#' . $this->_id();
  }
}