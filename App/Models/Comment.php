<?php
namespace App\Models;

defined('ABSPATH') || exit;

use pluslib\Database\Expression;
use pluslib\Eloquent\BaseModel;

/**
 * @property Expression|string $date
 * 
 * @property int $Verify
 * @property int $verify
 * 
 * @property int $ID
 * @property int $Parent
 * @property int $post
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
  protected $defaultData = [
    'Verify' => 0,
    'Parent' => NULL
  ];

  const updated_at = null;
  const created_at = 'date';

  protected $translation = [
    'text' => 'Text'
  ];

  protected $relationships = array(
    '_post' => array(self::HAS_ONE, Post::class, 'post'),
    'parent' => array(self::BELONGS_TO, Comment::class, 'Parent'),
    'author' => array(self::BELONGS_TO, User::class, 'user_id'),
    'replies' => array(self::HAS_MANY, Comment::class, 'Parent')
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
    return $this->verify;
  }

  function published()
  {
    return $this->verified();
  }
}