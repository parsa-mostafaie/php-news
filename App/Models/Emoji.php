<?php
namespace App\Models;

defined('ABSPATH') || exit;

use pluslib\Collections\Collection;
use pluslib\Eloquent\BaseModel;

/**
 * @property int $ID
 * @property string $Name
 * @property string $Emoji
 * @property string $unicode
 * @property string $name
 * @property string $eng_name
 * 
 * @property Collection<Reaction> $reactions
 */
class Emoji extends BaseModel
{
  protected $table = "emojis";
  protected $id_field = "ID";

  protected $readonly = true;

  protected $fillable = ['Name'];

  protected $translation = [
    'name' => 'Name',
    'unicode'=>'Emoji'
  ];

  const updated_at = null;
  const created_at = null;

  public $_timestamps = false;

  protected $relationships = [
    'reactions' => [self::HAS_MANY, Reaction::class, 'emoji_id']
  ];
}