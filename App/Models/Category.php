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
  protected $table = "categories";
  protected $id_field = "ID";

  protected $fillable = ['Name'];

  protected $translation = [
    'name' => 'Name'
  ];

  const updated_at = null;
  const created_at = null;

  public $_timestamps = false;

  protected $relationships = array(
    'posts' => array(self::HAS_MANY, Post::class, 'category_id'),
  );

  public function get_url(){
    return url(c_url('/search.php?cat=' . $this->_id()));
  }
}