<?php
namespace App\Models;

defined('ABSPATH') || exit;

use pluslib\Eloquent\BaseModel;
use App\Auth;
use pluslib\Collections\Collection;
use pluslib\Database\Expression;

/**
 * @property Expression|string $verify_date
 * @property Expression|string $created_at
 * @property Expression|string $updated_at
 * 
 * @property int $ID
 * @property int $user_id
 * @property int $category_id
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
 * @property Collection<Reaction> $reactions
 */
class Post extends BaseModel
{
  protected $table = "posts";
  protected $id_field = "ID";
  protected $defaultData = [
    'Verify' => 0,
    'verify_date' => NULL
  ];

  protected $fillable = [
    'Title',
    'user_id',
    'Verify',
    'Content',
    'created_at',
    'updated_at',
    'Image',
    'category_id',
    'description',
    'verify_date',
    'view',
  ];

  protected $translation = [
    'content' => "Content",
    'title' => "Title",
    'verify' => "Verify"
  ];

  protected $relationships = array(
    'comments' => array(self::HAS_MANY, Comment::class, 'post_id'),
    'category' => array(self::BELONGS_TO, Category::class, 'category_id'),
    'author' => array(self::BELONGS_TO, User::class, 'user_id'),
    'reactions' => array(self::HAS_MANY, Reaction::class, 'post_id')
  );

  public static function canEdited($post_id)
  {
    $post = new static($post_id);
    if (!$post->loaded()) {
      return false;
    }
    return $post->user_id == User::current()->_id() || Auth::isRole(2);
  }

  public function canEdit()
  {
    return static::canEdited($this->_id());
  }

  public function is_visible($for = null)
  {
    $for ??= User::current();

    if (!$for)
      return $this->verify;

    return $this->user_id == $for->_id() || Auth::isRole(2) || $this->verify;
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

  function caro_image()
  {
    return PostImage::get_img($this->_id(), 'class="d-block w-100" alt="post-image"');
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

  function thumbnail_image()
  {
    return PostImage::get_img($this->_id(), 'class = "w-100 img-thumbnail"');
  }

  function related_posts()
  {
    return collect(
      array_slice(
        array_reverse(
          array_filter(
            $this->category->posts->all(),
            fn($p) => $p->_id() != $this->_id()
          )
        ),
        0,
        4
      )
    );
  }

  function get_current_reaction(): ?Reaction
  {
    if (!Auth::canLogin()) {
      return null;
    }

    return Reaction::select('reactions.*')
      ->where('post_id', $this->_id())
      ->where('user_id', User::current()->_id())
      ->first();
  }

  function get_current_emoji(): ?Emoji
  {
    $reaction = $this->get_current_reaction();

    if (!$reaction) {
      return null;
    }

    return $reaction->emoji;
  }

  function ereaction_id()
  {
    if (!Auth::canLogin()) {
      return null;
    }

    return $this->get_current_emoji()->ID ?? null;
  }

  function add_reaction($id)
  {
    if (!Auth::canLogin()) {
      return;
    }

    Reaction::updateOrCreate(
      [
        'user_id' => User::current()->_id(),
        'post_id' => $this->_id()
      ],
      ['emoji_id' => $id]
    );

    return $this;
  }

  function addrem_reaction($id)
  {
    if (!Auth::canLogin()) {
      return;
    }

    if ($this->ereaction_id() == $id) {
      $this->get_current_reaction()->delete();

      return $this;
    }


    $this->add_reaction($id);

    return $this;
  }

  function get_url()
  {
    return url(c_url("/posts/{$this->_id()}"));
  }

  function _un_publish_url()
  {
    $post = $this;

    return url(c_url('/admin/pages/posts/' . ($post->published() ? 'un' : '') . 'verify.php?post=' . $post->_id()));
  }

  function edit_url()
  {
    $id = $this->_id();

    return url(c_url('/writer/edit.php?post=' . $id));
  }

  function rem_url()
  {
    $id = $this->_id();
    return url(c_url('/admin/pages/posts/rem.php?post=' . $id));
  }
}