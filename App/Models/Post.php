<?php
namespace App\Models;

defined('ABSPATH') || exit;

use pluslib\Eloquent\BaseModel;
use App\Auth;
use pluslib\Database\Expression;

/**
 * @property Expression|string $verify_date
 * @property Expression|string $created_at
 * @property Expression|string $updated_at
 * 
 * @property int $ID
 * @property int $Author
 * @property int $Category
 * 
 * @property int $view
 * @property string $Content
 * @property string $content
 * @property string $title
 * @property string $Title
 * @property string $description
 * 
 * @property int $Verify
 * @property int $verify
 * 
 * @property Category $category
 * @property User $author
 * @property Comment[] $comments
 */
class Post extends BaseModel
{
  protected $table = "posts";
  protected $id_field = "ID";
  protected $defaultData = [
    'Verify' => 0,
    'verify_date' => NULL
  ];

  protected $translation = [
    'content' => "Content",
    'title' => "Title",
    'verify' => "Verify"
  ];

  protected $relationships = array(
    'comments' => array(self::HAS_MANY, Comment::class, 'post'),
    'category' => array(self::BELONGS_TO, Category::class, 'Category'),
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

  function unverify($save = true)
  {
    $this->Verify = 0;
    $this->verify_date = null;

    if ($save)
      $this->save();

    return $this;
  }

  function edited()
  {
    return strtotime($this->updated_at) > strtotime($this->verify_date ?? $this->created_at);
  }

  function verified()
  {
    return $this->verify_date && $this->verify;
  }

  function published()
  {
    return $this->verified();
  }

  function sp_image()
  {
    return PostImage::get_img($this->_id(), 'class="card-img-top" alt="post-image"');
  }

  function cat_badge()
  {
    ?>
    <div class='position-absolute' style='top: 5px;left:5px'><?= badge($this->category->Name) ?></div>
    <?php
  }

  function publish()
  {
    return $this->verify();
  }

  function publish_date()
  {
    return strtotime($this->verify_date);
  }

  function readtime()
  {
    return readtime($this);
  }

  function content()
  {
    return hts_xss($this->content);
  }
}