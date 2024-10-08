<?php
namespace App\Models;

defined('ABSPATH') || exit;

use pluslib\Collections\Collection;
use pluslib\Eloquent\BaseModel;

/**
 * @property int $ID
 * @property string $Name
 * @property string $name
 * @property Collection<Post> $posts
 */
class Category extends BaseModel
{
  use CategoryTable;
  protected $table = "categories";
  protected $id_field = "ID";

  protected $fillable = ['Name'];

  protected $translation = [
    'name' => 'Name'
  ];

  protected $appends = ['url'];

  const updated_at = null;
  const created_at = null;

  public $_timestamps = false;

  protected $relationships = array(
    'posts' => array(self::HAS_MANY, Post::class, 'category_id'),
  );

  public function getUrlAttribute()
  {
    return $this->get_url();
  }

  public function get_url()
  {
    return url(c_url('/search.php?cat=' . $this->_id()));
  }
}